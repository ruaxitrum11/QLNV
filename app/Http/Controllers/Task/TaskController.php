<?php

namespace App\Http\Controllers\Task;

use App\Http\Requests\Task\TaskRequest;
use App\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{

    protected function create(array $data)
    {
//        dd($data);
        return Task::create([
            'name' => $data['name'],
            'user_id'=>$data['user_id']
        ]);
    }
    public function getTask()
    {
        $task = Task::all()->sortByDesc('created_at');

        return view('frontend.dashboard')->with('task', $task);
    }
    public function postAddTask(TaskRequest $request)
    {
//        dd($request);
        $data = $request->all();
        $validator = Validator::make([$data],[]);
//        dd($validator);
        if($validator->fails()){
            return redirect('/dashboard')->withErrors($validator)->withInput();
        }else {
            if($this->create($data)){
                Session::flash('success','Thêm công việc mới thành công');
                return redirect('/dashboard');
            }else {
                Session::flash('fail','Thêm công việc mới thất bại');
                return redirect('/dashboard');
            }
        }
    }
}
