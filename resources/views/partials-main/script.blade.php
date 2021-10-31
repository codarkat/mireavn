<script src="{{asset('public/admin/vendor/global/global.min.js')}}"></script>
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
        console.log(data);
        console.log(data.status);
        console.log(data.user_id);
        console.log($('#user-status-'+data.user_id));
        var status = '';
        if(data.status == '{{\App\Enums\StatusEnum::ACTIVE}}'){
            status += `<span class="badge bg-success"><i class="ci-check me-2"></i>Online</span>`;
        } else {
            status += `<span class="badge bg-danger"><i class="ci-delete-location me-2"></i>Offline</span>`;
        }
        $('#user-status-'+data.user_id).html(status);
    });
</script>
