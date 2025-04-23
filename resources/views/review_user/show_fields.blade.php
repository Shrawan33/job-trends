<!-- Title Field -->
<div class="col-sm-12">
    {!! Form::label('review_from_id', trans('label.review_from_id')) !!}
    {{-- <p>{{ $user_review->reviewFromUser->company_name }}</p> --}}
        @if ($user_review->review_type == 2)
            <p> {{$user_review->reviewFromUser->first_name . ' ' . $user_review->reviewFromUser->last_name }} </p>
        @else
            <p> {{ $user_review->reviewFromUser->company_name }} </p>
    @endif
    </p>
</div>

<div class="col-sm-12">
    {!! Form::label('review_to_id', trans('label.review_to_id')) !!}
    <p>{{ $user_review->reviewToUser->first_name . ' ' . $user_review->reviewToUser->last_name }}</p>
</div>

<div class="col-sm-12">
    {!! Form::label('review_type', trans('label.review_type')) !!}
    <p>{{ $user_review->review }}</p>
</div>

<div class="col-sm-12">
    {!! Form::label('review_type', trans('label.review_type')) !!}
    {{ config('constants.review_type.' . $user_review->review_type) }}</p>
</div>

<div class="col-sm-12">
    {!! Form::label('review', trans('label.review')) !!}
    <p> {{ $user_review->review }}</p>
</div>
@if (!empty($user_review->badge->title))
    <div class="col-sm-12">
        {!! Form::label('badge_id', trans('label.badge')) !!}
        <p> {{ $user_review->badge->title }}</p>
    </div>
@endif

@if (!empty($user_review->badge_strength))
    <div class="col-sm-12">
        {!! Form::label('badge_strength', trans('label.badge_strength')) !!}
        <p>
            @foreach ($user_review->badge_strength as $key => $value)
                {{ $key + 1 }}. {{ $value }}<br>
            @endforeach
        </p>
    </div>
@endif


@if (!empty($user_review->badge_weekness))
    <div class="col-sm-12">
        {!! Form::label('badge_weekness', trans('label.badge_weekness')) !!}
        <p>
            @foreach ($user_review->badge_weekness as $key => $value)
                {{ $key + 1 }}. {{ $value }}<br>
            @endforeach
        </p>
    </div>
@endif


<div class="col-sm-12">
    {!! Form::label('anonymous', trans('label.anonymous')) !!} :
    {{ config('constants.is_anonymous.' . $user_review->is_anonymous) }}</p>
</div>
