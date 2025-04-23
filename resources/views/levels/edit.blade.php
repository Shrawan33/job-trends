@extends('layouts.ajax')

@section('content')
    {!! Form::model($level, ['route' => [$entity['url'].'.update', $level->id], 'method' => 'patch', 'id' => 'frm_'.$entity['targetModel']]) !!}
        @include($entity['view'].'.fields')
    {!! Form::close() !!}
    {{-- @widget('AuthorFields', ['model' => $level]) --}}
@endsection

