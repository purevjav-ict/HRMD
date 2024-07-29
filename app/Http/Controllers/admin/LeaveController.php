<?php

namespace app\Http\Controllers\Admin;

use App\Models\Employee;
use App\Models\Timesheet;
use App\Models\Leave;
use App\Models\Logs;
use App\Models\Group;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;


class LeaveController extends Controller
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
       $employees=Leave::with('emp')
              -> Select(DB::Raw('datediff(tbl_leave.end_date,tbl_leave.start_date) as duration,  tbl_leave.*'))
              ->paginate(25);
        $posts = Employee::all();
       return view('Admin/Leave/list')->with('employees', $employees)->with('posts', $posts);
    }

    public function date_report(Request $request)
    {
         $data = $request->all();
       $employees=Leave::with('emp')
              ->Select(DB::Raw('sum(datediff(tbl_leave.end_date,tbl_leave.start_date)) as duration,  tbl_leave.*'))
              ->whereBetween('tbl_leave.start_date',[date('Y-m-d', strtotime($data['start'])),date('Y-m-d', strtotime($data['end']))])
              ->Where('status', '=', '1')
              ->GroupBy('emp_id')
              ->get();
       return view('Admin/Leave/report')->with('employees', $employees)->with('data', '1');
    }

    public function search(Request $request)
    {
       $formData = $request->all();
       if(!isset($formData['query'])){
        return redirect('admin/leave');
       }
        
         $employees=Leave::with('emp')
              ->Where('emp_id','=',$formData['query'])
              -> Select(DB::Raw('datediff(tbl_leave.end_date,tbl_leave.start_date) as duration,  tbl_leave.*'))
              ->paginate(25);
        $posts = Employee::all();
         return view('Admin/Leave/list')->with('employees', $employees)->with('posts', $posts);

    }

    public function delete($id)
    {
        $user = Leave::find($id)->delete();
        
        //logging
        $log_data=array('Leave Deleted', $id, 'Leave');
        $log=Logs::DoEntry($log_data);

       return redirect()->back()->with('message', 'Deleted Successfully');
    }

    public function edit($id)
    {
      
        $employees = Leave::Where('id', '=', $id)->get();
        return view('Admin/Leave/edit')->with('employees', $employees);
        
    }

    public function create()
    {

       $posts = Employee::all();
       return view('Admin/Leave/create')->with('posts', $posts);
    }

    public function finished($id, $stat)
    {
        $tasks = Task::UpdateStat($id, $stat);

        return redirect()->back();
    }

    public function docreate(Request $request)
    {
        $formData = $request->all();
        $emp_create= Leave::DoCreate($formData);
        
        //logging
        $log_data=array('Leave Created', $emp_create['id'], 'Leave');
        $log=Logs::DoEntry($log_data);

        return redirect('admin/leave')->with('message', 'Leave Requested!');
    }

    public function update(Request $request)
    {
       
     $formData = $request->all();
     $emp_create= Leave::DoUpdate($formData);
     //logging
        $log_data=array('Leave Updated', $emp_create['id'], 'Leave');
        $log=Logs::DoEntry($log_data);

        return redirect('admin/leave')->with('message', 'Updated Successfully!');
    }


}
