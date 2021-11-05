@extends('layouts.main-without-navbar-layout')

@section('title')
    <title>MIREA VIỆT NAM | Khôi phục mật khẩu</title>
@endsection

@section('content')
    <div class="container py-4 py-lg-5 my-4">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <h2 class="h3 mb-4">Thay đổi mật khẩu của bạn</h2>

                <div class="card py-2 mt-4">

                    <form class="card-body needs-validation" action="{{ route('reset.password.post') }}" method="POST">


                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="mb-3">

                            <label for="email_address" class="col-md-4 col-form-label text-md-right">E-Mail
                                Address</label>

                            <input type="text" id="email_address" class="form-control" name="email" required autofocus>
                            @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif


                            <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

                            <input type="password" id="password" class="form-control" name="password" required
                                   autofocus>
                            @if ($errors->has('password'))
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                            @endif


                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirm
                                Password</label>

                            <input type="password" id="password-confirm" class="form-control"
                                   name="password_confirmation" required autofocus>
                            @if ($errors->has('password_confirmation'))
                                <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                            @endif

                        </div>

                        <button type="submit" class="btn btn-primary">
                            Reset Password
                        </button>


                    </form>


                </div>
            </div>
        </div>
    </div>
@endsection
