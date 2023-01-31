@extends('layouts.admin-layout')

@section('title')
    <title>MIREA VIETNAM | ADMIN</title>
@endsection

@section('content')
    <div class="content-wrapper container">
        <div class="page-heading">
            <h6 class="text-center">BAN CHẤP HÀNH CHI ĐOÀN MIREA</h6>
        </div>

        <div class="page-content">
            <section>
                <div class="card">
                    <div class="card-content">
                        <div class="card-body m-5">
                            <div class="d-flex justify-content-center" style="background-image: url(https://media.giphy.com/media/j2AqKHK9rq217Ag8EX/giphy.gif);">
                                <image style="width: 100px" src="{{asset('public/main/images/logo.png')}}"></image>
                            </div>
                            <h1 class="text-center mt-5">ĐẠI HỘI CHI ĐOÀN</h1>
                            <p class="text-center">Nhiệm kỳ: 2021-2022</p>
                        </div>
                    </div>
                </div>
            </section>
        </div>

    </div>
@endsection
