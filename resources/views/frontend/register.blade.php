@extends('master')
@section('title','Đăng ký')
@section('panel-heading-content')
<div class="row">
    <div class="col-xs-6">
        <a href="/" class="active" id="register-form-link">Đăng ký</a>
    </div>
    <div class="col-xs-6">
        <a href="/login"  id="login-form-link">Đăng nhập</a>
    </div>
</div>
@endsection
@section('content')

<?php  ?>

@if ( Session::has('success') )
    <div class="alert alert-success alert-dismissible" role="alert">
        <strong>{{ Session::get('success') }}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            <span class="sr-only">Close</span>
        </button>
    </div>
@endif
<?php //Hiển thị thông báo lỗi?>
@if ( Session::has('error') )
    <div class="alert alert-danger alert-dismissible" role="alert">
        <strong>{{ Session::get('error') }}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            <span class="sr-only">Close</span>
        </button>
    </div>
@endif
@if ($errors->any())
    <div class="alert alert-danger alert-dismissible" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button style="top: -55px!important;right: -28px!important;" type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            <span class="sr-only">Close</span>
        </button>
    </div>
@endif
<form id="register-form" action="{{ route('auth.postRegister') }}" method="post" role="form">
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
            <div class="col-sm-6 col-sm-offset-3">
                <input type="submit" name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-register" value="Đăng ký ngay">
            </div>
        </div>
    </div>
</form>


@endsection

