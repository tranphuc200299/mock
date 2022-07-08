@component('mail::message')
Verify mail

@component('mail::button', ['url' => $url ])
    Authorize your email
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
