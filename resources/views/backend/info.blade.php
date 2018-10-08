@extends('backend/index')
@section('title','thông tin tài khoản')
@section('dashboard-css')
    rel="stylesheet" type="text/css" href="{{ asset('/css/frontend/dashboard.css')}}"
@endsection

@section('content-info')
    <div class="row info" style="border-bottom: solid 1px #ddd;padding-bottom: 30px;" >
        <div class="col-md-6 pull-right" style="margin-top: 20px ;width:auto;"><a class="btn btn-primary" href="/admin">Quay lại</a></div>
        <h2 style="text-align: center;padding-bottom: 20px;">Thông tin nhân viên</h2>
        {{--{{$user}}--}}
        <div class="info-content-left col-md-6">
            <div class="form-group" style="float: left;width: 100%;">
                <p>Tên tài khoản</p>
                <input type="text" name="username" id="username" tabindex="1" class="form-control"  value=" {{$user->username}}" disabled>
            </div>
            <div class="form-group" style="float: left;width: 100%;">
                <p>Tên người dùng</p>
                <input type="text" name="name" id="name" tabindex="2" class="form-control"  value=" {{$user->name}}">
            </div>
        </div>
        <div class="info-content-right col-md-6" >
            <div class="form-group">
                <p>Chức vụ</p>
                    @if($permission)
                        <select id="permission">
                    @foreach($permission as $permission_item)
                        <option value="{{$permission_item->id}}" @if($user->permission_id == $permission_item->id)selected @endif>{{$permission_item->name}}</option>
                        @endforeach
                        </select>
                    @endif
                    {{--<option value="">{{Auth::user()->permission->name}}</option>--}}
                    {{--<option value="volvo">Volvo</option>--}}
                    {{--{{Auth::user()->permission_id}}--}}
            </div>
        </div>
        <div class="col-md-12 " style="padding-top: 20px">
          <button class="update-user btn btn-success" onclick="updateUser({{$user->id}})">Xác nhận</button>
        </div>
    </div>
    <div class="row info">
        <h2 style="text-align: center;padding-bottom: 20px;">Danh sách công việc</h2>
        <ul id="myUL">
            @if($task->total() != 0)
            @foreach($task as $item)
                <li class="task-ddd-{{$item->id}}">
                    <input id="task-content-{{$item->id}}" class="task-content task-ddd-{{$item->id}} task-{{$item->id}}" disabled type="text" value="{{$item->name}}">
                    {{--<span onclick="deleteTask({{$item->id}})" class="glyphicon glyphicon-remove addTask" ></span>--}}
                    {{--<span class="editTask-{{$item->id}} glyphicon glyphicon-edit" onclick="editTask({{$item->id}})" ></span>--}}
                    {{--<a href="/dashboard"> <span style="display: none" class="cancelEditTask-{{$item->id}} glyphicon glyphicon-repeat"></span></a>--}}
                    {{--<span style="display: none" class="confirmEditTask-{{$item->id}} glyphicon glyphicon-ok" onclick="confirmEditTask({{$item->id}})"></span>--}}
                </li>
            @endforeach
            @else
                <li>Công việc trống !</li>
            @endif
        </ul>
        <div class="paginate" style="text-align: center;">{{ $task }}</div>
    </div>
@endsection

