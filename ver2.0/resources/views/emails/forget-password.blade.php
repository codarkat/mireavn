@component('mail::message')
# PHIẾU BẦU CỬ ĐIỆN TỬ

Chào {{ $details['name'] }},<br>
Chúng tôi đã nhận được yêu cầu đặt lại mật khẩu MIREA VIỆT NAM của bạn.<br>
Bạn có thể đặt lại mật khẩu theo liên kết này:
<a href="{{ route('reset.password.get', $details['token']) }}">Reset Password</a>

@component('mail::button', ['url' => 'https://mireavn.ru'])
Truy cập trang web
@endcomponent

Thân gửi,<br>
{{ config('app.name') }}
@endcomponent
