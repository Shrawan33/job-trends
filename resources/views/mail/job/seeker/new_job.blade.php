@component('mail::message')

@component('mail::panel')
{{ str_replace(['@name'], [$notifiable->getName()], config('sms.contents.new_job')) }}
@endcomponent

{{trans('label.thanks_')}}<br>
{{ config('app.name') }}
@endcomponent
