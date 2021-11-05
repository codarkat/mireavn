@component('mail::message')
# Đóng góp ý tưởng

<p>EMAIL: <h3><strong>{{ $email }}</strong></h3></p>
<p>Nội dung: </p>
<strong>
"{{ $ideas }}"
</strong>

@endcomponent
