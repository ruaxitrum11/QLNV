@extends('master')
@section('title','Trang Chủ')
@section('content')
    @if (Auth::check())
        <div>
            Bạn đang đăng nhập với quyền
            @if( Auth::user()->permission_id == 1)
                {{ "SuperAdmin" }}
            @elseif( Auth::user()->permission_id == 2)
                {{ "Admin" }}
            @elseif( Auth::user()->permission_id == 0)
                {{ "Thành viên" }}
            @endif
        </div>
        <div class="pull-right" style="margin-top: 3px;"><a class="btn btn-primary" href="{{route('auth.getLogOut')}}">Đăng xuất</a></div>
    @endif

@endsection