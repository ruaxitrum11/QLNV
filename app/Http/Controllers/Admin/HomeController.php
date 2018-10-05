<?php

namespace App\Http\Controllers\Admin;


use App\Http\Requests\Admin\User\UserCreateRequest;
use App\User;
use Illuminate\Auth\Access\Gate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getHome()
    {
        $user = User::orderBy('created_at','ASC')->paginate(20);
//        dd($user);
        return view('backend/home')->with('user',$user);
    }

    protected function create(array $data)
    {
        return User::create([
            'username'=>$data['username'],
            'password'=> Hash::make($data['password']),
            'permission_id' => 1,
        ]);
    }

    public function addUser(UserCreateRequest $request)
    {
        $data = $request->all();
       if ($this->create($data)) {
//           dd($data);
            $response = [
                'status' => 'success',
                'msg' => 'Thêm thành công tài khoản: '.$data['username']
            ];
            return response()->json($response);
        } else {
            $response = [
                'status' => 'errors',
                'msg' => 'Thêm tài khoản thất bại'
            ];
            return response()->json($response);
        }

    }

}
