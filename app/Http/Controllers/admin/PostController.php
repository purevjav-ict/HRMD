<?php

namespace app\Http\Controllers\Admin;

use App\Models\Post;
use App\Models\Department;
use App\Models\User;
use App\Models\Logs;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class PostController extends Controller
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
        $posting=Post::with('dept')
       ->leftjoin('tbl_emp', 'tbl_post.id', '=', 'tbl_emp.post_id')
       ->Select(DB::raw('count(tbl_emp.id) as count, tbl_post.*'))
       ->GroupBy('tbl_post.id')
       ->paginate();
        $dept = Department::all();
       return view('Admin/Posting/list')->with('posting', $posting)->with('dept', $dept);
    }


   public function create()
    {
        $idw = Auth::user()->id;
        $dept = Department::all();
        return view('Admin\Posting\create')->with('dept', $dept);
    }

     public function delete2($id)
    {
        $departments = Post::find($id)->delete();
        return redirect('admin/company/posting')->with('message', 'Posting Deleted!');
    }

  /**
     * Save Data from Create form
     *
     *  @return Redirect to view all data
     */

    public function docreate(Request $request)
    {
        $formData = $request->all();
        $dept_create= Post::DoCreate($formData);
        
        //logging
        $log_data=array('Post Created', $dept_create['id'], 'Posting');
        $log=Logs::DoEntry($log_data);

        return redirect('admin/company/posting')->with('message', 'Posting Successfully Added!');
    }

    /**
     * View & Edit Posting Details
     *
     *  @return Redirect to particular Postings View
     */
    public function edit($id)
    {
        $postings = Post::Where('id', '=', $id)->get();
         $dept = Department::Where('id', '!=', $postings[0]['dept_id'])->get();
        return view('Admin/Posting/edit')->with('postings', $postings)->with('dept', $dept);
    }

    /**
     * Save Data from edit form
     *
     *  @return Redirect to view all data after save data
    */

    public function update(Request $request)
    {
       
     $formData = $request->all();
     $emp_create= Post::DoUpdate($formData);
        
        //logging
        $log_data=array('Post Updated', $emp_create['id'], 'Posting');
        $log=Logs::DoEntry($log_data);

        return redirect('admin/company/posting')->with('message', 'Designation Successfully Updated!');
    }
  
}
