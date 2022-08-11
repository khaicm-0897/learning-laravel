@component('mail::message')
# Hi, {{ $user->name }}

Have a good day!

Thanks,<br>
{{ config('app.name') }}
@endcomponent
