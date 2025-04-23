@extends('layouts.ajax')

@section('content')
    {!! Form::model($state, ['route' => [$entity['url'].'.update', $state->id], 'method' => 'patch', 'id' => 'frm_'.$entity['targetModel']]) !!}
        @include($entity['view'].'.fields')
    {!! Form::close() !!}
    {{-- @widget('AuthorFields', ['model' => $state]) --}}
@endsection
