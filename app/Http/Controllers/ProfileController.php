<?php

// namespace app\Http\Controllers;
namespace app\Http\Controllers;

use App\Models\User;
// use App\Update;
use App\Models\Update;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
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
        $idw = Auth::user()->id;
        $users = User::find($idw)->get();
        return view('auth/profile')->with('users', $users);
    }

    public function update(Request $request)
    {
        $idw = Auth::user()->id;
        $users = User::find($idw)->get();
        $formData = $request->all();
        $validator = User::Validator($formData);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }
        // $user_update = Update::Updates($formData, $idw);
        $user = User::find($idw);
        $user->email=$formData['email'];
        $user->password = bcrypt($formData['password']);
        $user->save();
        return redirect()->back()->with('message', 'Success, your profile now updated!');
    }
}
