@component('mail::message')

@component('mail::panel')
<p>Dear {{ $notifiable->hasRole('employer') ? $notifiable->company_name : $notifiable->full_name }},</p>
<br>
<p>Thank you for subscribing to {{ $package->package_info['title'] ?? '' }} on JobTrendsIndia! We are pleased to confirm that your payment of ₹{{$package->package_info['price'] ?? ''}} has been successfully received on {{ $package->created_at ?? '' }}.</p>
<br>
<p>Your subscription details:</p>
<br>
<p>Plan Name: {{ $package->package_info['title'] ?? '-' }}</p>
<br>
<p>Validity:  {{ $package->end_date ?? '-' }}</p>
<br>
<p>Features Included:{!! $package->package_info['description'] ?? '' !!}</p>
<br>
<p>You can now access your employer dashboard to post jobs, view candidate profiles, and manage your recruitment process efficiently.</p>
<br>
<p>🔹 Login to your account: <a href="{{ route('login') }}">{{ route('login') }}</a></p>
<br>
<p>If you have any questions or need assistance, feel free to reach out to our support team at support@jobtrendsindia.com</p>
<br>
<p>We appreciate your trust in JobTrendsIndia and look forward to supporting your hiring needs!</p>

@endcomponent

Best Regards,<br>
{{ config('app.name') }}
@endcomponent
