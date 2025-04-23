@component('mail::message')
<p>Dear <strong>{{ $notifiable->company_name ?? '' }}</strong>,</p>

<p>A new candidate has just applied for the position of <strong>{{ $job->title ?? '' }}</strong> at <strong>{{ $notifiable->company_name ?? '' }}</strong> on <strong>JobTrendsIndia.com</strong>.</p>

<p><strong>🔹 Candidate Name:</strong> {{ $applicant->full_name ?? 'a candidate' }}<br>
<strong>🔹 Application Date:</strong> {{ $application->created_at ?? '' }}<br>
<strong>🔹 Resume & Details:</strong> Login to Your Employer Dashboard</p>

<h3>What’s Next?</h3>
<ul>
    <li>✔️ Review applications and shortlist the best fit.</li>
    <li>✔️ Use our advanced analytics to evaluate candidate compatibility.</li>
    <li>✔️ Need more reach? Boost your job post for higher visibility.</li>
</ul>

<p><strong>🔗 Access Your Dashboard & Manage Applications:</strong></p>
<p><a href="{{ route('login') }}" style="display: inline-block; padding: 10px 15px; color: #fff; background-color: #007bff; text-decoration: none; border-radius: 5px;">Login Now</a></p>

<p>For any assistance, feel free to contact us. Happy hiring!</p>

<p>{{ trans('label.thanks_') }}<br>
<strong>{{ config('app.name') }}</strong></p>
@endcomponent
