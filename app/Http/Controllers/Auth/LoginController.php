<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\User\LoginRequest;
use Illuminate\Support\Facades\Session;

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

//    /**
//     * Where to redirect users after login.
//     *
//     * @var string
//     */
//    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function getLogin() {
        return view('frontend.login');
    }

    public function postLogin(LoginRequest $request) {
//        dd($request);
        $datas = $request->all();
        $username = $datas['username'];
        $password = $datas['password'];

        if(Auth::attempt([
            'username'=>$username ,
            'password'=> $password
        ])) {
            return redirect('/');
        }else {
            Session::flash('error','Username hoặc Password không đúng');
            return redirect('/login');
        }


    }
}
