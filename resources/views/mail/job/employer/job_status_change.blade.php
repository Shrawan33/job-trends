@component('mail::message')
    {{-- @component('mail::panel') --}}
    <div style="padding: 40px; padding-top: 28px;">
        <p><b>Hello {{ $notifiable->getName() }},</b></p>
        <p>Your job {{ $job->title ?? null }} is now {{ $status }} and live on website.</p>
        <p style="font-size: 15px; color: #1B2432; font-weight: 400;margin-bottom: 10px; margin-top: 28px;">
            {{ trans('label.thanks_') }}</p>
        <p style="font-size: 15px; color: #1B2432; font-weight: 600;margin-bottom: 0px;">
            {{ config('app.name') }}</p>
    </div>
@endcomponent
