@extends('layouts.ajax')

@section('content')
    {!! Form::model($reviewCategory, ['route' => [$entity['url'].'.update', $reviewCategory->id], 'method' => 'patch', 'id' => 'frm_'.$entity['targetModel']]) !!}
        @include($entity['view'].'.fields')
    {!! Form::close() !!}

@endsection
