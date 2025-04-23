@extends('layouts.ajax')

@section('content')
    {!! Form::model($experience, ['route' => [$entity['url'].'.update', $experience->id], 'method' => 'patch', 'id' => 'frm_'.$entity['targetModel']]) !!}
        @include($entity['view'].'.fields')
    {!! Form::close() !!}

@endsection
