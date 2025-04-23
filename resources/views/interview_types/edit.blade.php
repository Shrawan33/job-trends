@extends('layouts.ajax')

@section('content')
    {!! Form::model($interviewType, ['route' => [$entity['url'].'.update', $interviewType->id], 'method' => 'patch', 'id' => 'frm_'.$entity['targetModel']]) !!}
        @include($entity['view'].'.fields')
    {!! Form::close() !!}
    {{-- @widget('AuthorFields', ['model' => $interviewType]) --}}
@endsection
