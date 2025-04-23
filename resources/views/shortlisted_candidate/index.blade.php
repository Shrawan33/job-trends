@extends('layouts.front')

@section('content')
<div class="container">
    <h1 class="inner_page_heading">{!! __('label.shortlisted_candidate.index_title') !!}</h1>
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
