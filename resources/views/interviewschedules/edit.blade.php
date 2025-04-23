@extends('layouts.front')

@section('content')
<div class="container interview_main_wraper">
<div class="row my-1">
    <h1 class="inner_page_heading arc_inner_bg_img two_side_circle">
        {{trans('label.add_interview_schedule')}} @if($employer_job_id != 0) <span> - {{$employerJob->title??''}}@endif</span>
      </h1>
        {{-- <div class="col-md-5 profile_box">
            <h3 class="mb-4 mb-md-0">{!! __('label.edit_interview_schedule') !!}</h3>
        </div> --}}

        {{-- <div class="col-md-7 d-flex align-items-center justify-content-md-end">
            <h4 class="mb-0 d-flex"><span class="font-weight-bold text-black"> {{__('label.candidate_profile_title')}}:-</span> {{$employerJob->title}}</h4>
            <h4 class="d-flex pl-3 mb-0"><span class="font-weight-bold text-black">{{__('Job ID')}}:-</span> {{$employerJob->job_number}}</h4>
        </div> --}}
    </div>
    {!! Form::model($interviewtype, ['route' => [$entity['url'].'.update', $interviewtype->id], 'method' => 'patch', 'id' => 'frm_'.$entity['targetModel']]) !!}
    @include($entity['view'].'.fields')
    <div class="d-flex align-items-center justify-content-end my-50">
            <a href="{{ route($entity['url'].'.index', ['employer_job_id' => $employer_job_id, 'user_id' => 0]) }}" class="btn btn-default">{!! __('label.cancel') !!}</a>
			{!! Form::submit(__('label.update'), ['class' => 'btn btn-primary ml-3']) !!}
			<input type="hidden" value="{{$employer_job_id}}" name="employer_job_id" id="employer_job_id">
        </div>
    {!! Form::close() !!}
</div>
@endsection
