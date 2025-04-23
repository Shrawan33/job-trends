@component('mail::message')

@component('mail::panel')

<b>Hi, {{ $notifiable->full_name }},</b>

Your Password has been changed successfully. please click on below link and do sign in with your new password.<br>
<a href="{{route('login')}}">Login</a>
@endcomponent

<div style="border-top: 1px solid #ECE9FF; padding-top: 30px; color: black;">
    {{trans('label.thanks_')}}<br>
    {{ config('app.name') }}
    </div>
@endcomponent
