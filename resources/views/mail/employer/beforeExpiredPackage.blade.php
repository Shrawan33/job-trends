@component('mail::message')

@component('mail::panel')

Hello {{ $notifiable->company_name }},

<p>
  Your Package {{$package->package_info['title'] ?? null }} has been expired, with in {{$duration??null}} days. please renew or buy a new package to continue using our premium features.
</p>

@endcomponent

{{trans('label.thanks_')}}<br>
{{ config('app.name') }}
@endcomponent
