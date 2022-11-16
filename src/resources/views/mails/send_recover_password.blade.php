@component('mail::message')
# Hello {{ $requestName }},<br /><br />

You are receiving this email because we received a password reset request for your account.<br /><br />

@component('mail::button', ['url' => $requestUrl])
Reset Password
@endcomponent

If you did not request a password reset, no further action is required.<br />

Kind regards,<br />
{{ config('app.name') }}<br /><br />

If you’re having trouble clicking the "Reset Password" button, copy and paste the URL below into your web browser:<br />
[{{$requestUrl}}]({{$requestUrl}})
@endcomponent
