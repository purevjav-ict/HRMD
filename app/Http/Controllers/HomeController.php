<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function addition($a, $b){
        try{
        if(is_numeric($a) AND is_numeric($b)){
        return ($a+$b);    
        }
            return 'Not a valid numeric';
         throw new Exception("Not a valid numeric");
         
        }
        
        catch(Exception $e){
            return 'Not a valid numeric';
        }
        
    }

}

