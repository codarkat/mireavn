@component('mail::message')
# PHIẾU BẦU CỬ ĐIỆN TỬ

Chào {{ $details['name'] }},<br>
Chúng tôi đã tạo tài khoản đăng nhập vào hệ thống của MIREA VIỆT NAM.<br>
Tài khoản này sẽ được sử dụng trong các hoạt động sắp tới trên hệ thống.<br>
Vui lòng không chia sẻ thông tin tài khoản cho người khác để đảm bảo quyền lợi của mình.<br>

<p>EMAIL: <h3><strong>{{ $details['email'] }}</strong></h3></p>
<p>PASSWORD: <h3><strong>{{ $details['password'] }}</strong></h3></p>

@component('mail::button', ['url' => 'https://mireavn.ru'])
Truy cập trang web
@endcomponent

Thân gửi,<br>
{{ config('app.name') }}
@endcomponent
