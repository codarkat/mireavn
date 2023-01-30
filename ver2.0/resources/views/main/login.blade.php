@extends('layouts.main-without-navbar-layout')

@section('title')
    <title>MIREA VIỆT NAM | Đăng nhập</title>
@endsection

@section('content')
    <div class="container py-4 py-lg-5 my-4">
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-md-6">
                <div class="card border-0 shadow">
                    <div class="card-body mt-4">
                        <image class="center-image-logo mb-4" src="{{asset('public/main/images/logo.png')}}"></image>
                        <h2 class="h4 mb-4 text-center">ĐĂNG NHẬP</h2>
                        @if (Session::has('message'))
                            <div class="alert alert-success" role="alert">
                                {{ Session::get('message') }}
                            </div>
                        @endif
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
                        <hr class="mb-4">
                        <form action="{{route('user.check')}}" method="post">
                            @csrf
                            <span class="text-danger small">@error('email'){{$message}}@enderror</span>
                            <div class="input-group mb-3"><i class="ci-mail position-absolute top-50 translate-middle-y text-muted fs-base ms-3"></i>
                                <input class="form-control rounded-start" type="email" placeholder="{{__('main.Email-address')}}" name="email" value="{{old('email')}}">

                            </div>
                            <span class="text-danger small">@error('password'){{$message}}@enderror</span>
                            <div class="input-group mb-3"><i class="ci-locked position-absolute top-50 translate-middle-y text-muted fs-base ms-3"></i>
                                <div class="password-toggle w-100">
                                    <input class="form-control" type="password" placeholder="{{__('main.Password')}}" name="password" value="{{old('password')}}">
                                    <label class="password-toggle-btn" aria-label="Show/hide password">
                                        <input class="password-toggle-check" type="checkbox"><span class="password-toggle-indicator"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="d-flex flex-wrap justify-content-between">
                                <div>
                                    <a class="nav-link-inline fs-sm" href="{{route('main.index')}}"><i class="ci-home me-2 ms-n21"></i>Trang chủ</a>
                                </div>
                                <a class="nav-link-inline fs-sm" href="{{route('user.password-recovery')}}">Quên mật khẩu?</a>
                            </div>
                            <hr class="mt-3">
                            <div class="text-center pt-4">
                                <button class="btn btn-primary" type="submit"><i class="ci-sign-in me-2 ms-n21"></i>Đăng nhập</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
