@component('mail::message')


@component('mail::button', ['url' => $verificationUrl])
Visit Our Website
@endcomponent

Thanks,
{{ config('app.name') }}
@endcomponent
