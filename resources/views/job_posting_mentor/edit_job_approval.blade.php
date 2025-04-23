@extends('layouts.ajax')

@section('content')

    {!! Form::model($employerJob, ['route' => [$entity['url'].'.update-job-approval'], 'method' => 'post', 'id' => 'frm_'.$entity['targetModel']]) !!}
        {!! Form::hidden('id', $employerJob->id) !!}
        {!! Form::hidden('status', $status) !!}

        {!! Form::textarea('apporval_reason', null, ['rows' => 4, 'class' => 'form-control', 'placeholder' => trans('label.message').'...', 'maxlength' => config('constants.message_length', 500)]) !!}
    {!! Form::close() !!}

@endsection
