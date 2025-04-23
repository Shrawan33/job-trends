@extends('layouts.ajax')

@section('content')
    {!! Form::model($skill, ['route' => [$entity['url'].'.update', $skill->id], 'method' => 'patch', 'id' => 'frm_'.$entity['targetModel']]) !!}
        @include($entity['view'].'.fields')
    {!! Form::close() !!}
    {{-- @widget('AuthorFields', ['model' => $skill]) --}}
@endsection
