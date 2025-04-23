@extends('layouts.front')

@section('content')

<div class="container">
    <h1 class="inner_page_heading">{{trans('label.favourit_job')}}</h1>
    <div class="row mb-50 jobseeker_dashboard">
        @include('auth.job_seeker.profile.layout')
        <div class="col-md-8 col-lg-9 table_box">
            @include('flash::message')
            @includeFirst([$entity['view'].'.table', 'components.table'])
        </div>
    </div>
</div>
@endsection
