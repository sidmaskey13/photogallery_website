<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */


    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login()
    {
        request()->validate([
            'email'=>'required',
            'password'=>'required',
        ]);
        if(Auth::attempt(['email'=>request('email'),'password'=>request('password'),'verified'=>'1'])){
            return redirect('/home');
        }
        elseif(Auth::attempt(['email'=>request('email'),'password'=>request('password'),'verified'=>'2'])){
            Auth::logout();
            return redirect('/login')->with('warning', 'Your request has been rejected by admin');
        }
        elseif(Auth::attempt(['email'=>request('email'),'password'=>request('password'),'verified'=>'0'])){
            Auth::logout();
            return redirect('/login')->with('warning', 'You need to confirm your account. We have sent you an activation code, please check your email.');
        }
        else{
            return redirect('/login')->with('warning', 'Email/Password Incorrect.');
        }
    }

}
