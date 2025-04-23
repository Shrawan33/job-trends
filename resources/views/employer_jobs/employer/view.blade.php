@extends('layouts.front')


@section('content')

<div class="container position-relative my-50">
    <div class="info_box profile_box border-bottom pb-20">
        <div class="row align-items-center mb-20 mb-lg-50">
            <div class="col-md-8 mb-40 mb-md-0">
                <div class="row align-items-center">
                    <div class="col-md-2 pr-0 mb-3 mb-md-0">
                        @if(!empty($employer->usersProfile->logo) && $employer->usersProfile->logo->count())
                        @include('vendor.image_upload.display', ['wrapper_class' => 'mb-4 user-90',
                        'document_type' =>
                        config('constants.document_type.image', 0), 'imageModel' => $employer->usersProfile, 'thumbnail' => true])
                        @else
                        @include('vendor.image_upload.no_image', ['class_li' => 'mb-3'])
                        @endif
                    </div>
                    <div class="col-md-10">
                        @if(!empty($employer->company_name))
                        <h3 class="mb-1">
                            {{$employer->company_name}}</h1>
                        @endif

                    </div>
                </div>
            </div>
            @hasrole('jobseeker')
                <div class="col-md-4 emp_public_profile">
                    <div class="report-btn" id="{{'user_action_' . $employer->id}}">
                        @include('components.report_button',['entity' => 'employer-view' , 'entityData' =>$employer,'id' =>$employer->id,'from' => 'employer-view-page'])
                    </div>
                </div>
            @endhasrole
        </div>
        <div class="row mb-4">
            <div class="col-md-6 col-lg-2 mb-4">
                <span class="">{!! trans('label.employer_address') !!} </span>
                <p class="mb-0">{{ $employer->usersProfile->user_address ?? '-' }}</p>
            </div>
            <div class="col-md-6 col-lg-2 mb-4 pl-lg-0">
                <span class="">{!! trans('label.email') !!}</span>
                <p class="mb-0">{{ $employer->email ?? '-' }}</p>
            </div>
            <div class="col-md-3 col-lg-2 mb-4">
                <span>{!! trans('label.phone_number') !!}</span>
                <p class="mb-0">{{ $employer->phone_number ?? '-'}}</p>
            </div>
            <div class="col-md-3 col-lg-3 mb-4">
                <span>{!! trans('label.company_website') !!}</span>
                <p class="mb-0">{{ $employer->usersProfile->company_website ?? '-'}}</p>
            </div>

            {{-- <div class="col-md-3 col-lg-3">
                <span>{!! trans('label.qec') !!}</span>
                <p class="mb-0">{!! $employer->usersProfile->qec ?? '-' !!}</p>
            </div> --}}

            {{-- <div class="col-md-6 col-lg-3 mb-lg-0 mb-3">
                <span>{!! trans('label.employer_number') !!}</span>
                <p class="mb-0">{{ $employer->user_code ?? '-'}}</p>
            </div> --}}
        </div>
        <div class="row">
            <div class="col-md-12 col-lg-12">
                @if(!empty($employer->usersProfile->company_profile))
                    <span>{{ trans('label.about') }} {{$employer->company_name}}</span>
                    <p class="mb-0">{!! $employer->usersProfile->company_profile ?? '-' !!}</p>
                @endif
            </div>

        </div>
    </div>
    <div class="profile_box gallery_box py-50 border-bottom">
        <h3 class="mb-3">{{ trans('label.gallery') }}</h3>
        @if(!empty($employer->usersProfile))
            @include('vendor.image_upload.display', ['wrapper_class' => 'img-fluid', 'document_type' =>
            config('constants.document_type.cropped_images', 2), 'imageModel' => $employer->usersProfile])
        @else
            {{trans('label.not_found')}}
        @endif
    </div>
    <div class="profile_box location_box py-50 border-bottom">
        <div class="row mx-0">
            <div class="col-md-6 pl-lg-0">
                <h3 class="mb-3">{{ trans('label.school_location') }}</h3>
                @if(!empty($employer->usersProfile->location))
                    {!! $employer->usersProfile->location ?? '' !!}
                @else
                {{trans('label.not_found')}}
                @endif
            </div>
            <div class="col-md-6 pr-lg-0">
                <h3 class="mb-3">{{ trans('label.video_link') }}</h3>
                @if(!empty($employer->usersProfile->video_link))
                {{-- <iframe width="100%" height="300" src="{!!$employer->usersProfile->video_link!!}" frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen></iframe> --}}
                    {!! $employer->usersProfile->video_link !!}
                @else
                {{trans('label.no_video_found')}}
                @endif
            </div>
        </div>
    </div>
    <div class="profile_box related_box pt-50">
        <h3>{{$employer->company_name}} {{trans('label.jobs')}}</h3>
        {{-- <div class="row related_job_wraper">
            @foreach($jobs->sortByDesc('created_at') as $job)
                @include('components.jobs.card')
            @endforeach
        </div> --}}
        <div class="row related_job_wraper">
            @if ($jobs->isEmpty())
            {{trans('label.no_vacancies_available')}}
            @else
                @foreach ($jobs->sortByDesc('created_at') as $job)
                    @include('components.jobs.card')
                @endforeach
            @endif

        </div>
    </div>
</div>

@endsection
