@extends('layouts.ajax')
{{-- {{dd($entity['targetModel'])}} --}}
@section('content')
{!! Form::open(['url' => route($entity['url'].'.store', ['job' => $job]), 'id' => 'frm_'.$entity['targetModel']]) !!}
    @if (config('constants.question_types.applicable', 1) == 1)
    @include($entity['view'].'.fields')
    @elseif (config('constants.question_types.applicable', 2) == 2)
    @include($entity['view'].'.mcq_fields')
    @endif
{!! Form::close() !!}
@endsection

