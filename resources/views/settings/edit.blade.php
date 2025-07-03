@extends('layouts.ajax')

@section('content')
    {!! Form::model($setting, ['route' => [$entity['url'].'.update', $setting->id], 'method' => 'patch', 'id' => 'frm_'.$entity['targetModel']]) !!}
        @include($entity['view'].'.fields_seo')
    {!! Form::close() !!}
    {{-- @widget('AuthorFields', ['model' => $setting]) --}}
@endsection

