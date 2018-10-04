<?php

namespace App\Http\Controllers\Task;

use App\Http\Requests\Task\TaskRequest;
use App\Task;
use http\Env\Response;
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
        $task = Task::orderBy('updated_at','DECS')->paginate(10);

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

    protected function update(array $data)
    {
        $data_update = false;
        try {
            $task = Task::find($data['user_id']);
            $data_update = $task->update([
                'name'=> $data['name']
            ]);
            return $data_update;
        } catch (\Exception $e) {
            return $data_update;
        }
    }

    public function editTask(TaskRequest $request)
    {
        $data = $request->all();

        $validator = Validator::make($data,[]);

        if($validator->fails()){
            $response = [
                'status'=>'errors',
                'msg'=>'Cập nhật công việc thất bại sasasdasds'
            ];
            return response()->json($response);
        }else {
            if($this->update($data)){
                $response = [
                   'status'=>'success',
                   'msg'=>'Cập nhật công việc thành công'
                ];
                return response()->json($response);
            }else {
                $response = [
                    'status'=>'errors',
                    'msg'=>'Cập nhật công việc thất bại'
                ];
                return response()->json($response);
            }
        }
    }
}
