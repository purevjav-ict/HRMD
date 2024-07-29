<?php
namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Project;
use App\Models\Department;
use App\Models\Attendance;
use App\Models\Timesheet;
use App\Models\Payroll;
use App\Models\Post;
use App\Models\Logs;
use App\Models\Settings;
use Auth;
use Illuminate\Http\Request;
use DB;
use Session;
use Config;

class IndexController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Index Controller
    |--------------------------------------------------------------------------
    |
    | This controller renders your application's "dashboard" for users that
    | are authenticated. Of course, you are free to change or remove the
    | controller as you wish. It is just here to get your app started!
    |
    */

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        // $this->middleware('auth');
        $this->middleware(['auth']);
    }

    /**
     * Show the application dashboard to the user.
     *
     * @return Response
     */
    public function index()
    {
        $idw = Auth::user()->id;
        $employee=Employee::count();
        $projects2=Project::count();

        $hours_chart=Timesheet::Select(DB::Raw('DATE(start_time) as date, SEC_TO_TIME(SUM(UNIX_TIMESTAMP(tbl_timesheet.end_time) - UNIX_TIMESTAMP(tbl_timesheet.start_time))) as total, SUM(end_time-start_time) AS hours2'))
        ->GroupBy('date')
        ->OrderBy('date', 'DESC')
        ->Limit(25)
        ->get();


        $employees2=Timesheet::
       Select(DB::Raw('SEC_TO_TIME(SUM(UNIX_TIMESTAMP(tbl_timesheet.end_time) - UNIX_TIMESTAMP(tbl_timesheet.start_time))) as total'))
       ->get();
        $hours=$employees2[0]['total'];
        $pay=Payroll::select(DB::Raw('sum(pay)+sum(incentive) as total'))->get();
        $pay=$pay[0]['total'];
        
        $employees=Timesheet::with('emp')
       ->Select(DB::Raw('SEC_TO_TIME(SUM(UNIX_TIMESTAMP(tbl_timesheet.end_time) - UNIX_TIMESTAMP(tbl_timesheet.start_time))) as total, tbl_timesheet.emp_id'))
       ->GroupBy('tbl_timesheet.emp_id')
       ->OrderBy('total', 'DESC')
       ->Limit('5')
       ->get();
       $emps=Attendance::with('emp')
       ->Where('emp_id', '!=', 0)
       ->WhereDate('work_in','=', date('Y-m-d'))
       ->get();


        return view('home')->with('employee_count',$employee)->with('project_count',$projects2)
        ->with('pay_total',$pay)->with('hours_total',$hours)->with('employees', $employees)
        ->with('emps', $emps)->with('hours_data', $hours_chart);
    }


    public function tree(){

        $dept=Department::all(); 
        $array=array();
        foreach ($dept as $dep) {
          $post=Post::where('dept_id', '=', $dep->id)->get();
          array_push($array, $post);  
        }
        return view('hierarchy')->with('depts', $dept)->with('array', $array);
    }

    public function logs(){
      $logs=Logs::limit(250)->OrderBy('id', 'DESC')->paginate(25);
      return view('Admin/logs')->with('logs',$logs);
    }
   
     public function logs_search(Request $request)
    {
       $formData = $request->all();
       if(!isset($formData['query'])){
        return redirect('admin/settings/system-logs');
       }
        
         $logs=Logs::Where('log','LIKE','%'.$formData['query'].'%')
         ->limit(250)
         ->OrderBy('id', 'DESC')
         ->paginate(25);
         
      return view('Admin/logs')->with('logs',$logs);
 
    }

    public function settings()
    {
       $company = Settings::Where('category',  '=', '1')->get();
       $tax = Settings::Where('category',  '=', '2')->get();
       return view('Admin/settings')->with('companys', $company)->with('taxs', $tax);
    }


    public function settingsupd(Request $request)
    {
    $data2 = $request->all();
    unset($data2["_token"]);
    foreach ($data2 as $data=>$value) {
      $affected = DB::table('tbl_settings')->where('field', '=', $data)->update(array("value" => $value));

    }
    
        //logging
        $log_data=array('Settings Updated', 'Settings Values Updated', 'Settings');
        $log=Logs::DoEntry($log_data);

    return redirect('admin/settings/general')->with('message','Updated Successfully');
      }

public function switchLang($lang)
    {
      echo Config::get('languages');

        if (array_key_exists($lang, Config::get('languages'))) {
            Session::put('locale', $lang);
        }
    }

}
