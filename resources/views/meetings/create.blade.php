@extends('layouts.ajax')

@section('content')
{!! Form::open(['route' => 'meetings.store', 'id' => 'frm_meeting']) !!}
<div class="card-body">
    <div class="row">
        <div class="form-group col-sm-6">
            {!! Form::hidden('employer_job_id', $employerJob??null) !!}
            {!! Form::hidden('jobseeker_id', $job_seeker->id??null) !!}
            {!! Form::text('topic', null, ['class' => 'form-control', 'placeholder' =>'topic']) !!}
        </div>
        <div class="form-group col-sm-6">
            {!! Form::date('start_time', null, ['class' => 'form-control', 'placeholder' =>'start_time']) !!}
        </div>
        <div class="form-group col-sm-6">
            {!! Form::text('duration', null, ['class' => 'form-control', 'placeholder' =>'duration']) !!}
        </div>
        <div class="form-group col-sm-6">
            {!! Form::textarea('agenda', null, ['class' => 'form-control', 'placeholder' =>'agenda']) !!}
        </div>
        <div class="form-group col-sm-6">
            {!! Form::checkbox('host_video', 1,0, ['class' => 'form-control', 'placeholder' =>'host_video']) !!} <span>Host video</span>
        </div>
        <div class="form-group col-sm-6">
            {!! Form::checkbox('participant_video', 1,0, ['class' => 'form-control', 'placeholder' =>'participant_video']) !!} <span>Participant video</span>
        </div>
    </div>
</div>
<div class="card-footer text-right">
    {!! Form::button('Cancel', ['class' => 'btn btn-default','data-dismiss' =>'modal']) !!}
    {!! Form::submit('Submit', ['class' => 'btn btn-warning']) !!}
</div>
{!! Form::close() !!}
@endsection
