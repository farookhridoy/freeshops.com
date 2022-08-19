@component('mail::message')
Hi {{ $user->name }},

<p>Thank you for contacting us, we are the neighbors, love to help each other , we are working on your response,  will  get back to you as soon as possible</p>

Thanks,<br>
{{ config('app.name') }}
@endcomponent