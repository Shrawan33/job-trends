@extends('layouts.front')

@section('content')
<div class="container emp_dashboard_page">
    <h1 class="inner_page_heading arc_inner_bg_img two_side_circle">
      {{trans('label.interview_schedule')}} @if($employer_job_id != 0) <span> - {{$employerJob->title??''}}@endif</span>
    </h1>
    <div class="row mb-50 mx-0">
        <div class="clearfix"></div>
        @include('flash::message')
        <div class="clearfix"></div>
        <div class="col-12 inner_box_wraper table_box"> 
        @includeFirst([$entity['view'].'.table', 'components.table'])
        </div>
    </div>

</div>
@endsection
