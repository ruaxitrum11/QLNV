<?php

namespace App\Http\Controllers\Admin;


//use App\Http\Requests\Admin\User\UserCreateRequest;
use App\Http\Requests\Admin\User\UserUpdateRequest;
use App\permission;
use App\Task;
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
//        dd(uniqid(rand()));
        $user = User::orderBy('created_at', 'DECS')->paginate(10);
//        dd($user);
        return view('backend/home')->with('user', $user);
    }

    protected function create(array $data)
    {
        return User::create([
            'username' => $data['username'],
            'name' => $data['name'],
            'password' => Hash::make($data['password']),
            'permission_id' => 1,
        ]);
    }

    public function addUser(UserCreateRequest $request)
    {
//
        $data = $request->all();
        if ($this->create($data)) {
//           dd($data);
            $response = [
                'status' => 'success',
                'msg' => 'Thêm thành công tài khoản: ' . $data['username']
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

    public function infoUser(int $id)
    {
        $permission = permission::all();
        $user = User::find($id);
        $task = Task::where('user_id',$id)->orderBy('created_at','decs')->paginate(5);
//        dd($task);
        if (!$id) {
            return redirect('/admin');
        } else {
            return view('/backend/info')->with('permission', $permission)->with('user', $user)->with('task',$task);
        }
    }

    protected function update(array $data , int $id)
    {
        $data_update = false;
        try{
           $user = User::find($id);
           $data_update = $user->update([
               'name' => $data['name'],
               'permission_id' => $data['permission_id']
           ]);
           return $data_update;
        }catch (\Exception $e){
            return $data_update;
        }
    }

    public function updateUser(UserUpdateRequest $request , int $id)
    {
        $data = $request->all();
        if ($this->update($data, $id)) {
            $response = [
                'status' => 'success',
                'msg' => 'Cập nhật tài khoản thành công',
            ];
            return response()->json($response);
        } else {
            $response = [
                'status' => 'errors',
                'msg' => 'Cập nhật tài khoản thất bại'
            ];
            return response()->json($response);
        }
    }

    protected function delete(int $id)
    {

        $data_delete = false;
        try{
            $user = User::find($id);
            $data_delete = $user->delete();
            return $data_delete;
        }catch (\Exception $e){
            return $data_delete;
        }
    }

    public function deleteUser(int $id)
    {
//        dd($this->delete($id));
        if($this->delete($id)){
            $respone = [
                'status' => 'success',
                'msg' => 'Xóa tài khoản thành công !'
            ];
            return response()->json($respone);
        }else{
            $respone = [
                'status' => 'success',
                'msg' => 'Xóa tài khoản thất bại !'
            ];
            return response()->json($respone);
        }
    }

}
