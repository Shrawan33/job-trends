@extends('layouts.front')

@section('content')
<div class="container">
    <h2 class="inner_page_heading"> {{ trans('label.employer_profile') }}</h2>
    <div class="info_box profile_box border-bottom pb-20">
        {{-- <h3 class="mb-4">{{ trans('label.intro') }}</h3> --}}
        <div class="row align-items-center mb-50">
            <div class="col-md-8 mb-40 mb-md-0">
                <div class="d-flex align-items-center">
                    @if(!empty($usersProfile) && $usersProfile->logo->count())
                        @include('vendor.image_upload.display', ['wrapper_class' => 'img-fluid user-90', 'document_type' =>
                        config('constants.document_type.image', 0), 'imageModel' => $usersProfile, 'thumbnail' => true])
                    @else
                        @include('vendor.image_upload.no_image', ['class_li' => ''])
                    @endif
                    <div class="ml-4">
                        <h3 class="mb-1">{{$user->company_name ?? ''}} </h3>
                        <p class="name mb-0">{{$user->full_name ?? ''}}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="d-flex align-items-center justify-content-md-end">
                    @if ($usersProfile->user_id??false)
                    <a href="{{route('job-detail.employer.show', $usersProfile->user->slug)}}"
                        target="_blank" class="btn btn btn-outline-primary priview_btn btn-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="16" viewBox="0 0 20 16" fill="none">
                            <path d="M1.21845 8.65391C1.09361 8.45624 1.03119 8.3574 0.996247 8.20496C0.970001 8.09045 0.970001 7.90987 0.996247 7.79536C1.03119 7.64292 1.09361 7.54408 1.21845 7.34642C2.25007 5.71293 5.32078 1.5835 10.0004 1.5835C14.68 1.5835 17.7507 5.71293 18.7823 7.34642C18.9071 7.54408 18.9696 7.64292 19.0045 7.79536C19.0307 7.90987 19.0307 8.09045 19.0045 8.20496C18.9696 8.3574 18.9071 8.45624 18.7823 8.65391C17.7507 10.2874 14.68 14.4168 10.0004 14.4168C5.32078 14.4168 2.25007 10.2874 1.21845 8.65391Z" stroke="#357de8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M10.0004 10.7502C11.5192 10.7502 12.7504 9.51894 12.7504 8.00016C12.7504 6.48138 11.5192 5.25016 10.0004 5.25016C8.48159 5.25016 7.25037 6.48138 7.25037 8.00016C7.25037 9.51894 8.48159 10.7502 10.0004 10.7502Z" stroke="#357de8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        {{ trans('label.preview_profile') }}</a>
                    @endif

                    <a href="{{route('users.edit.profile', ['mainTitle' => 'employer'])}}"
                        class="edit_btn btn btn-primary btn-sm ml-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="17" height="16" viewBox="0 0 19 18" fill="none">
                            <path d="M14.4818 7.43286L11.0672 4.0182M1.25 17.25L4.13911 16.929C4.49209 16.8898 4.66859 16.8702 4.83355 16.8168C4.97991 16.7694 5.11919 16.7024 5.24761 16.6177C5.39236 16.5223 5.51793 16.3967 5.76906 16.1456L17.0428 4.87186C17.9857 3.92893 17.9857 2.40013 17.0428 1.4572C16.0999 0.514268 14.5711 0.514267 13.6281 1.4572L2.35441 12.7309C2.10328 12.9821 1.97771 13.1076 1.88226 13.2524C1.79757 13.3808 1.73063 13.5201 1.68325 13.6664C1.62984 13.8314 1.61023 14.0079 1.57101 14.3609L1.25 17.25Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        {{ trans('label.edit') }}</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-lg-3 mb-4">
                <span class="">{!! trans('label.employer_address') !!} </span>
                <p class="mb-0">{{ $usersProfile->user_address ?? '' }}</p>
            </div>
            <div class="col-md-6 col-lg-3 mb-4">
                <span class="">{!! trans('label.email') !!}</span>
                <p class="mb-0">{{ $user->email ?? '' }}</p>
            </div>
            <div class="col-md-6 col-lg-3 mb-4">
                <span>{!! trans('label.phone_number') !!}</span>
                <p class="mb-0">{{ $user->phone_number ?? ''}}</p>
            </div>
            <div class="col-md-12 mb-0">
                @if(!empty($user->usersProfile->company_profile))
                    <span>About {{$user->company_name}}</span>
                    {!! $user->usersProfile->company_profile ?? '-' !!}
                @endif
            </div>
            {{-- <div class="col-md-6 col-lg-3 mb-lg-0 mb-3">
                <span>{!! trans('label.qec') !!}</span>
                <p class="mb-0">{{ $user->usersProfile->qec ?? ''}}</p>
            </div> --}}
            {{-- <div class="col-md-6 col-lg-3 mb-lg-0 mb-3">
                <span>{!! trans('label.employer_number') !!}</span>
                <p class="mb-0">{{ $user->user_code ?? ''}}</p>
            </div> --}}
        </div>
    </div>
    <div class="profile_box gallery_box py-50 border-bottom">
        <h3 class="mb-3">{{ trans('label.gallery') }}</h3>
        @include('vendor.image_upload.display', ['wrapper_class' => null, 'document_type' =>
            config('constants.document_type.cropped_images', 2), 'imageModel' => $usersProfile])
    </div>
    <div class="profile_box location_box py-50 border-bottom">
        <div class="row mx-0">
            <div class="col-md-6 pl-lg-0">
                <h3 class="mb-3">{{ trans('label.school_location') }}</h3>
                @if (!empty($usersProfile->location))
                {!! $usersProfile->location !!}
                {{-- <iframe
                    src="{{$usersProfile->location}}"
                    width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy">
                </iframe> --}}
            @else
            {{ trans('label.no_location_provided') }}
            @endif
            </div>
            <div class="col-md-6 pr-lg-0">
                <h3 class="mb-3">{{ trans('label.video_link') }}</h3>
                @if (!empty($usersProfile->video_link))
                    {{-- <h3 class="mb-3">{{ trans('label.video_link') }}</h3> --}}
                    {{-- <iframe width="100%" height="315" src="{{$usersProfile->video_link}}"></iframe> --}}
                    {!! $usersProfile->video_link !!}
                    @else
                    {{ trans('label.no_video_found') }}
                @endif
            </div>
        </div>
    </div>
    <div class="profile_footer mt-40 mb-50">
        @include('components.front-profile-footer')
    </div>
</div>

<script>
    $(document).ready(function() {
        var reloadCount = sessionStorage.getItem('reloadCount');
        if (!reloadCount) {
            sessionStorage.setItem('reloadCount', 1);
        } else {
            sessionStorage.removeItem('reloadCount');
            return; // Skip reloading if already reloaded once
        }

        location.reload();
    });

    $(document).ready(function() {
        $('.zoomable-img').click(function() {
            var imgSrc = $(this).attr('src');
            $('#zoomed-img').attr('src', imgSrc);
            $('#zoom-modal').fadeIn(200);
            $('body').css('overflow', 'hidden'); // to prevent scrolling
        });

        $('#zoom-modal').click(function() {
            $('#zoom-modal').fadeOut(200);
            $('body').css('overflow', 'auto'); // restore scrolling
        });
    });
</script>

@endsection
