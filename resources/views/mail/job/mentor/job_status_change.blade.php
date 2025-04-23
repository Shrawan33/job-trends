@component('mail::message')

@component('mail::panel')
Hello {{$notifiable->getName()}},

New job available for Approval<br>

<b>Job Title: </b> {{$job->title??null}}

@endcomponent

{{trans('label.thanks_')}}<br>
{{ config('app.name') }}
@endcomponent
