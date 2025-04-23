@extends('layouts.ajax')

@section('content')
    {!! Form::model($certification, ['route' => [$entity['url'].'.update', $certification->id], 'method' => 'patch', 'id' => 'frm_'.$entity['targetModel']]) !!}
        @include($entity['view'].'.fields')
    {!! Form::close() !!}
    {{-- @widget('AuthorFields', ['model' => $certification]) --}}
@endsection
