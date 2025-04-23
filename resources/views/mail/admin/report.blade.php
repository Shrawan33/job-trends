@component('mail::message')

@component('mail::panel')

{{ $report->createdByUser->full_name }} {{trans('label.has_reportyed')}}

{{$report->content??null}}

@endcomponent

{{trans('label.thanks_')}}<br>
{{ config('app.name') }}
@endcomponent
