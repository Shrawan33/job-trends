@section('third_party_stylesheets')
    @include('vendor.image_upload.style')
    @include('vendor.richtexteditor.style')
@endsection
@extends('layouts.front')

@section('content')
    <div class="container">
        <div class="row">
            @if ($step && $step != 5)
                <div class="col-12 mt-5 p-0">
                    <div class="job_top_banner bg_frame position-relative">
                        <img src="{{ asset('images/samrt_resume_builder_banner.png') }}" alt="fea_img" width="100%" class="inner_banner">
                        <div class="d-flex align-items-center justify-content-between position-relative p-lg-3">
                            <h1 class="text-white">{!! __('label.smart_resume_builder') !!}</h1>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        {!! Form::model($seekerDetails, ['route' => [$entity['url'].'.updateStep', $seekerDetails->id], 'method' => 'patch', 'id' => 'frm_'.$entity['targetModel']]) !!}
            @include($entity['view'].'.fields', ['step' => $step])
        {!! Form::close() !!}
    </div>
    @include('imagecropper.croppermodal')
@endsection
@section('third_party_scripts')
    @include('vendor.image_upload.script')
    @include('vendor.richtexteditor.script')
@endsection
