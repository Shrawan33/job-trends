@extends('layouts.ajax')

@section('content')
    {!! Form::model($specialization, ['route' => [$entity['url'].'.update', $specialization->id], 'method' => 'patch', 'id' => 'frm_'.$entity['targetModel']]) !!}
        @include($entity['view'].'.fields')
    {!! Form::close() !!}
    {{-- @widget('AuthorFields', ['model' => $specialization]) --}}
@endsection
