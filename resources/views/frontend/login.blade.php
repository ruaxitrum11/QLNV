@extends('master')
@section('title','Đăng nhập')
@section('panel-heading-content')
<div class="row">
	<div class="col-xs-6">
		<a href="/" id="register-form-link">Đăng ký</a>
	</div>
	<div class="col-xs-6">
		<a href="/login" class="active" id="login-form-link">Đăng nhập</a>
	</div>
</div>
@endsection
@section('content')
<?php //Hiển thị thông báo thành công?>
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
{{--<p>{{ $a }}</p>--}}
{{--<p>{{ $b }}</p>--}}
{{--<p>{{ $c }}</p>--}}
<form id="login-form" action="{{route('auth.postLogin')}}" method="post" role="form">
	{{csrf_field()}}
	<div class="form-group">
		<input type="text" name="username" id="username" tabindex="1" class="form-control" placeholder="Tên tài khoản" value="">
	</div>
	<div class="form-group">
		<input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Mật khẩu">
	</div>

	<div class="form-group">
		<div class="row">
			<div class="col-sm-6 col-sm-offset-3">
				<input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-login" value="Đăng nhập">
			</div>
		</div>
	</div>
	<div class="form-group text-center">
		<input type="checkbox" tabindex="3" class="" name="remember" id="remember">
		<label for="remember"> Remember Me</label>
	</div>
	<div class="form-group">
		<div class="row">
			<div class="col-lg-12">
				<div class="text-center">
					<a href="#" tabindex="5" class="forgot-password">Forgot Password?</a>
				</div>
			</div>
		</div>
	</div>
</form>
@endsection