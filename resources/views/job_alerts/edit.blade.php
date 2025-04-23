@extends('layouts.ajax')

@section('content')
    {!! Form::model($jobAlert, ['route' => [$entity['url'].'.update', $jobAlert->id], 'method' => 'patch', 'id' => 'frm_'.$entity['targetModel']]) !!}
        @include($entity['view'].'.fields')
    {!! Form::close() !!}

@endsection
