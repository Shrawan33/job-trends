
@extends('layouts.ajax')


@section('content')
    {!! Form::model($faq, ['route' => [$entity['url'].'.update', $faq->id], 'method' => 'patch', 'id' => 'frm_'.$entity['targetModel']]) !!}
        @include($entity['view'].'.fields')
    {!! Form::close() !!}
    {{-- @widget('AuthorFields', ['model' => $faq]) --}}
@endsection
