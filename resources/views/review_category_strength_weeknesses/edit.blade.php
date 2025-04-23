@extends('layouts.ajax')

@section('content')
    {!! Form::model($reviewCategoryStrengthWeekness, ['route' => [$entity['url'].'.update', $reviewCategoryStrengthWeekness->id], 'method' => 'patch', 'id' => 'frm_'.$entity['targetModel']]) !!}
        @include($entity['view'].'.fields')
    {!! Form::close() !!}

@endsection
