@extends('layouts.ajax')

@section('content')
    {!! Form::model($jobType, ['route' => [$entity['url'].'.update', $jobType->id], 'method' => 'patch', 'id' => 'frm_'.$entity['targetModel']]) !!}
        @include($entity['view'].'.fields')
    {!! Form::close() !!}
    {{-- @widget('AuthorFields', ['model' => $jobType]) --}}
@endsection

