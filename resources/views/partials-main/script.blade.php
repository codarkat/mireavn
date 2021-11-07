<script
    src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
    crossorigin="anonymous"></script>
<!-- Vendor scrits: js libraries and plugins-->
<script src="{{asset('public/main/vendor/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('public/main/vendor/simplebar/dist/simplebar.min.js')}}"></script>
<script src="{{asset('public/main/vendor/tiny-slider/dist/min/tiny-slider.js')}}"></script>
<script src="{{asset('public/main/vendor/smooth-scroll/dist/smooth-scroll.polyfills.min.js')}}"></script>
<!-- Main theme script-->
<script src="{{asset('public/main/js/theme.min.js')}}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.js" integrity="sha256-CgvH7sz3tHhkiVKh05kSUgG97YtzYNnWt6OXcmYzqHY=" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
<script src="https://kit.fontawesome.com/5a80452d2b.js" crossorigin="anonymous"></script>

@yield('script')

<script src="https://js.pusher.com/7.0/pusher-with-encryption.min.js"></script>
<script>
    var pusher = new Pusher('{{env("MIX_PUSHER_APP_KEY")}}', {
        cluster: '{{env("PUSHER_APP_CLUSTER")}}',
        encrypted: true
    });

    var channel = pusher.subscribe('mireavn');
    channel.bind('App\\Events\\UpdateChange', function(data) {
        if(data.active == 0){
            // console.log(data.active);
            var status = '';
            if(data.status == '{{\App\Enums\StatusEnum::ACTIVE}}'){
                status += `<span class="badge bg-success"><i class="ci-check me-2"></i>Online</span>`;
            } else {
                status += `<span class="badge bg-danger"><i class="ci-delete-location me-2"></i>Offline</span>`;
            }
            $('#user-status-'+data.user_id).html(status);
        } else {
            // Fix reload trang sau bầu cử
            // console.log(data.active);
            // window.location.reload(true);
        }
    });

    $('#contribute-ideas').on('submit', function(e){
        e.preventDefault();
        if(!$('#email-send').val()){
            Toastify({
                text: "{{__('Bạn cần đăng nhập để thực hiện chức năng này!')}}",
                duration: 3000,
                close: true,
                gravity: "bottom",
                position: "center",
                backgroundColor: "#F55260",
                stopOnFocus: true,
            }).showToast();
            return false;
        }

        if( !$('#ideas').val() ) {
            Toastify({
                text: "{{__('Lời nhắn đang trống!')}}",
                duration: 3000,
                close: true,
                gravity: "bottom",
                position: "center",
                backgroundColor: "#F55260",
                stopOnFocus: true,
            }).showToast();
            return false;
        }

        var form = this;

        $.ajax({
            url: $(form).attr('action'),
            method: $(form).attr('method'),
            dataType: 'json',
            contentType: false,
            processData: false,
            data: new FormData(this),
            success: function(data){
                if(data.code == 1){
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
    });
</script>
