{{-- <div class="col-lg-3 col-md-6 col-12 px-lg-2 mb-4">
    <div class="featured-job-box">
    @if (!empty($job->createdByUser->usersProfile) && $job->createdByUser->usersProfile->logo->count())
    @include('vendor.image_upload.display', ['document_type' => config('constants.document_type.image', 0),
    'imageModel' => $job->createdByUser->usersProfile, 'class_li' => 'mb-1'])
    @else
    @include('vendor.image_upload.no_image', ['class_li' => 'mb-1'])
    @endif
    <a href="{{route('job-detail', $job->slug)}}"
        class="title">{{$job->title ?? ''}}</a>
    @if ($job->is_show)
    <p class="company_name">{{trans('label.anonymous')}}</p>
    @else
    <p><a href="{{route('job-detail.employer.show', ['slug' => $job->createdByUser->slug])}}"
        class="company_name">{{$job->createdByUser->company_name??''}}</a></p>
    @endif
    <div class="location_wraper">
        <span class="label_text">{{trans('label.location')}}</span>
        @if ($job->location && $job->state)
        <p class="label_value mb-0">{{$job->location->title??''}}, {{$job->state->title??''}}</p>
        @endif
    </div>
    <div class="veiv-all-catagory d-flex flex-wrap align-items-center justify-content-between">
        <a href="{{route('job-detail', $job->slug)}}" class="btn btn-outline-primary more_detail btn-sm px-2">More Details</a>
        @if (!auth()->user())
            <a href="{{route('job-detail', $job->slug)}}" class="btn btn-primary btn-sm">Apply Now</a>
        @endif
        @role('jobseeker')
        <a href="{{route('job-detail', $job->slug)}}" class="btn btn-primary btn-sm">Apply Now</a>
        @endrole
    </div>

    </div>
</div>
 --}}

<div class="col-lg-3 col-md-6 col-12 px-lg-2 mb-4">
    <div class="featured-job-box">
        {{-- @if ($job->job_type_id == config('constants.job_type_id'))
            <div class="principal_tag">
                <span>Principal</span>
            </div>
        @endif --}}
        @if (!empty($job->createdByUser->usersProfile) && $job->createdByUser->usersProfile->logo->count())
            @include('vendor.image_upload.display', [
                'document_type' => config('constants.document_type.image', 0),
                'imageModel' => $job->createdByUser->usersProfile,
                'class_li' => 'mb-1',
                'thumbnail' => true
            ])
        @else
            @include('vendor.image_upload.no_image', ['class_li' => 'mb-1'])
        @endif
        <a href="{{ route('job-detail', $job->slug) }}" class="title">{{ $job->title ?? '' }}</a>
        @if ($job->is_show)
            <p class="company_name">{{ trans('label.anonymous') }}</p>
        @else
            <p><a href="{{ route('job-detail.employer.show', ['slug' => $job->createdByUser->slug]) }}"
                    class="company_name">{{ $job->createdByUser->company_name ?? '' }}</a></p>
        @endif
        <div class="location_wraper">
            <span class="label_text">{{ trans('label.location') }}</span>
            @if ($job->location && $job->state)
                <p class="label_value mb-0">{{ $job->location->title ?? '' }}, {{ $job->state->title ?? '' }}</p>
            @endif
        </div>
        <div class="veiv-all-catagory d-flex flex-wrap align-items-center justify-content-between">
            <a href="{{ route('job-detail', $job->slug) }}" class="btn btn-outline-primary more_detail btn-sm px-2">More
                Details</a>
            @if (!auth()->user())
                <a href="{{ route('job-detail', $job->slug) }}" class="btn btn-primary btn-sm">Apply Now</a>
            @endif
            @role('jobseeker')
                <a href="{{ route('job-detail', $job->slug) }}" class="btn btn-primary btn-sm">Apply Now</a>
            @endrole
        </div>

    </div>
</div>
