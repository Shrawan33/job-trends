@extends('layouts.ajax')

@section('content')
    {!! Form::model($salary, ['route' => [$entity['url'].'.update', $salary->id], 'method' => 'patch', 'id' => 'frm_'.$entity['targetModel']]) !!}
        @include($entity['view'].'.fields')
    {!! Form::close() !!}

@endsection

