@extends('layouts.main-without-navbar-layout')

@section('title')
    <title>MIREA VIỆT NAM | Khôi phục mật khẩu</title>
@endsection

@section('content')
    <div class="container py-4 py-lg-5 my-4">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <h2 class="h3 mb-4">Quên mật khẩu?</h2>
                <p class="fs-md">Thay đổi mật khẩu của bạn trong ba bước đưới đây.</p>
                <ol class="list-unstyled fs-md">
                    <li><span class="text-primary me-2">1.</span>Điền địa chỉ email của bạn vào ô dưới đây.</li>
                    <li><span class="text-primary me-2">2.</span>Chúng tôi sẽ gửi một liên kết thay đổi mật khẩu đến địa chỉ email của bạn.</li>
                    <li><span class="text-primary me-2">3.</span>Truy cập liên kết và làm theo hướng dẫn để nhận mật khẩu mới.</li>
                </ol>
                @if (Session::has('message'))
                    <div class="alert alert-success" role="alert">
                        {{ Session::get('message') }}
                    </div>
                @endif
                <div class="card py-2 mt-4">

                    <form class="card-body needs-validation" action="{{ route('forget.password.post') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label" for="email_address">Nhập địa chỉ email của bạn</label>
                            <input type="text" id="email_address" class="form-control" name="email" required autofocus>
                            @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                            <div class="invalid-feedback">Vui lòng nhập địa chỉ email hợp lệ.</div>
                        </div>


                        <button class="btn btn-primary" type="submit">Nhận mật khẩu mới</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
