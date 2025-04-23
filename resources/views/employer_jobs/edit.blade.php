@extends('layouts.front')

@section('content')
<div class="container">
    <div class="row mt-5">
        <div class="col-md-12">
            <div class="job_top_banner bg_frame position-relative">
                <img src="{{ asset('images/inner_banner.png') }}" alt="fea_img" width="100%" class="inner_banner">
                <div class="d-flex align-items-center justify-content-between position-relative flex-wrap py-lg-3">
                    <h1 class="mb-4 mb-md-0">
                        <a href="{{ route($entity['url'].'.index') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="24" viewBox="0 0 8 14" fill="none">
                                <path d="M6.75 12.5L1.25 7L6.75 1.5" stroke="#357de8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </a>
                        @if(!$clone)
                            {!! __('label.edit_job') !!}
                        @else
                            {{-- {!! __('label.clone_job') !!} --}}
                        Duplicate Job - <span class="text-secondary">{{ $employerJob->title }}</span>

                        @endif
                    </h1>
                    <div class="d-flex">
                        @if(!$clone)
                        <a href="{{ route('employerJobs.clone', ['id' => $employerJob->id]) }}"
                            title="Clone" class="btn btn-outline-primary">
                            {!! __('label.clone') !!}
                        </a>
                        <a href="{{ route('job-detail', $employerJob->slug) }}"
                            title="Preview" class="btn btn-primary ml-3">
                            {!! __('label.preview') !!}
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    {!! Form::model($employerJob, ['url' => [$action, $employerJob->id], 'method' => 'patch', 'id' => 'frm_'.$entity['targetModel']]) !!}
    @include($entity['view'].'.fields')

    {{-- <div class="row">
        <div class="col-12 text-center my-5">
            @include('components.form-buttons')
        </div>
    </div> --}}
    {!! Form::close() !!}
</div>
@endsection
