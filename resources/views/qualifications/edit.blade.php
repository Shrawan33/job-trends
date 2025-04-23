@extends('layouts.ajax')

@section('content')
    {!! Form::model($qualification, ['route' => [$entity['url'].'.update', $qualification->id], 'method' => 'patch', 'id' => 'frm_'.$entity['targetModel']]) !!}
        @include($entity['view'].'.fields')
    {!! Form::close() !!}
    {{-- @widget('AuthorFields', ['model' => $qualification]) --}}
@endsection

