@component('mail::message')
    {{-- @component('mail::panel') --}}
    <div style="padding: 40px; padding-top: 28px;">
        <p
            style="font-size: 16px; color: #1B2432; font-weight: 400;margin-bottom: 0px;font-family: 'Inter', sans-serif;border-bottom: 1px solid #ECE9FF; padding-bottom: 28px;">
            {{ str_replace(
                ['@name', '@code'],
                [$notifiable->getName(), $userVerification->getEmailVerificationCode()],
                config('sms.contents.email_verification'),
            ) }}
        </p>
        <p style="font-size: 15px; color: #1B2432; font-weight: 400;margin-bottom: 10px; margin-top: 28px;">
            {{ trans('label.thanks_') }}</p>
        <p style="font-size: 15px; color: #1B2432; font-weight: 600;margin-bottom: 0px;">
            {{ config('app.name') }}</p>
    </div>
@endcomponent
