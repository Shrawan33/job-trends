@component('mail::message')
@component('mail::panel')


@if ($userReview->review_type == 2)
   This User Review {{ $userReview->reviewFromUser->first_name }} {{ $userReview->reviewFromUser->last_name }}
@elseif ($userReview->review_type == 1 && $userReview->reviewFromUser->company_name === null)
This User Review {{ $userReview->reviewFromUser->first_name }} {{ $userReview->reviewFromUser->last_name }}
@else
This User Review {{ $userReview->reviewFromUser->company_name }}
@endif
To This User {{ $userReview->reviewToUser->first_name }} {{ $userReview->reviewToUser->last_name }}
@endcomponent

{{ trans('label.thanks_') }}<br>
{{ config('app.name') }}<br>
@endcomponent
