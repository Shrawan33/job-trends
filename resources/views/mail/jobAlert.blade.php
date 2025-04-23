@component('mail::message')

@component('mail::panel')

<p>Dear {{ $notifiable->getName() ?? '' }},</p><br>

<p>We have exciting job opportunities that match your profile! 📢 Employers are actively looking for candidates like you. Don't miss out on your next career move.</p><br>
<p>
    Featured Jobs for You:
</p><br>
<p>

    ✅ {{ $employerJob->title ?? ''}} at {{ $employerJob->company_name ?? ''  }} – {{ $employerJob->address ?? '' }}
</p><br>
<p>Apply now and take the next step in your career! Click below to view and apply for these jobs:</p><br>
<a href="{{ route('job-detail', $employerJob->slug) }}" class="btn btn-primary mr-20 btn-sm">🔗 View Jobs & Apply</a><br>
<p>Stay ahead in your job search with JobTrendsIndia!</p>
@endcomponent

{{trans('label.thanks_')}}<br>
{{ config('app.name') }}
@endcomponent
