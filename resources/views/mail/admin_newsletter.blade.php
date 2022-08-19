@component('mail::message')
Hi 

<p>Newsletter new subscribe</p>

<p>Email - {{ $user->email }}</p>

Thanks,<br>
{{ config('app.name') }}
@endcomponent