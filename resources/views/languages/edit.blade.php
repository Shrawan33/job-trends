@extends('layouts.ajax')

@section('content')
    {!! Form::model($language, ['route' => [$entity['url'].'.update', $language->id], 'method' => 'patch', 'id' => 'frm_'.$entity['targetModel']]) !!}
        @include($entity['view'].'.fields')
    {!! Form::close() !!}
    {{-- @widget('AuthorFields', ['model' => $language]) --}}
@endsection

