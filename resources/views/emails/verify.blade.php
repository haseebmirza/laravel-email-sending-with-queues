@component('mail::message')
# Verify Your Email

Please click the button below to verify your email address.

@component('mail::button', ['url' => url('/verify-email/' . $token)])
Verify Email
@endcomponent

This verification link will expire in 5 minutes.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
