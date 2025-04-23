@extends('layouts.front')

@section('content')
    <div class="event_main_wraper milatry_wraper">
        <div class="job_top_banner bg_frame position-relative py-30 py-lg-70 mb-60">
            <img src="{{ asset('images/Frame_blue.png') }}" alt="fea_img" width="100%" class="inner_banner">
            <div class="position-relative">
                <h1 class="mb-4 text-center position-relative text-white">{{ trans('message.welcome_text') }}, {{Auth::user()->first_name}}!</h1>
                <p class="text-white text-center">{{ trans('message.let_start_text') }}</p>
            </div>
        </div>

        <div class="container">
            <div class="row my-5">
                <div class="col-12">
                    {{-- @include('adminlte-templates::common.errors') --}}
                    @if (isset($main_title))
                        {!! Form::open(['route' => "users.update.profile.jobseeker.$main_title", 'id' => 'frm_jobseeker']) !!}
                        @switch($main_title)
                            @case('intro')
                                @include('auth.job_seeker.partials.intro', ['experiencesData' => $experiencesData])
                            @break

                            @case('education')
                                @include('auth.job_seeker.partials.education')
                            @break

                            @case('experience')
                                @include('auth.job_seeker.partials.experience')
                            @break

                            @case('licenses')
                                @include('auth.job_seeker.partials.licenses')
                            @break

                            @case('language_skill')
                                @include('auth.job_seeker.partials.language_skill')
                            @break

                            @case('skill')
                                @include('auth.job_seeker.partials.skill')
                            @break

                            @case('video')
                                @include('auth.job_seeker.partials.video')
                            @break

                            @case('personal')
                                @include('auth.job_seeker.partials.personal')
                            @break
                        @endswitch
                        <div class="d-flex align-items-center justify-content-end my-40 w-100 px-15">
                            <a href="{{ route('users.profile') }}" class="btn btn-default">Cancel</a>
                            {!! Form::submit('Save', ['class' => 'btn btn-primary ml-3']) !!}
                        </div>
                        {!! Form::close() !!}
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
