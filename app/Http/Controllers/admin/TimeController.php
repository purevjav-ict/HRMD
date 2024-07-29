<?php

namespace app\Http\Controllers\Admin;

use App\Models\Employee;
use App\Models\Timesheet;
use App\Models\Project;
use App\Models\Logs;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class TimeController extends Controller
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

    public function sumUp($a, $b){
        return $a+$b;
    }
    public function index()
    {
       $employees=Timesheet::with('emp')->with('project')
       ->Select(DB::Raw('timediff(tbl_timesheet.end_time,tbl_timesheet.start_time) as duration, tbl_timesheet.*'))
       ->OrderBy('id', 'DESC')
       ->paginate(25);
       $employees2=Timesheet::
       Select(DB::Raw('SEC_TO_TIME(SUM(UNIX_TIMESTAMP(tbl_timesheet.end_time) - UNIX_TIMESTAMP(tbl_timesheet.start_time))) as total'))
       ->get();
       $tot=$employees2[0]['total'];
        $posts = Employee::all();
        $projects=Project::Where('status', '=', '0')->get();
       return view('Admin/Timesheet/list')->with('employees', $employees)
       ->with('posts', $posts)->with('projects', $projects)->with('tot', $tot);
    }

     public function date_report(Request $request)
    {
         $data = $request->all();
       $employees=Timesheet::with('emp')->with('project')
       
->Select(DB::Raw('SEC_TO_TIME(SUM(UNIX_TIMESTAMP(tbl_timesheet.end_time) - UNIX_TIMESTAMP(tbl_timesheet.start_time))) as duration, tbl_timesheet.*'))
              ->whereDate('start_time','>=', date('Y-m-d', strtotime($data['start'])))
              ->whereDate('start_time','<=', date('Y-m-d', strtotime($data['end'])))
              ->GroupBy('emp_id', 'proj_id')
              ->get();
       return view('Admin/Timesheet/report')->with('employees', $employees)->with('data', '1');
    }

     public function search(Request $request)
    {
       $formData = $request->all();
       if(!isset($formData['query'])){
        return redirect('admin/timesheet');
       }
        
         $employees=Timesheet::with('emp')->with('project')
         ->Where('emp_id','=',$formData['query'])
         ->OrWhere('proj_id','=',$formData['query'])
       ->Select(DB::Raw('timediff(tbl_timesheet.end_time,tbl_timesheet.start_time) as duration, tbl_timesheet.*'))
       ->OrderBy('id', 'DESC')
       ->paginate(25);
       $employees2=Timesheet::
       Select(DB::Raw('SEC_TO_TIME(SUM(UNIX_TIMESTAMP(tbl_timesheet.end_time) - UNIX_TIMESTAMP(tbl_timesheet.start_time))) as total'))
       ->get();
       $tot=$employees2[0]['total'];
        $posts = Employee::all();
        $projects=Project::Where('status', '=', '0')->get();
       return view('Admin/Timesheet/list')->with('employees', $employees)
       ->with('posts', $posts)->with('projects', $projects)->with('tot', $tot);
 
    }


    public function delete($id)
    {
        $user = Timesheet::find($id)->delete();
        
        //logging
        $log_data=array('Time Entry Deleted', $id, 'Timesheet');
        $log=Logs::DoEntry($log_data);
       return redirect()->back()->with('message', 'Entry Deleted Successfully');
    }

    public function edit($id)
    {

         $employees = Timesheet::Where('id', '=', $id)->get();
         $posts = Employee::Where('id', '!=', $employees[0]['emp_id'])->get();
         $projects = Project::Where('id', '!=', $employees[0]['proj_id'])->get();

        return view('Admin/Timesheet/edit')->with('employees', $employees)
        ->with('posts', $posts)->with('projects', $projects);
    }


    public function create()
    {

        $posts = Employee::all();
        $projects=Project::all();

       return view('Admin/Timesheet/create')->with('posts', $posts)->with('projects', $projects);
    }


    public function docreate(Request $request)
    {
        $formData = $request->all();
        $emp_create= Timesheet::DoCreate($formData);
        //logging
        $log_data=array('Time Entry Added', $emp_create['id'], 'Timesheet');
        $log=Logs::DoEntry($log_data);
        return redirect('admin/timesheet')->with('message', 'Timesheet Log Created!');
    }

    public function update(Request $request)
    {
       
     $formData = $request->all();
     $emp_create= Timesheet::DoUpdate($formData);
     //logging
        $log_data=array('Time Entry Modified', $emp_create['id'], 'Timesheet');
        $log=Logs::DoEntry($log_data);
        return redirect('admin/timesheet')->with('message', 'Data Successfully Updated!');
    }


}

