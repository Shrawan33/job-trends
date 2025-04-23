@extends('layouts.ajax')

@section('content')
    {!! Form::open(['route' => $entity['targetModel'].'.score.save', 'id' => 'frm_mentor_candidate']) !!}
        @include($entity['view'].'.fields')
    {!! Form::close() !!}
@endsection
