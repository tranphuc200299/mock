@component('mail::message')
Forgot password mail

Your email: {{ $email }} <br>
Your new password: {{ $password }}

@component('mail::button', ['url' => $url ])
    Comeback login page
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
