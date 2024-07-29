<?php

namespace app\Http\Controllers\Admin;

use App\Models\Project;
use App\Models\Employee;
use App\Models\Attendance;
use App\Models\Payroll;
use App\Models\Settings;
use App\Models\Logs;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
//use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Request as Input;


class PayrollController extends Controller
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
    public $tax;
    public $pf; 
    public function __construct()
    {
        $this->middleware('auth');
        $settings=Settings::Where('category', '=', '2')->get();
        foreach ($settings as $setting) {
        if($setting->field=='tax'){
        $this->tax=$setting->value;
       }
       if($setting->field=='pf'){
        $this->pf=$setting->value;
       }
      }
    }

    /**
     * Show the application dashboard to the user.
     *
     * @return Response
     */
    
    
  

    
    
    public function index(){
     $logs=Logs::Where('cat', '=', 'Payroll')->Limit(5)->get(); 
     return view('Admin/Payroll/create')->with('logs', $logs);
    }

    public function generate(Request $request){
        $data = $request->all();
        $allowed_days=2;
        $employee=Attendance::with('emp')
         ->whereBetween('work_in',[date('Y-m-d', strtotime($data['work_in'])),date('Y-m-d', strtotime($data['work_out']))])
         ->Select(DB::Raw('count(tbl_attendance.id) as working_days, tbl_attendance.emp_id'))
         ->Groupby('emp_id')
         ->Where('emp_id','>','0')

        ->get();
        $count=count($employee);
        return view('Admin/Payroll/view')->with('employee', $employee)
        ->with('date_start', $data['work_in'])->with('date_end', $data['work_out'])
        ->with('count', $count);

    }

    
    public function savedata(Request $request)
    {
        
     $data = $request->all();
     
     $tax1=($this->tax/100);
     $ded1=($this->pf/100);
    
     $j=0;
     for($i=1; $i<=$data['count2']; $i++){
       $salary=$data['pay'][$j]+$data['inc'][$j];      
       if($salary>0) {
       $payroll=new Payroll;
       $payroll->emp_id=$data['emp_id'][$j];
       $payroll->pay=$data['pay'][$j];
       $payroll->incentive=$data['inc'][$j];

       $tax2=$salary*$tax1;
       $ded=$salary*$ded1;
       $net=($salary-($tax2+$ded));

       $payroll->tax=$tax2;
       $payroll->ded=$ded;
       $payroll->net=$net;
       $payroll->dop=date('Y-m-d');
       $payroll->period_frm=$data['date_start'];
       $payroll->period_to=$data['date_end'];
       $payroll->method='1';
       $payroll->trans_id=$data['trans'][$j];
       $payroll->trans_mode=$data['trans_txt'][$j];

       $payroll->save();
       }
       $j=$j+1;
      
     }
  
        //logging
        $log_data=array('Payroll Generated', $data['date_start']."-".$data['date_end'], 'Payroll');
        $log=Logs::DoEntry($log_data);

        return redirect('admin/payroll/statements');
    }


    public function statementsearch(Request $request)
    {
      $formData = $request->all();
      $payout = Payroll::with('emp')->Where('emp_id','=', $formData['user'])->paginate(25);
       return view('Admin/Payroll/statement')->with('payouts', $payout);
    }

    public function statementfilter(Request $request)
    {
      $data = $request->all();
      $payout = Payroll::with('emp')->whereBetween('dop',[date('Y-m-d', strtotime($data['start'])),date('Y-m-d', strtotime($data['end']))])->paginate(25);
    return view('Admin/Payroll/statement')->with('payouts', $payout);
    }


    public function statement()
    {
       $payout = Payroll::with('emp')->paginate(25);
       return view('Admin/Payroll/statement')->with('payouts', $payout);
    }

    public function statementview(Request $request){
   $Data=$request->all();

    if(Input::get('print')) {
   if(isset($Data['foo'])){      
           $payout_tot=$this->printstatement($Data);
          $payout=$payout_tot[0];
        $words=$payout_tot[1];
      return view('Admin/Payroll/statement-view')->with('payout',$payout)->with('words',$words);
        }
else{
  return redirect('admin/payroll/statements')->withErrors('Please select atleast one to print!');
 }
}

         elseif(Input::get('xls')) {
           $data=$this->excel($Data);
           $data=$data[0];
          $members=$data->toArray();
          $members = array_map(function($val)
    {
      return array_dot($val);
    }, $members);


    Excel::create('BankXLS', function($excel) use($members) {
           $excel->sheet('BankXLS', function($sheet) use($members) {
                $sheet->fromModel($members);
                $sheet->row(1, array(
                 'Member ID', 'Pay Amount', 'ID', 'Name', 'City', 'Mobile', 'Bank', 'A/c Number', ' Branch', 'IFSC'
                ));
                $sheet->setWidth('C', 1);
                $sheet->row(1, function($row) {
                $row->setBackground('#666699');
                $row->setFontColor('#FFFFFF');
                });
            });
        })->download('xls');
    }
}


 public function excel($Data){
    $payout = [];
   foreach($Data['foo'] AS $foo){


    $payout[]=Payout::with(array('member'=>function($query){
        $query->select('id', 'name', 'city','mobile', 'bank','bank_number','bank_branch', 'bank_ifsc');
    }))->select('mem_id', 'paid')->get();

   }


return $payout;
 }

 public function printstatement($Data){
    $payout = [];
    $words = [];
  
   foreach($Data['foo'] AS $foo){
    $payout[]=Payroll::with('emp')->Where('id','=',$foo)->get();
    $amt=Payroll::Where('id','=',$foo)->select('pay')->get();
    $words[]=$this->int_to_words(round($amt[0]['pay']));
   }
 
 
return array($payout, $words);
 }


  public function int_to_words($x)
       {
       $nwords = array("zero", "one", "two", "three", "four", "five", "six", "seven", "eight", "nine", "ten", "eleven", "twelve", "thirteen", "fourteen", "fifteen", "sixteen", "seventeen", "eighteen", "nineteen", "twenty", 30 => "thirty", 40 => "forty", 50 => "fifty", 60 => "sixty", 70 => "seventy", 80 => "eighty", 90 => "ninety" );
           if(!is_numeric($x))
           {
               $w = '#';
           }else if(fmod($x, 1) != 0)
           {
               $w = '#';
           }else{
               if($x < 0)
               {
                   $w = 'minus ';
                   $x = -$x;
               }else{
                   $w = '';
               }
               if($x < 21)
               {
                   $w .= $nwords[$x];
               }else if($x < 100)
               {
                   $w .= $nwords[10 * floor($x/10)];
                   $r = fmod($x, 10);
                   if($r > 0)
                   {
                       $w .= '-'. $nwords[$r];
                   }
               } else if($x < 1000)
               {
                   $w .= $nwords[floor($x/100)] .' hundred';
                   $r = fmod($x, 100);
                   if($r > 0)
                   {
                       $w .= ' and '. $this->int_to_words($r);
                   }
               } else if($x < 100000)
               {
                   $w .= $this->int_to_words(floor($x/1000)) .' thousand';
                   $r = fmod($x, 1000);
                   if($r > 0)
                   {
                       $w .= ' ';
                       if($r < 100)
                       {
                           $w .= 'and ';
                       }
                       $w .= $this->int_to_words($r);
                   }
               } else {
                   $w .= $this->int_to_words(floor($x/100000)) .' lakh';
                   $r = fmod($x, 100000);
                   if($r > 0)
                   {
                       $w .= ' ';
                       if($r < 100)
                       {
                           $word .= 'and ';
                       }
                       $w .= $this->int_to_words($r);
                   }
               }
           }
           return $w;
}






  
}
