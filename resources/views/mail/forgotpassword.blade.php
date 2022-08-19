@component('mail::message')
Hi {{$user->name}},

<p>Forgot Your Password?</p>

<p>No problem,  “ please don’t forget your neighbors ! “ Click the link below to reset your password</p>

@component('mail::button', ['url' => url('reset-password/'.$user->remember_token)])
Reset Your Password
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent