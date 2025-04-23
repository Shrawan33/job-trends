@extends('layouts.ajax')

@section('content')
{!! Form::open(['route' => [$entity['url'].'.store'], 'id' => 'frm_'.$entity['targetModel']]) !!}
    @include($entity['view'].'.fields')
{!! Form::close() !!}
@endsection

