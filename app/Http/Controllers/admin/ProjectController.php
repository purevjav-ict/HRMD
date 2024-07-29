<?php

namespace app\Http\Controllers\Admin;

use App\Models\Project;
use App\Models\Logs;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class ProjectController extends Controller
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
     * Show the available projects
     *
     *  @return Projects Lists
     *  @return duration as project duration
     *  @return duration2 as balance days from current date
     */
   
     public function index()
    {
        $projects = Project::Select(DB::Raw('datediff(tbl_projects.deadline,tbl_projects.start_date) as duration, datediff(tbl_projects.deadline,NOW()) as duration2, tbl_projects.*'))
            ->OrderBy('status')
            ->simplePaginate(25);

       return view('Admin/Projects/list')->with('projects', $projects);
    }

     /**
     * Save Data from Create form
     *
     *  @return Redirect to view all data
     */

    public function docreate(Request $request)
    {
        $formData = $request->all();
        $emp_create= Project::DoCreate($formData);
        
        //logging
        $log_data=array('Project Created', $emp_create['id'], 'Project');
        $log=Logs::DoEntry($log_data);
        return redirect('admin/projects')->with('message', 'Project Successfully Added!');
    }

    /**
     * View & Edit Project Details
     *
     *  @return Redirect to particular projects View
     */
    public function edit($id)
    {
        $projects = Project::Where('id', '=', $id)->get();
        return view('Admin/Projects/edit')->with('projects', $projects);
    }

    /**
     * Save Data from edit form
     *
     *  @return Redirect to view all data after save data
    */

    public function update(Request $request)
    {
       
     $formData = $request->all();
     $emp_create= Project::DoUpdate($formData);
     //logging
        $log_data=array('Project Updated', $emp_create['id'], 'Project');
        $log=Logs::DoEntry($log_data);
        return redirect('admin/projects')->with('message', 'Project Successfully Updated!');
    }

    /**
     * Delete Particular Project 
     *
     *  @return Redirect to view all data after deleted data
    */
    public function delete2($id)
    {
       
        $user = Project::find($id)->delete();
        return redirect('admin/projects')->with('message', 'Project Successfully Deleted');
    }

 public function search(Request $request)
    {
       $formData = $request->all();
       if(!isset($formData['query'])){
        return redirect('admin/projects');
       }
        
         $projects = Project::Where('proj_title','LIKE','%'.$formData['query'].'%')
                    ->OrWhere('proj_desc','LIKE','%'.$formData['query'].'%')
                    ->Select(DB::Raw('datediff(tbl_projects.deadline,tbl_projects.start_date) as duration, datediff(tbl_projects.deadline,NOW()) as duration2, tbl_projects.*'))
                    ->simplePaginate(25);

      return view('Admin/Projects/list')->with('projects', $projects);
    }
    
}
