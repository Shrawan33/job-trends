@extends('layouts.ajax')

@section('content')
    {!! Form::model($location, ['route' => [$entity['url'].'.update', $location->id], 'method' => 'patch', 'id' => 'frm_'.$entity['targetModel']]) !!}
        @include($entity['view'].'.fields')
    {!! Form::close() !!}
    {{-- @widget('AuthorFields', ['model' => $location]) --}}
@endsection
