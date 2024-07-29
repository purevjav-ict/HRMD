<?php

namespace app\Http\Controllers\employee;

use App\Models\Employee;
use Hash;
use Auth;
use DB;
use Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\custom\Curl;
use Carbon\Carbon;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Home Controller
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



    public function authenticate(Request $request)
    {
       $formData = $request->all();
       
      $hash_password=Hash::make($formData['password']);

      //is member available
       $members_count=Employee::Where('email','=',$formData['email'])
       ->Where('status', '=', '1')
       ->count();


       //password check
       if($members_count>0){
       $members=Employee::Where('email','=',$formData['email'])
       ->Where('status', '=', '1')
       ->first();

        if(Hash::check($formData['password'], $members->password)){
          
          $request->session()->put('emp_id', $members->id);
          $request->session()->put('emp_name', $members->name);
          //echo session('emp_id');
         return redirect('employee/dashboard');
        }
        else{
        return redirect('/')->withErrors('Password Mismatch!');
        }
       }
       else{
        return redirect('/')->withErrors('Employee not found!!');
       }

    }
    




public function logout(){
Session::forget('emp_id');
$request->session()->forget('emp_id');
$request->session()->flush();
return redirect('/');
}



}
