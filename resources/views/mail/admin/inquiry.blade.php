@component('mail::message')

@component('mail::panel')
 <p>
     <b>{{trans('label.name')}}:</b>
     {{$contact['name']??null}}
</p>
<p>
    <b>{{trans('label.email')}}:</b>
    {{$contact['email']??null}}
</p>
<p>
    <b>{{trans('label.phone_number')}}:</b>
    {{$contact['phone']??null}}
</p>
<p>
    <b>{{trans('label.description')}}:</b>
    {{$contact['description']??null}}
</p>
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
