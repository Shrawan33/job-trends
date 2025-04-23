@extends('layouts.front')

@section('content')
<div class="container">
    <h1 class="inner_page_heading">{{trans('label.application_tracking')}} - <span>{{$employerJob->title??''}}</span></h1>
    <div class="row mb-5 mx-0">
        <div class="clearfix"></div>
        @include('flash::message')
        <div class="clearfix"></div>
        <div class="col-12 table_box">
        @includeFirst([$entity['view'].'.table', 'components.table'])
        </div>
    </div>

</div>
@endsection
