@component('mail::message')
    <div style="padding: 40px; padding-top: 28px;">
        <p
        style="font-size: 16px; color: #1B2432; font-weight: 400;margin-bottom: 0px;font-family: 'Inter', sans-serif; padding-bottom: 28px;"> <b>Hello {{ $notifiable->getName() }},</b> </p>
         <p
        style="font-size: 16px; color: #1B2432; font-weight: 400;margin-bottom: 0px;font-family: 'Inter', sans-serif; padding-bottom: 28px;">
         {{ $notifiable->getName() ?? null }} job you applied is now updated and you may</p>
         <p style="font-size: 15px; color: #1B2432; font-weight: 400;margin-bottom: 10px; margin-top: 28px;">
            {{ trans('label.thanks_') }}</p>
        <p style="font-size: 15px; color: #1B2432; font-weight: 600;margin-bottom: 0px;">
            {{ config('app.name') }}</p>
    </div>
@endcomponent
