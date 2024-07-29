<?php

namespace app\Http\Controllers\Admin;

use App\Models\Employee;
use App\Models\Timesheet;
use App\Models\Attendance;
use App\Models\Logs;
use App\Models\User;
use Auth;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class AttendanceController extends Controller
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
       $employees=Attendance::with('emp')
       ->Where('emp_id', '>', '0')
       -> Select(DB::Raw('timediff(tbl_attendance.work_out,tbl_attendance.work_in) as duration,  tbl_attendance.*'))
            ->simplePaginate(25);
       $posts = Employee::all();
       return view('Admin/Attendance/list')->with('employees', $employees)->with('posts', $posts);
    }

      public function date_report(Request $request)
    {
         $data = $request->all();
       $employees=Attendance::with('emp')
       ->leftjoin('tbl_timesheet', 'tbl_attendance.emp_id', '=', 'tbl_timesheet.emp_id')
       ->Where('tbl_attendance.emp_id', '>', '0')
       ->Select(DB::Raw('SEC_TO_TIME(SUM(UNIX_TIMESTAMP(tbl_attendance.work_out) - UNIX_TIMESTAMP(tbl_attendance.work_in))) as duration, SEC_TO_TIME(SUM(UNIX_TIMESTAMP(tbl_timesheet.end_time) - UNIX_TIMESTAMP(tbl_timesheet.start_time))) as duration2, count(tbl_attendance.work_in) as days, tbl_attendance.*'))
                 
              ->whereBetween('tbl_attendance.work_in',[date('Y-m-d', strtotime($data['start'])),date('Y-m-d', strtotime($data['end']))])
              ->distinct('tbl_timesheet.emp_id')
              ->GroupBy('emp_id')
              ->get();
       return view('Admin/Attendance/report')->with('employees', $employees)->with('data', '1');
    }


     public function search(Request $request)
    {
       $formData = $request->all();
       if(!isset($formData['query'])){
        return redirect('admin/attendance');
       }
        
         $employees=Attendance::with('emp')
        ->Where('emp_id','=',$formData['query'])
       ->Where('emp_id', '>', '0')
       -> Select(DB::Raw('timediff(tbl_attendance.work_out,tbl_attendance.work_in) as duration,  tbl_attendance.*'))
            ->simplePaginate(25);
            $posts = Employee::all();
       return view('Admin/Attendance/list')->with('employees', $employees)->with('posts', $posts);
    }


    public function guests()
    {
       $employees=Attendance::with('emp')
       ->Where('emp_id', '=', '0')
       -> Select(DB::Raw('timediff(tbl_attendance.work_out,tbl_attendance.work_in) as duration,  tbl_attendance.*'))
            ->simplePaginate(25);
       return view('Admin/Attendance/guest')->with('employees', $employees);
    }

    public function guest_search(Request $request)
    {
       $formData = $request->all();
       if(!isset($formData['query'])){
        return redirect('admin/attendance/guests');
       }
        
         $employees=Attendance::with('emp')
          ->Where('guest','LIKE','%'.$formData['query'].'%')
       ->Where('emp_id', '=', '0')
       -> Select(DB::Raw('timediff(tbl_attendance.work_out,tbl_attendance.work_in) as duration,  tbl_attendance.*'))
            ->simplePaginate(25);
       return view('Admin/Attendance/guest')->with('employees', $employees);
    }

    public function full()
    {
       $employees=Attendance::with('emp')
       ->Where('emp_id', '!=', '0')
       ->get();
      return view('Admin/Attendance/fullview')->with('employees', $employees);
    }


    public function delete($id)
    {
        $user = Attendance::find($id)->delete();
        
        //logging
        $log_data=array('Attendance Entry Deleted', $id, 'Attendance');
        $log=Logs::DoEntry($log_data);

       return redirect()->back()->with('message', 'Entry Deleted!');
    }

    public function edit($id)
    {
        $employees = Attendance::with('emp')->Where('id', '=', $id)->get();
        return view('Admin/Attendance/edit')->with('employees', $employees);
    }

     public function edit2($id)
    {
        $employees = Attendance::Where('id', '=', $id)->get();
        return view('Admin/Attendance/guestedit')->with('employees', $employees);
    }


    public function create()
    {
       $posts = Employee::all();
       return view('Admin/Attendance/create')->with('posts', $posts);
    }


    public function docreate(Request $request)
    {
        $formData = $request->all();
        $emp_create= Attendance::DoCreate($formData);
        
        //logging
        $log_data=array('Entry Created', $emp_create['id'], 'Attendance');
        $log=Logs::DoEntry($log_data);

        return redirect('admin/attendance')->with('message', 'Log Successfully Created!');
    }

    public function docreate2(Request $request)
    {
        $formData = $request->all();
        $emp_create= Attendance::DoCreate2($formData);
        //logging
        $log_data=array('Guest Entry Created', $emp_create['id'], 'Attendance');
        $log=Logs::DoEntry($log_data);

        return redirect('admin/attendance/guests')->with('message', 'Log Successfully Created!');
    }


    public function update(Request $request)
    {
       
     $formData = $request->all();
     $emp_create= Attendance::DoUpdate($formData);
        //logging
        $log_data=array('Entry Updated', $emp_create['id'], 'Attendance');
        $log=Logs::DoEntry($log_data);
        return redirect('admin/attendance')->with('message', 'Updated!');
    }

      public function update2(Request $request)
    {
       
     $formData = $request->all();
     $emp_create= Attendance::DoUpdate2($formData);
     //logging
        $log_data=array('Guest Entry Updated', $emp_create['id'], 'Attendance');
        $log=Logs::DoEntry($log_data);
        return redirect('admin/attendance/guests')->with('message', 'Updated!');
    }



}
