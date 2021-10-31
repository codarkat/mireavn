@extends('layouts.main-layout')

@section('title')
    <title>MIREA VIỆT NAM | Phiếu bầu cử</title>
@endsection

@section('content')
    @include('partials-main.page-title')
    <div class="container mb-5 pb-3">
        <div class="bg-light shadow-lg rounded-3 overflow-hidden">
            <!-- Content-->
            <section class="m-5">
                <h1 class="title">PHIẾU BẦU CỬ ONLINE <small>(V2.0)</small></h1>
                <div style="background-image: url(https://media.giphy.com/media/j2AqKHK9rq217Ag8EX/giphy.gif);">
                    <image class="center-image-logo" src="{{asset('public/main/images/logo.png')}}"></image>
                </div>
                <h6 class="title h4 mt-3 mb-5">Nhiệm kỳ: 2021-2022</h6>
                <form class="form" id="form-vote" action="{{route('user.create-vote')}}" method="post">
                    @csrf
                    @if($dataSettings->status == \App\Enums\StatusEnum::INACTIVE)
                        <div class="alert alert-danger text-center">PHIẾU ĐANG BỊ ĐÓNG. VUI LÒNG QUAY LẠI SAU!</div>
                        <image class="center-image-success" src="https://media.giphy.com/media/3o6fJeVJSTSXqzwaSk/giphy.gif"></image>
                    @else
                        @if($checkVote)
                            <div class="alert alert-success text-center">Cảm ơn. Bạn đã bỏ phiếu thành công.</div>
                            <image class="center-image-success" src="https://media.giphy.com/media/eh7Uqh7n6HRjHQLs3y/giphy.gif"></image>
                        @else
                            <div class="alert alert-info" id="textTutorial">
                                <!--Content for textTutorial-->
                                <h5 class="alert-heading text-center"><strong>CÁCH THỨC BẦU CHỌN</strong></h5>
                                <p class="text-center">Lựa chọn {{$dataSettings->qty_receive}} trong {{$dataSettings->qty_total}} ứng viên phía dưới bằng cách ấn vào tên của họ. Bạn cần lựa chọn đủ, không thiếu không thừa thì mới có thể gửi phiếu đi. Để tránh số liệu ảo, chúng tôi chỉ cho phép bạn gửi đi một lần duy nhất.</p>
                            </div>
                            <div class="row" id="showPerson">
                                @foreach($dataCandidates as $candidate)
                                <div class="col-md-6 col-12">
                                    <input onclick="$(this).attr('value', this.checked ? 1 : 0)" type="checkbox" name="{{$candidate->user_id}}" id="{{$candidate->user_id}}" class="checkbox-input" value="0"/>
                                    <label for="{{$candidate->user_id}}" class="checkbox-label" style="background-image: url({{asset('public/main/images/mireacheckbox.jpg')}});">
                                        <div class="checkbox-text">
                                            @foreach($dataUsers as $user)
                                                @if($candidate->user_id == $user->id)
                                                    <p class="checkbox-text--title text-fit">{{$user->name}}</p>
                                                    @break
                                                @endif
                                            @endforeach
                                            <p class="checkbox-text--description">Ấn để <span class="un">bỏ</span> chọn!</p>
                                        </div>
                                    </label>
                                </div>
                                @endforeach
                                <div class="col-md-6 col-12">

                                </div>
                            </div>
                            <a style="margin-top: 20px"></a>
                            <div class="row">

                                <div class="col-12 d-flex justify-content-center" style="margin: 20px 0px;">
                                    <button type="submit" class="btn btn-lg btn-primary btn-block">GỬI ĐI</button>
                                </div>

                            </div>
                        @endif
                    @endif
                </form>
            </section>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $('#form-vote').on('submit', function(e){
            e.preventDefault();
            var form = this;

            var countChecked = 0;
            var resultCandidates = new Array();
            $('input[type=checkbox]').each(function (e) {
                var value = (this.checked ? "1" : "0");
                resultCandidates.push(parseInt(value));
                countChecked += parseInt(value);
            });

            if(parseInt(countChecked) !== parseInt({{$dataSettings->qty_receive}})){
                Toastify({
                    text: 'Lỗi. Chỉ được lựa chọn {{$dataSettings->qty_receive}} ứng viên.',
                    duration: 3000,
                    close: true,
                    gravity: "bottom",
                    position: "center",
                    backgroundColor: "#F55260",
                    stopOnFocus: true,
                }).showToast();
            } else {
                $.ajax({
                    url: $(form).attr('action'),
                    type: $(form).attr('method'),
                    data: {
                        id: {{Auth()->user()->id}},
                        result: JSON.stringify(resultCandidates),
                        _token: '{{csrf_token()}}'
                    },
                    success: function(data){
                        if(data.code == 0){
                            Toastify({
                                text: data.error,
                                duration: 3000,
                                close: true,
                                gravity: "bottom",
                                position: "center",
                                backgroundColor: "#F55260",
                                stopOnFocus: true,
                            }).showToast();
                        } else {
                            Toastify({
                                text: data.success,
                                duration: 3000,
                                close: true,
                                gravity: "bottom",
                                position: "center",
                                backgroundColor: "#39DA8A",
                                stopOnFocus: true,
                            }).showToast();
                        }
                    }
                });
            }
        });
    </script>
@endsection
