@extends('layouts.main-layout')

@section('title')
    <title>MIREA VIỆT NAM</title>
@endsection

@section('content')
    <section class="bg-accent bg-position-center bg-size-cover py-3 py-sm-5" style="background-image: url({{asset('public/main/img/intro/intro-hero.jpg')}});">
        <div class="container py-5">
            <div class="row pt-md-5 pb-lg-5 justify-content-center">
                <div class="col-xl-7 col-lg-8 col-md-10 text-center py-xl-3">
                    <span class="d-inline-block h5 text-light fw-light mx-2 opacity-70">BAN CHẤP HÀNH CHI ĐOÀN MIREA</span>
                    <h1 class="text-light pb-sm-3"><span class='fw-light'><strong>PHIẾU BẦU CỬ ONLINE </strong></span></h1>
                    <hr class="mb-2">
                    <span class="d-inline-block small text-light fw-light mx-2 opacity-60">Powered by <strong><a class="text-white" href="{{route('main.club-ikbo')}}">IKBO SOFTWARE</a></strong></span>
                    <div class="py-4 py-sm-5"><a class="btn btn-primary btn-lg" href="{{route('user.page-vote')}}">Bầu cử ngay<i class="ci-check ms-2"></i></a></div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('script')
@endsection
