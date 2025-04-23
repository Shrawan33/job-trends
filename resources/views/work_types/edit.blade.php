@extends('layouts.ajax')

@section('content')
    {!! Form::model($workType, ['route' => [$entity['url'].'.update', $workType->id], 'method' => 'patch', 'id' => 'frm_'.$entity['targetModel']]) !!}
        @include($entity['view'].'.fields')
    {!! Form::close() !!}
    {{-- @widget('AuthorFields', ['model' => $workType]) --}}
@endsection
