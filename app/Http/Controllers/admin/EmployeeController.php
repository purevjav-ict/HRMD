<?php

namespace app\Http\Controllers\Admin;

use App\Models\Employee;
use App\Models\Post;
use App\Models\Logs;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class EmployeeController extends Controller
{
    
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard to the user.
     *
     * @return Response
     */
    public function index()
    {
       $employees=Employee::with('post')->paginate(10);
       $posts = Post::all();
       return view('Admin/Employee/list')->with('employees', $employees)->with('posts', $posts);
    }



    public function search(Request $request)
    {
       $formData = $request->all();
       if(!isset($formData['query'])){
        return redirect('admin/dashboard');
       }
       $employees=Employee::with('post')
       ->Where('name','LIKE','%'.$formData['query'].'%')
       ->OrWhere('mobile','LIKE','%'.$formData['query'].'%')
       ->OrWhere('email','LIKE','%'.$formData['query'].'%')
       ->paginate(10);
        $posts = Post::all();
       return view('Admin/Employee/list')->with('employees', $employees)->with('posts', $posts);
    }


    public function delete($id)
    {
        $user = Employee2::find($id)->delete();
       return redirect()->back()->with('message', 'Task Deleted Successfully');
    }

    public function edit($id)
    {
        $idw = Auth::user()->id;
        $employees = Employee::Where('id', '=', $id)->get();
        $posts = Post::Where('id', '!=', $employees[0]['post_id'])->get();
        return view('Admin/Employee/edit')->with('employees', $employees)
        ->with('posts', $posts);
    }


    public function create()
    {
        $posts = Post::all();
        return view('Admin/Employee/create')->with('posts', $posts);
    }

 

    public function docreate(Request $request)
    {
        $formData = $request->all();
        $emp_create= Employee::DoCreate($formData);

        //logging
        $log_data=array('New Appoint', $emp_create['id'], 'Employees');
        $log=Logs::DoEntry($log_data);

        return redirect('admin/emp')->with('message', 'Appointment Successfully Done!');
    }

    public function update(Request $request)
    {
       
     $formData = $request->all();
     $emp_create= Employee::DoUpdate($formData);
     
     //logging
     $log_data=array('Profile Updated', $emp_create['id'], 'Employees');
     $log=Logs::DoEntry($log_data);
     return redirect('admin/emp')->with('message', 'Employee data successfully updated!');
    }

}
