@extends('layouts.ajax')

@section('content')
    {!! Form::model($packageCategory, ['route' => [$entity['url'].'.update', $packageCategory->id], 'method' => 'patch', 'id' => 'frm_'.$entity['targetModel']]) !!}
        @include($entity['view'].'.fields')
    {!! Form::close() !!}
@endsection
