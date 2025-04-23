{{-- @extends('layouts.'.$layout)

@section('content')
    <div class="container">

        @if (auth()->user()->id !== $candidate->id)
            @include($entity['view'].'.show_fields')
        @else
            @include($entity['view'].'.show_candidate_profile')
        @endif
    </div>
@endsection --}}
@extends('layouts.' . $layout)

@section('content')
    <div class="container">
        @if (auth()->user()->id !== $candidate->id)
            @if (Route::currentRouteName() === 'social-profile.show')
                @include('candidates.show_social_fields')
            @else
                @include($entity['view'] . '.show_fields')
            @endif
        @else
            @include($entity['view'] . '.show_candidate_profile')
        @endif

    </div>
@endsection
