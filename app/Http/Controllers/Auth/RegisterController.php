<?php

namespace App\Http\Controllers\Auth;

use App\permission;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Http\Requests\User\RegisterRequest;
use Illuminate\Support\Facades\Session;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;


    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
//    protected function validator(array $data)
//    {
//        return Validator::make($data, [
//
//        ]);
//    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'username' => $data['username'],
            'name' => $data['name'],
            'password' => Hash::make($data['password']),
            'permission_id' => 1,
        ]);

        return $user;
    }
    public function getRegister() {
        return view('frontend.register');
    }

    public function postRegister(RegisterRequest $request) {

        $datas = $request->all();
//        dd($datas);
            if($this->create($datas)){
                Session::flash('success','Bạn đã đăng ký thành công , vui lòng đăng nhập');
                return redirect('/login');
            }else{
                Session::flash('error','Đăng ký thất bại');
                return redirect('/');
            }

    }
}
