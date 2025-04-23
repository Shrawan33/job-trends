@extends('layouts.ajax')

@section('content')
{!! Form::model($criteria, ['route' => [$entity['url'].'.update', $criteria->id], 'method' => 'patch', 'id' => 'frm_'.$entity['targetModel']]) !!}

    @include($entity['view'].'.fields')



{!! Form::close() !!}
@endsection
