@extends('backend.layouts.auth-layout')

@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Login')

@section('content')
<div class="d-flex flex-column flex-root">
    <!--begin::Authentication - Sign-in -->
    <div class="d-flex flex-column flex-lg-row flex-column-fluid">
        <!--begin::Aside-->
        <div class="d-flex flex-column flex-lg-row-auto bg-primary w-xl-600px positon-xl-relative">
            <!--begin::Wrapper-->
            <div class="d-flex flex-column position-xl-fixed top-0 bottom-0 w-xl-600px scroll-y">
                <!--begin::Header-->
                <div class="d-flex flex-row-fluid flex-column text-center p-5 p-lg-10 pt-lg-20">
                    <!--begin::Logo-->
                    <a href="./backend/index-2.html" class="py-2 py-lg-20">
                        <img alt="Logo" src="./backend/assets/media/logos/logo-ellipse.svg" class="h-60px h-lg-70px" />
                    </a>
                    <!--end::Logo-->
                    <!--begin::Title-->
                    <h1 class="d-none d-lg-block fw-bold text-white fs-2qx pb-5 pb-md-10">MIREAVIETNAM</h1>
                    <!--end::Title-->
                    <!--begin::Description-->
                    <p class="d-none d-lg-block fw-semibold fs-2 text-white">"Nhìn về sự hoàn hảo để trân trọng sự chỉn
                        chu."
                    </p>
                    <!--end::Description-->
                </div>
                <!--end::Header-->
                <!--begin::Illustration-->
                <div class="d-none d-lg-block d-flex flex-row-auto bgi-no-repeat bgi-position-x-center bgi-size-contain bgi-position-y-bottom min-h-100px min-h-lg-350px"
                    style="background-image: url({{ asset('./backend/assets/media/illustrations/sigma-1/17.png') }})">
                </div>
                <!--end::Illustration-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--begin::Aside-->
        <!--begin::Body-->
        <div class="d-flex flex-column flex-lg-row-fluid py-10">
            <!--begin::Content-->
            <div class="d-flex flex-center flex-column flex-column-fluid">
                <!--begin::Wrapper-->
                <div class="w-lg-500px p-10 p-lg-15 mx-auto">
                    <!--begin::Form-->
                    @livewire('admin-login-form')
                    <!--end::Form-->
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Content-->
            <!--begin::Footer-->
            <div class="d-flex flex-center flex-wrap fs-6 p-5 pb-0">
                <!--begin::Links-->
                <div class="d-flex flex-center fw-semibold fs-6">
                    <a href="https://keenthemes.com/" class="text-muted text-hover-primary px-2"
                        target="_blank">About</a>
                    <a href="https://devs.keenthemes.com/" class="text-muted text-hover-primary px-2"
                        target="_blank">Support</a>
                    <a href="https://themes.getbootstrap.com/product/craft-bootstrap-5-admin-dashboard-theme"
                        class="text-muted text-hover-primary px-2" target="_blank">Purchase</a>
                </div>
                <!--end::Links-->
            </div>
            <!--end::Footer-->
        </div>
        <!--end::Body-->
    </div>
</div>
@endsection

@push('scripts')
<!-- <script src="./backend/assets/js/custom/authentication/sign-in/general.js"></script> -->
@endpush