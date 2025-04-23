@component('mail::message')
@component('mail::panel')
@if ($review->approval_status == 1)
Hello, {{ $review->review_type == 2 ? $review->reviewFromUser->first_name . ' ' . $review->reviewFromUser->last_name : $review->reviewFromUser->company_name }},
Your Review has been Approved.
@else
Hello, {{ $review->review_type == 2 ? $review->reviewFromUser->first_name . ' ' . $review->reviewFromUser->last_name : $review->reviewFromUser->company_name }},
Your Review has been Disapproved.
@endif
</br>

@endcomponent
{{ trans('label.thanks_') }}<br>
{{ config('app.name') }}<br>
@endcomponent
