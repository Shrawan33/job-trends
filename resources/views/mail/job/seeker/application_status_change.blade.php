@component('mail::message')

@component('mail::panel')
{{-- Hello {{$notifiable->getName()}},

{{trans('message.'.strtolower(str_replace(' ', '-', $application->status)))}}<br> --}}

<p>Dear {{$notifiable->getName() ?? ''}},</p><br>

@if($application->status == 'Shortlisted')
<p>We are pleased to inform you that your application for the {{ $application->employerJob->title ?? '' }} position at {{ $application->employerJob->company_name ?? ''}} has been shortlisted. The employer will review your profile in detail and may contact you for the next steps.</p><br>
<p>Stay prepared and keep an eye on your inbox for further communication. You can track your application progress by logging into your account: <a href="{{ route('login') }}">JobTrendsIndia Login</a></p>

@elseif($application->status == 'Awaiting Review')
<p>Thank you for applying for the position of {{ $application->employerJob->title ?? '' }} at {{ $application->employerJob->company_name ?? ''}}. Your application has been successfully received, and our team is currently reviewing your qualifications.
</p><br>
<p>
    We will update you on the next steps soon. In the meantime, you can track your application status by logging into your account here: <a href="{{ route('login') }}">JobTrendsIndia Login</a>
</p><br>

@elseif ($application->status == 'Contacting')

@elseif($application->status == 'Rejected')
<p>We appreciate your interest in {{ $application->employerJob->title ?? '' }}  at  {{ $application->employerJob->company_name ?? ''}} . After careful consideration, the employer has decided to move forward with other candidates at this time.
</p><br>
<p>We encourage you to continue exploring other exciting opportunities on JobTrendsIndia. Keep refining your profile and applying for relevant roles. Your perfect job is just around the corner!
</p><br>
<p>Explore new opportunities by logging in here: <a href="{{ route('login') }}">JobTrendsIndia Login</a>
</p>


@elseif($application->status == 'Hired')
<p>We are thrilled to inform you that you have been hired for the {{ $application->employerJob->title ?? '' }} position at  {{ $application->employerJob->company_name ?? ''}} 🎉</p><br>
<p>The employer will reach out to you soon with further instructions regarding the onboarding process. Wishing you great success in your new role!
</p><br>
<p>You can log in to your account for further details: <a href="{{ route('login') }}">JobTrendsIndia Login</a>
</p>

@endif
@endcomponent
{{trans('label.thanks_')}}<br>
{{ config('app.name') }}
@endcomponent
