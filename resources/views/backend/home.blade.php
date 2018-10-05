@extends('backend/index')
@section('title','Trang quản trị')
@section('content')
    @if (Auth::check())
        <div class="col-md-6 pull-right" style="margin-top: 20px;width:auto;"><a class="btn btn-primary" href="{{route('auth.getLogOut')}}">Đăng xuất</a></div>

    @endif
@endsection
@section('content-home')
<h2 style="text-align: center">Danh sách các nhân viên</h2>

<button type="button" class="btn btn-default addUser">Thêm nhân viên mới</button>

<div id="register-form" hidden>
    {{csrf_field()}}
    <div class="form-group">
        <input type="text" name="username" id="username" tabindex="1" class="form-control" placeholder="Username" value="">
    </div>
    <div class="form-group">
        <input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password">
    </div>
    <div class="form-group">
        <input type="password" name="password_confirmation" id="confirm-password" tabindex="2" class="form-control" placeholder="Confirm Password">
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-sm-6">
                <input onclick="addUser()" class="btn btn-primary"  name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-register" value="Xác nhận">
            </div>
        </div>
    </div>
</div>

<table class="table">
    <thead>
    <tr>
        <th>Mã nhân viên</th>
        <th>Tài khoản </th>
        <th>Xử lý</th>
    </tr>
    </thead>
    <tbody>

    @foreach( $user as $item)
        <tr>
            <td>{{ $item->id }}</td>
            <td>{{ $item->username }}</td>
            <td>
                <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
<div class="paginate" style="text-align: center;">{{ $user}}</div>

@endsection