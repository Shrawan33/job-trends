@component('mail::message')
<p>Hi <strong>{{ $applicant->full_name ?? '' }}</strong>,</p>

<p>Great news! Your application for <strong>{{ $job->title ?? '' }}</strong> at <strong>{{ $application->employerJob->createdByUser->company_name ?? '' }}</strong> has been successfully submitted. 🚀</p>


<h3>What’s Next?</h3>
<ul>
    <li>🔹 The employer will review your application and contact you if shortlisted.</li>
    <li>🔹 Stay ahead! Keep your profile updated to increase your chances of getting noticed.</li>
</ul>

<p><strong>🔗 Track Your Application & Explore More Jobs:</strong></p>
<p>
    <a href="{{ route('login') }}" style="display: inline-block; padding: 10px 15px; color: #fff; background-color: #007bff; text-decoration: none; border-radius: 5px;">
        Login to Your Account
    </a>
</p>


<h3>Need Help?</h3>
<p>Get a professional resume, LinkedIn makeover, and career guidance to boost your chances! Explore our expert services here.</p>

<p>
    <a href="{{ route('career-service') }}" style="display: inline-block; padding: 10px 15px; color: #fff; background-color: #28a745; text-decoration: none; border-radius: 5px;">
        Get Hired Now!
    </a>
</p>

<p>Wishing you success!</p>

<p>{{ trans('label.thanks_') }}<br>
<strong>{{ config('app.name') }}</strong></p>
@endcomponent
