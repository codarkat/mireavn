@extends('layouts.main-layout')

@section('title')
    <title>MIREA VIỆT NAM | Tài khoản</title>
@endsection

@section('content')
    @include('partials-main.page-title')
    <div class="container mb-5 pb-3">
        <div class="bg-light shadow-lg rounded-3 overflow-hidden">
            <div class="row">
                <!-- Sidebar-->
                <aside class="col-lg-4 pe-xl-5">
                    <!-- Account menu toggler (hidden on screens larger 992px)-->
                    <div class="d-block d-lg-none p-4"><a class="btn btn-outline-accent d-block" href="#account-menu" data-bs-toggle="collapse"><i class="ci-menu me-2"></i>MENU</a></div>
                    <!-- Actual menu-->
                    <div class="h-100 border-end mb-2">
                        <div class="d-lg-block collapse" id="account-menu">
                            <div class="bg-secondary p-4">
                                <h3 class="fs-sm mb-0 text-muted">Tài khoản</h3>
                            </div>
                            <ul class="list-unstyled mb-0">
                                <li class="border-bottom mb-0"><a class="nav-link-style d-flex align-items-center px-4 py-3 active" href="{{route('user.user-settings')}}"><i class="ci-settings opacity-60 me-2"></i>Cài đặt</a></li>
                                <li class="border-bottom mb-0"><a class="nav-link-style d-flex align-items-center px-4 py-3" href="{{route('main.index')}}"><i class="ci-home opacity-60 me-2"></i>Trang chủ</a></li>
                                <li class="mb-0"><a class="nav-link-style d-flex align-items-center px-4 py-3 pointer" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="ci-sign-out opacity-60 me-2"></i>Đăng xuất</a>
                                    <form action="{{route('user.logout')}}" method="post" class="d-none" id="logout-form">@csrf</form></li>
                                <hr>
                            </ul>
                        </div>
                    </div>
                </aside>
                <!-- Content-->
                <section class="col-lg-8 pt-lg-4 pb-4 mb-3">
                    <div class="pt-2 px-4 ps-lg-0 pe-xl-5">
                        <h2 class="h3 py-2 text-center text-sm-start">Cài đặt</h2>
                        <!-- Profile-->
                        <div class="tab-pane fade show active" id="profile" role="tabpanel">
                            <div class="bg-primary rounded-3 p-4 mb-4">
                                <div class="d-flex align-items-center ">
                                    <img class="rounded-circle account-avatar" src="{{$urlPhoto}}/{{$dataUser->image}}" width="90" alt="Avatar">
                                    <div class="ps-3">
                                        <button class="btn btn-light btn-shadow btn-sm mb-2" type="button" id="button-change-image"><i class="ci-loading me-2"></i>{{__('main.Change-avatar')}}</button>
                                        <input type="file" id="account-image" style="display: none" class="image_upload">
                                        <div class="p mb-0 fs-ms text-white">{{__('main.Upload-JPG-GIF-or-PNG-image-Max-upload-size-is-2MB-only')}}</div>
                                    </div>
                                </div>
                            </div>

                            <div class="row gx-4 gy-3">
                                <div class="col-md-6 col-sm-12">
                                        <label class="form-label" for="account-fn">{{__('main.Full-name')}}</label>
                                        <input name="name" class="form-control" type="text" id="account-fn" value="{{$dataUser->name}}" disabled>
                                        <span class="text-danger text-error small name-error"></span>
                                    </div>
                                <div class="col-md-6 col-sm-12">
                                        <label class="form-label" for="account-email">{{__('main.Email-address')}}</label>
                                        <input name="email" class="form-control" type="email" id="account-email" value="{{$dataUser->email}}" disabled>
                                        <span class="text-danger text-error small email-error"></span>
                                    </div>
                                <form id="form-change-password" action="{{route('user.changePassword')}}" method="post">
                                    @csrf
                                    <div class="row gx-4 gy-3">
                                        <div class="col-md-6 col-sm-12">
                                                <label class="form-label" for="account-pass">{{__('main.New-password')}}</label>
                                                <div class="password-toggle">
                                                    <input name="npassword" class="form-control" type="password" id="account-pass">
                                                    <label class="password-toggle-btn" aria-label="Show/hide password">
                                                        <input class="password-toggle-check" type="checkbox"><span class="password-toggle-indicator"></span>
                                                    </label>
                                                </div>
                                                <span class="text-danger text-error small npassword-error"></span>
                                            </div>
                                        <div class="col-md-6 col-sm-12">
                                                <label class="form-label" for="account-confirm-pass">{{__('main.Confirm-password')}}</label>
                                                <div class="password-toggle">
                                                    <input name="cpassword" class="form-control" type="password" id="account-confirm-pass">
                                                    <label class="password-toggle-btn" aria-label="Show/hide password">
                                                        <input class="password-toggle-check" type="checkbox"><span class="password-toggle-indicator"></span>
                                                    </label>
                                                </div>
                                                <span class="text-danger text-error small cpassword-error"></span>
                                            </div>
                                        <div class="col-12">
                                                <hr class="mt-2 mb-4">
                                                <div class="d-sm-flex justify-content-center align-items-center">
                                                    <button class="btn btn-primary mt-3 mt-sm-0" type="submit">Lưu thay đổi</button>
                                                </div>
                                            </div>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    @include('partials-main.modal')

@endsection

@section('script')
    <script>

        $('#button-change-image').click(function (){
            $('#account-image').click();
        });


        var modal_crop = $('#modal_crop_image');
        var image_crop = document.getElementById('image_crop');
        var cropper;

        $("body").on("change", ".image_upload", function(e){
            var files = e.target.files;

            //Check File Image
            const file_check = this.files[0];
            var t = file_check.type.split('/').pop().toLowerCase();
            if (t != "jpeg" && t != "jpg" && t != "png" && t != "bmp" && t != "gif") {
                Toastify({
                    text: "{{__('notifications.ERROR.Please select a valid image file')}}",
                    duration: 3000,
                    close: true,
                    gravity: "bottom",
                    position: "center",
                    backgroundColor: "#F55260",
                    stopOnFocus: true,
                }).showToast();
                document.getElementById('account-image').value = '';
                return false;
            }

            //Check File Size
            var fsize = (file_check.size / 1024 / 1024).toFixed(2);
            if (fsize > 2 ) {
                Toastify({
                    text: "{{__('notifications.ERROR.Max upload size')}}",
                    duration: 3000,
                    close: true,
                    gravity: "bottom",
                    position: "center",
                    backgroundColor: "#F55260",
                    stopOnFocus: true,
                }).showToast();
                document.getElementById('account-image').value = '';
                return false;
            }

            var done = function (url) {
                image_crop.src = url;
                modal_crop.modal('show');
            };
            var reader;
            var file;
            var url;

            if (files && files.length > 0) {
                file = files[0];

                if (URL) {
                    done(URL.createObjectURL(file));
                } else if (FileReader) {
                    reader = new FileReader();
                    reader.onload = function (e) {
                        done(reader.result);
                    };
                    reader.readAsDataURL(file);
                }
            }
        });

        modal_crop.on('shown.bs.modal', function () {
            cropper = new Cropper(image_crop, {
                aspectRatio: 1,
                viewMode: 3,
                preview: '.preview_image'
            });
        }).on('hidden.bs.modal', function () {
            cropper.destroy();
            cropper = null;
        });

        $("#crop").click(function(){
            canvas = cropper.getCroppedCanvas({
                width: 160,
                height: 160,
            });

            canvas.toBlob(function(blob) {
                url = URL.createObjectURL(blob);
                var reader = new FileReader();
                reader.readAsDataURL(blob);
                reader.onloadend = function() {
                    var base64data = reader.result;
                    var token = '{{csrf_token()}}';
                    $.ajax({
                        type: "POST",
                        dataType: "json",
                        url: "{{route('user.updateAvatar')}}",
                        data: {
                            '_token': token,
                            'image': base64data,
                        },
                        success: function(data){
                            modal_crop.modal('hide');

                            $(".account-avatar").attr("src",data.url);

                            if(data.code == 1){
                                Toastify({
                                    text: "{{__('notifications.SUCCESS.Change avatar')}}",
                                    duration: 3000,
                                    close: true,
                                    gravity: "bottom",
                                    position: "center",
                                    backgroundColor: "#39DA8A",
                                    stopOnFocus: true,
                                }).showToast();
                            } else {
                                Toastify({
                                    text: "{{__('notifications.ERROR.Change avatar')}}",
                                    duration: 3000,
                                    close: true,
                                    gravity: "bottom",
                                    position: "center",
                                    backgroundColor: "#F55260",
                                    stopOnFocus: true,
                                }).showToast();
                            }

                        }
                    });
                }
            });
        })

        $('#form-change-password').on('submit', function(e){
            e.preventDefault();
            var form = this;
            //$('#product-edit-spinner-loading').html('<span class="spinner-border spinner-border-sm"></span>');

            $.ajax({
                url: $(form).attr('action'),
                method: $(form).attr('method'),
                dataType: 'json',
                contentType: false,
                processData: false,
                data: new FormData(this),
                beforeSend:function (){
                    $(form).find('span.text-error').text('');
                },
                success: function(data){
                    if(data.code == 0){
                        $.each(data.error, function(prefix, val){
                            //$('#product-edit-spinner-loading').html('');
                            $(form).find('span.'+prefix+'-error').text(val[0]);
                            $(form)[0].reset();
                        });
                        Toastify({
                            text: "{{__('notifications.ERROR.Update password')}}",
                            duration: 3000,
                            close: true,
                            gravity: "bottom",
                            position: "center",
                            backgroundColor: "#F55260",
                            stopOnFocus: true,
                        }).showToast();
                    } else {
                        Toastify({
                            text: "{{__('notifications.SUCCESS.Update password')}}",
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
        });

    </script>
@endsection

