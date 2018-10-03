@extends('master')
@section('title','Đăng ký')
@section('panel-heading-content')
<div class="row">
    <div class="col-xs-6">
        <a href="/" class="active" id="register-form-link">Register</a>
    </div>
    <div class="col-xs-6">
        <a href="{{ route('auth.getLogin') }}"  id="login-form-link">Login</a>
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
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            <span class="sr-only">Close</span>
        </button>
    </div>
@endif
<form id="register-form" action="{{ route('auth.postRegister') }}" method="post" role="form">
    {{csrf_field()}}
    <div class="form-group">
        <input type="text" name="username" id="usernameR" tabindex="1" class="form-control" placeholder="Username" value="">
    </div>
    <div class="form-group">
        <input type="password" name="password" id="passwordR" tabindex="2" class="form-control" placeholder="Password">
    </div>
    <div class="form-group">
        <input type="password" name="password_confirmation" id="confirm-passwordR" tabindex="2" class="form-control" placeholder="Confirm Password">
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
                <input type="submit" name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-register" value="Register Now">
            </div>
        </div>
    </div>
</form>


@endsection

