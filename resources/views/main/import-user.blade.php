@extends('layouts.main-layout')

@section('title')
    <title>MIREA VIỆT NAM | IMPORT ACCOUNT</title>
@endsection

@section('content')
    <div class="page-title-overlap bg-accent pt-4">
        <div class="container d-flex flex-wrap flex-sm-nowrap justify-content-center justify-content-sm-between align-items-center pt-2">
            <div class="d-flex align-items-center pb-3">
                <div class="img-thumbnail rounded-circle position-relative flex-shrink-0" style="width: 6.375rem;">
                    <img class="rounded-circle" src="{{asset('public/main/images/AVATAR/avatar.png')}}" alt="Avatar"></div>
                <div class="ps-3">
                    <h3 class="text-light fs-lg mb-0">Lê Đình Cường</h3>
                    <span class="d-block text-light fs-ms opacity-60 py-1">dinhcuong.firewin99@gmail.com</span>
                    <span class="badge bg-success"><i class="ci-check me-2"></i>Online</span>
                </div>
            </div>
            <div class="d-flex">
                <div class="text-sm-end">
                    <!-- Facebook -->
                    <a href="#" class="btn-social bs-sm rounded-circle bs-facebook">
                        <i class="ci-facebook"></i>
                    </a>

                    <!-- Twitter -->
                    <a href="#" class="btn-social bs-sm rounded-circle bs-twitter">
                        <i class="ci-twitter"></i>
                    </a>

                    <!-- Instagram -->
                    <a href="#" class="btn-social bs-sm rounded-circle bs-instagram">
                        <i class="ci-instagram"></i>
                    </a>

                    <!-- Google -->
                    <a href="#" class="btn-social bs-sm rounded-circle bs-google">
                        <i class="ci-google"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="container mb-5 pb-3">
        <div class="bg-light shadow-lg rounded-3 overflow-hidden">
            <!-- Content-->
            <section class="m-5">
                <div class="file-drop-area">
                    <div class="file-drop-icon ci-cloud-upload"></div>
                    <span class="file-drop-message">Drag and drop here to upload</span>
                    <input type="file" class="file-drop-input">
                    <button type="button" class="file-drop-btn btn btn-primary btn-sm">Or select file</button>
                </div>
            </section>
        </div>
    </div>

@endsection

@section('script')
    <script>

    </script>
@endsection

