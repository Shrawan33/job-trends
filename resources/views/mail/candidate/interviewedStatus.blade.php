@component('mail::message')
    {{-- @component('mail::panel') --}}
    <div style="padding: 40px; padding-top: 28px;">
        <p
            style="font-size: 16px; color: #1B2432; font-weight: 400;margin-bottom: 0px;font-family: 'Inter', sans-serif; padding-bottom: 28px;">
            <p
            style="font-size: 16px; color: #1B2432; font-weight: 400;margin-bottom: 0px;font-family: 'Inter', sans-serif; padding-bottom: 28px;"> <b>Hi {{ $notifiable->first_name }},</b></p>
            <p
            style="font-size: 16px; color: #1B2432; font-weight: 400;margin-bottom: 0px;font-family: 'Inter', sans-serif; padding-bottom: 28px;"><b>{{ $company_name }} has scheduled an interview for </b>: {{ $title }} </p>
            <p
            style="font-size: 16px; color: #1B2432; font-weight: 400;margin-bottom: 0px;font-family: 'Inter', sans-serif; padding-bottom: 28px;"><b>Interview DateTime</b>: {{ date('M d, Y g:i A', strtotime($interview->datetime)) }} </p>
            <p
            style="font-size: 16px; color: #1B2432; font-weight: 400;margin-bottom: 0px;font-family: 'Inter', sans-serif; padding-bottom: 28px;"> <b>Interview Link</b>: {{ $interview->interview_link }} </p>
            <p
            style="font-size: 16px; color: #1B2432; font-weight: 400;margin-bottom: 0px;font-family: 'Inter', sans-serif; padding-bottom: 28px;"><b>Description</b>: {{ $interview->description }} </p>
        </p>
        <p style="font-size: 15px; color: #1B2432; font-weight: 400;margin-bottom: 10px; margin-top: 28px;">
            {{ trans('label.thanks_') }}</p>
        <p style="font-size: 15px; color: #1B2432; font-weight: 600;margin-bottom: 0px;">
            {{ config('app.name') }}</p>
    </div>
@endcomponent
