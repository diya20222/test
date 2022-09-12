<?php

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


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

    protected $redirectTo = "/home";

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    //LOGIN WITH GOOGLE

    public function redirectToGoogle()
    {
   
        return Socialite::driver('google')->redirect();
        
    }
    //GOOGLE CALLBACK
    
    public function handleGoogleCallback()
    
    {
        $user = Socialite::driver('google')->user();
        $this->_registerOrLogin($user);
        return redirect()->route('home');
        // $user->token;
    }
    protected function _registerOrLogin($data){
        $user = User::where('email','=',$data->email)->first();
        if(!$user){
            return redirect()->back()->with('warning', ' Sorry ! This Page Not Found.');
        }
        Auth::login($user);
    }

}
