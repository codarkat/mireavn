<div class="modal fade" id="modal_crop_image" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">{{__('main.Change avatar')}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="img-container">
                    <div class="row">
                        <div class="col-md-6">
                            <img id="image_crop" src="https://avatars0.githubusercontent.com/u/3456749">
                        </div>
                        <div class="col-md-1"></div>
                        <div class="col-md-4 d-flex justify-content-center">
                            <div class="preview_image rounded-circle"></div>
                        </div>
                        <div class="col-md-1">
                        </div>
                        <style>
                            .preview_image {
                                width:100%;
                                height:100%;
                                object-fit: cover;
                                overflow: hidden;
                            }
                        </style>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">{{__('main.Close')}}</button>
                <button type="button" class="btn btn-primary btn-sm"  id="crop">{{__('main.Save')}}</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-idea" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-center">
                <h5 class="modal-title" id="modalLabel"><strong>Góp ý kiến phát triển</strong></h5>
            </div>
            <div class="modal-body">
                <p>
                    <em>
                        Chúng tôi luôn muốn nhật được sự ủng hộ, đồng hành của tất cả mọi người để chúng ta có thể cùng nhau có được những trải nghiệp tốt hơn nhờ việc ứng dụng của công nghệ mới vào đời sống.
                        <br>Vì vậy chúng tôi có một hòm thư góp ý để biết được những mong muốn của các bạn.
                        <br>Chúng tôi tôn trọng những ý kiến đóng góp và sẽ cố gắng thực hiện nó nếu khả thi.
                        <br>Trân trọng cảm ơn tất cả mọi người!
                    </em>
                </p>
            </div>
            <form id="contribute-ideas" action="{{route('user.contribute-ideas')}}" method="post">
                @csrf
                @if (Route::has('user.login'))
                    @auth
                        <input type="hidden" id="email-send" name="email" value="{{Auth::user()->email}}">
                    @endauth
                @endif
                <div class="form-floating m-4">
                    <textarea class="form-control" id="ideas" name="ideas" style="height: 120px;" placeholder="Your message"></textarea>
                    <label for="fl-textarea">Lời nhắn</label>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">{{__('main.Close')}}</button>
                    <button type="submit" class="btn btn-primary btn-sm"><i class="ci-idea me-2"></i>Đóng góp</button>
                </div>
            </form>
        </div>
    </div>
</div>


