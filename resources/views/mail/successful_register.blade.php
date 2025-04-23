@component('mail::message')

{{-- @component('mail::panel') --}}

Hi {{ isset($notifiable->first_name) ? $notifiable->full_name : $notifiable->company_name }},

{{-- Welcome to {{ env('APP_NAME', 'Jamaica') }}...!!! --}}
Welcome to the JobTrends India.  You have successfully created an account.  You will be able to;

* View Job Postings
* Apply for listed Jobs
* Apply for listed Jobs
* Manage communication with potential employers
{{-- @endcomponent --}}

{{trans('label.thanks_')}}<br>
{{ config('app.name') }}
@endcomponent
