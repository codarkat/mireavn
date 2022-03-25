@extends('layouts.main-layout')

@section('title')
    <title>MIREA VIỆT NAM</title>
@endsection

@section('content')
    <section class="bg-secondary py-4 pt-md-5" style="background-image: url({{asset('public/main/img/intro/intro-hero.jpg')}});">
        <div class="container py-xl-2">
            <div class="row">
                <!-- Slider     -->
                <div class="col-xl-9 pt-xl-4 order-xl-2 d-flex justify-content-center align-items-center">
                    <div class="tns-carousel">
                        <div class="tns-carousel-inner" data-carousel-options="{&quot;items&quot;: 1, &quot;controls&quot;: false, &quot;loop&quot;: false}">
                            <div>
                                <div class="align-items-center">
                                    <div class="offset-lg-1 order-md-1 pt-4 pb-md-4 text-center text-md-start">
                                        <h5 class="fw-light pb-1 from-bottom text-white">BAN CHẤP HÀNH CHI ĐOÀN MIREA</h5>
                                        <h1 class="display-4 from-bottom delay-1 text-white">PHIẾU BẦU CỬ ONLINE</h1>
                                        <p class="fw-light pb-3 from-bottom delay-2 text-white">Powered by <strong><a class="text-white" href="{{route('main.club-ikbo')}}">{{config('app.club_name')}}</a></strong></p>
                                        <div class="d-table scale-up delay-4 mx-auto mx-md-0"><a class="btn btn-primary btn-shadow" href="{{route('user.page-vote')}}">Bầu cử ngay<i class="ci-arrow-right ms-2 me-n1"></i></a></div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="align-items-center">
                                    <div class="offset-lg-1 order-md-1 pt-4 pb-md-4 text-center text-md-start">
                                        <h5 class="fw-light pb-1 from-start text-white">BAN CHẤP HÀNH CHI ĐOÀN MIREA</h5>
                                        <h1 class="display-4 from-start delay-1 text-white">MIREA EDUCATION SYSTEM</h1>
                                        <p class="fw-light pb-3 from-start delay-2 text-white">(BETA)</p>
                                        <div class="d-table scale-up delay-4 mx-auto mx-md-0"><a class="btn btn-primary btn-shadow" href="https://edu.mireavn.ru/">Truy cập<i class="ci-arrow-right ms-2 me-n1"></i></a></div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="align-items-center">
                                    <div class="offset-lg-1 order-md-1 pt-4 pb-md-4 text-center text-md-start">
                                        <h5 class="fw-light pb-1 scale-up text-white">BAN CHẤP HÀNH CHI ĐOÀN MIREA</h5>
                                        <h1 class="display-4 scale-up delay-1 text-white">ĐẠI HỘI THỂ THAO CỤM 4</h1>
                                        <p class="fw-light pb-3 scale-up delay-2 text-white">MIREA 2022</p>
                                        <div class="d-table scale-up delay-4 mx-auto mx-md-0"><a class="btn btn-primary btn-shadow" href="#">Coming soon<i class="ci-arrow-right ms-2 me-n1"></i></a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Banner group-->
                <div class="col-xl-3 order-xl-1 pt-4 mt-3 mt-xl-0 pt-xl-0">
                    <div class="table-responsive" data-simplebar>
                        <div class="d-flex d-xl-block">
                                <a class="d-flex align-items-center bg-faded-info rounded-3 pt-2 ps-2 mb-4 me-4 me-xl-0" href="{{route('user.page-vote')}}" style="min-width: 16rem;"><img src="{{asset('public/main/img/home/banners/vote.png')}}" width="125" alt="Banner">
                                <div class="py-4 px-2">
                                    <h5 class="mb-2 text-white"><span class="fw-light">Phiếu bầu cử</span><br>Trực tuyến<br><span class="fw-light">MIREA</span></h5>
                                    <div class="text-info fs-sm">Truy cập<i class="ci-arrow-right fs-xs ms-1"></i></div>
                                </div></a>
                                <a class="d-flex align-items-center bg-faded-warning rounded-3 pt-2 ps-2 mb-4 me-4 me-xl-0" href="https://edu.mireavn.ru/" style="min-width: 16rem;"><img src="{{asset('public/main/img/home/banners/edu.png')}}" width="125" alt="Banner">
                                <div class="py-4 px-2">
                                    <h5 class="mb-2 text-white"><span class="fw-light">MIREA</span><br>EDUCATION<br><span class="fw-light">SYSTEM</span></h5>
                                    <div class="text-warning fs-sm">Truy cập<i class="ci-arrow-right fs-xs ms-1"></i></div>
                                </div></a>
                                <a class="d-flex align-items-center bg-faded-success rounded-3 pt-2 ps-2 mb-4" href="#" style="min-width: 16rem;"><img src="{{asset('public/main/img/home/banners/thethao.png')}}" width="125" alt="Banner">
                                <div class="py-4 px-2">
                                    <h5 class="mb-2 text-white"><span class="fw-light">ĐẠI HỘI</span><br>THỂ THAO<br><span class="fw-light">CỤM 4</span><br>MIREA 2022</h5>
                                    <div class="text-success fs-sm">Coming soon<i class="ci-arrow-right fs-xs ms-1"></i></div>
                                </div></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('script')

@endsection
