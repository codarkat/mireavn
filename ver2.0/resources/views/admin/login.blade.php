@extends('layouts.admin-without-header-layout')

@section('title')
    <title>MIREA VIETNAM | ADMIN LOGIN</title>
@endsection

@section('content')
    <div id="auth">

        <div class="row h-100">
            <div class="col-lg-5 col-12">
                <div id="auth-left">
                    <div class="auth-logo">
                        <a href="{{route('admin.dashboard')}}"><img src="{{asset('public/admin/assets/images/logo/logo.png')}}" alt="Logo"></a>
                    </div>
                    <h1 class="auth-title">Log in.</h1>
                    @if(count($errors)> 0)
                        <div class="alert alert-danger">
                            Thông báo lỗi<br><br>
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if($message = Session::get('fail'))
                        <div class="alert alert-danger">
                            <strong>{{$message}}</strong>
                        </div>
                    @endif
                    @if($message = Session::get('success'))
                        <div class="alert alert-success">
                            <strong>{{$message}}</strong>
                        </div>
                    @endif

                    <form action="{{route('admin.check')}}" method="post">
                        @csrf
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="email" class="form-control form-control-xl" name="email" placeholder="Email">
                            <div class="form-control-icon p-3">
                                <i class="bi bi-envelope"></i>
                            </div>
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="password" class="form-control form-control-xl" name="password" placeholder="Password">
                            <div class="form-control-icon p-3">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg ">Log in</button>
                    </form>
                    <!--
                    <div class="text-center mt-3 text-lg fs-4">
                        <p><a class="font-bold" href="auth-forgot-password.html">Forgot password?</a>.</p>
                    </div>
                    -->
                </div>
            </div>
            <div class="col-lg-7 d-none d-lg-block">
                <div id="auth-right">

                </div>
            </div>
        </div>

    </div>
@endsection
