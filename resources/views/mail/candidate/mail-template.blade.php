@component('mail::message')

@component('mail::panel')

This Email has been sent by {{$employer??null}}

{!!' '.$message??null!!}
@endcomponent

{{trans('label.thanks_')}}<br>
{{ config('app.name') }}
@endcomponent
