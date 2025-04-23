@extends('layouts.ajax')

@section('content')
    {!! Form::model($user, ['route' => [$entity['url'].'.update', $user->id], 'method' => 'patch', 'id' => 'frm_'.$entity['targetModel']]) !!}
        @include($entity['view'].'.fields')
    {!! Form::close() !!}

@endsection
