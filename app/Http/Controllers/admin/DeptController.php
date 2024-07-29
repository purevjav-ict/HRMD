<?php

namespace app\Http\Controllers\Admin;

use App\Models\Department;
use App\Models\User;
use App\Models\Logs;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class DeptController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Task Controller
    |--------------------------------------------------------------------------
    |
    | This controller renders Task Management List, Create, Edit & Delete
    | Of course, you are free to change or remove the
    | controller as you wish. It is just here to get your app started!
    |
    */

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
       $departments=Department::leftjoin('tbl_post', 'tbl_dept.id', '=', 'tbl_post.dept_id')
       ->leftjoin('tbl_emp', 'tbl_post.id', '=', 'tbl_emp.post_id')
       ->Select(DB::raw('count(tbl_post.id) as count, count(tbl_emp.id) as count2, tbl_dept.*'))
       ->GroupBy('tbl_dept.id')
       ->paginate();

       return view('Admin/Department/list')->with('departments', $departments);
    }

    /**
     * Save Data from Create form
     *
     *  @return Redirect to view all data
     */

    public function docreate(Request $request)
    {
        $formData = $request->all();
        $dept_create= Department::DoCreate($formData);
        
        //logging
        $log_data=array('Department Added', $dept_create['id'], 'Department');
        $log=Logs::DoEntry($log_data);

        return redirect('admin/company/dept')->with('message', 'Department Successfully Added!');
    }

    /**
     * View & Edit Department Details
     *
     *  @return Redirect to particular Departments View
     */
    public function edit($id)
    {
        $departments = Department::Where('id', '=', $id)->get();
        return view('Admin/Department/edit')->with('departments', $departments);
    }


     public function delete2($id)
    {
        $departments = Department::find($id)->delete();
        return redirect('admin/company/dept')->with('message', 'Department Deleted!');
    }

    /**
     * Save Data from edit form
     *
     *  @return Redirect to view all data after save data
    */

    public function update(Request $request)
    {
       
     $formData = $request->all();
     $emp_create= Department::DoUpdate($formData);
        
        //logging
        $log_data=array('Department Updated', $emp_create['id'], 'Department');
        $log=Logs::DoEntry($log_data);

        return redirect('admin/company/dept')->with('message', 'Department Successfully Updated!');
    }

}
