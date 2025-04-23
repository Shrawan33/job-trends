@component('mail::message')
    <div style="padding: 40px; padding-top: 28px;">
        <p style="font-size: 16px; color: #1B2432; font-weight: 400;margin-bottom: 0px;font-family: 'Inter', sans-serif;border-bottom: 1px solid #ECE9FF; padding-bottom: 28px;"><b>Hi, {{ isset($notifiable->first_name) ? $notifiable->full_name : $notifiable->company_name }},</b></p>
        <p style="font-size: 15px; color: #1B2432; font-weight: 400;margin-bottom: 10px; margin-top: 28px;">Your {{ isset($notifiable->first_name) ? $notifiable->full_name : $notifiable->company_name }} account was removed Successfully.</p>
        <p style="font-size: 15px; color: #1B2432; font-weight: 600;margin-bottom: 0px;">{{ config('app.name') }}</p>
    </div>
@endcomponent
