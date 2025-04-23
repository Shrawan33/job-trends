@extends('layouts.front')

@section('content')
<div class="container">
    <div class="row mb-50">
        <div class="col-12 p-lg-0">
            <div class="job_top_banner bg_frame position-relative">
                <img src="{{ asset('images/inner_banner.png') }}" alt="fea_img" width="100%" class="inner_banner">
                <div class="d-flex align-items-center justify-content-between position-relative flex-wrap p-lg-3">
                    <h1 class="mb-4 mb-md-0">{!! __('label.my_jobs') !!}</h1>
                    <div class="d-flex align-items-center">
                        {{-- <div class="counter">
                            <h3>39</h3>
                            <p>Total Jobs</p>
                        </div>
                        <div class="counter ml-5">
                            <h3>23</h3>
                            <p>Total Applicants</p>
                        </div>     --}}
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        @include('flash::message')
        <div class="clearfix"></div>
        <div class="col-12 table_box">
            @includeFirst([$entity['view'].'.table', 'components.table'])
        </div>
    </div>

</div>
@endsection
