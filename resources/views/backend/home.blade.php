@extends('backend/index')
@section('title','Trang quản trị')
@section('content-css')
   {{asset('/css/backend/index.css')}}
@endsection
@section('content')
    @if (Auth::check())
        <div class="col-md-6 pull-right" style="margin-top: 20px;width:auto;"><a class="btn btn-primary" href="{{route('auth.getLogOut')}}">Đăng xuất</a></div>

    @endif
@endsection
@section('content-home')
<h2 style="text-align: center">Danh sách các nhân viên</h2>

<button type="button" class="btn btn-default addUser">Thêm tài khoản mới</button>

<div id="register-form" hidden>
    {{csrf_field()}}
    <div class="form-group">
        <input type="text" name="username" id="username" tabindex="1" class="form-control" placeholder="Tên tài khoản" value="">
    </div>
    <div class="form-group">
        <input type="text" name="name" id="name" tabindex="2" class="form-control" placeholder="Tên người dùng" value="">
    </div>
    <div class="form-group">
        <input type="password" name="password" id="password" tabindex="3" class="form-control" placeholder="Mật khẩu">
    </div>
    <div class="form-group">
        <input type="password" name="password_confirmation" id="confirm-password" tabindex="4" class="form-control" placeholder="Xác nhận mật khẩu">
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-sm-6">
                <input onclick="addUser()" class="btn btn-primary"  name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-register" value="Tạo tài khoản">
            </div>
        </div>
    </div>
</div>

<table class="table">
    <thead>
    <tr>
        <th>Mã nhân viên</th>
        <th>Tài khoản </th>
        <th>Tên nhân viên</th>
        <th>Xử lý</th>
    </tr>
    </thead>
    <tbody>
    @if($user->total() != 0)
    @foreach( $user as $item)
        <tr>
            <td>{{ $item->id }}</td>
            <td>{{ $item->username }}</td>
            <td>{{ $item->name }}</td>
            <td>
                <span style="cursor: pointer" onclick="infoUser({{$item->id}})" class="glyphicon glyphicon-forward" aria-hidden="true"></span>
                <span style="cursor: pointer" onclick="deleteUser('{{$item->id}}','{{$item->username}}')" class="glyphicon glyphicon-remove" aria-hidden="true"></span>
            </td>
        </tr>
    @endforeach
        @else
        <li>Danh sách nhân viên trống !</li>
        @endif
    </tbody>
</table>
<div class="paginate" style="text-align: center;">{{ $user}}</div>

@endsection