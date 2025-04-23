@component('mail::message')
@component('mail::panel')
Hello,

Name: {{$user->first_name ?? ''}} {{$user->last_name ?? ''}}<br>
Email: {{$user->email ?? ''}}<br>
Phone Number: {{$user->phone_number ?? ''}}<br>
Detailed Instructions For Resume Writing: {{$user->seekerDetail->instruction_cv_writing ?? ''}}<br>
Linkedin URL: {{$user->seekerDetail->linkedin_link ?? ''}}
@php
    $links = $link ?? '#';
@endphp
Please <a href="{{$links}}">Click here</a> to download the uploaded resume.

{{ trans('label.thanks_') }}<br>
{{ config('app.name') }}<br>
@endcomponent
