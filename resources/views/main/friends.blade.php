@extends('layouts.main-layout')

@section('title')
    <title>MIREA VIỆT NAM | Bạn bè</title>
@endsection

@section('content')
    @include('partials-main.page-title')
    <div class="container mb-5 pb-3">
        <div class="bg-dark shadow-lg rounded-3 overflow-hidden">
            <!-- Content-->
            <section class="m-5">
                <h1 class="title text-light">DANH SÁCH BẠN BÈ</h1>
                <div class="row">
                    @foreach($dataFriends as $friend)
                        <div class="col-lg-4 col-md-6 col-sm-12 mt-4">
                            <div class="d-flex align-items-center pb-3">
                                <div class="img-thumbnail rounded-circle position-relative flex-shrink-0" style="width: 6.375rem;">
                                    <img class="rounded-circle" src="{{$urlPhoto}}/{{$friend->image}}" alt="Avatar"></div>
                                <div class="ps-3">
                                    <h3 class="text-light fs-lg mb-0">{{$friend->name}}</h3>
                                    <span class="d-block text-light fs-ms opacity-60 py-1">{{$friend->email}}</span>
                                    <div id="user-status-{{$friend->id}}">
                                    @if($friend->status == \App\Enums\StatusEnum::ACTIVE)

                                        <span class="badge bg-success"><i class="ci-check me-2"></i>Online</span>
                                    @else
                                        <span class="badge bg-danger"><i class="ci-delete-location me-2"></i>Offline</span>
                                    @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        </div>
    </div>
@endsection
@section('script')
    <script>

    </script>
@endsection
