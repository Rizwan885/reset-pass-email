@component('mail::message')
<h3>Welcome, {{ $user->name }}</h3>

<p>Click on below link to reset password</p>

@component('mail::button', ['url' => 'http://localhost:8000/resetpassword'])
Reset Password
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
