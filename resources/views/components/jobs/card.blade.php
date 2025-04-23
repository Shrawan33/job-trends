<div class="col-lg-3 col-md-6 col-12 px-lg-2 mb-4">
    <div class="featured-job-box">
        @if (!empty($job->createdByUser->usersProfile) && $job->createdByUser->usersProfile->logo->count())
            @if ($job->job_type_id == config('constants.job_type_id'))
                {{-- <div class="principal_tag">
                    <span>Principal</span>
                </div> --}}
            @endif
            @include('vendor.image_upload.display', [
                'document_type' => config('constants.document_type.image', 0),
                'imageModel' => $job->createdByUser->usersProfile,
                'class_li' => 'mb-1',
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
                <p class="label_value">{{ $job->location->title ?? '' }}, {{ $job->state->title ?? '' }}</p>
            @endif
        </div>
        <div class="veiv-all-catagory d-flex flex-wrap align-items-center justify-content-between">
            {{-- <a href="{{ route('job-detail', $job->slug) }}" class="btn btn-outline-primary more_detail btn-sm px-2">More
                Details</a>
            @if (!auth()->user())
                <a href="{{ route('job-detail', $job->slug) }}" class="btn btn-primary btn-sm">Apply Now</a>
            @endif
            @role('jobseeker')
                <a href="{{ route('job-detail', $job->slug) }}" class="btn btn-primary btn-sm">Apply Now</a>
                 --}}

                 <a href="{{ route('job-detail', $job->slug) }}" class="btn btn-outline-primary more_detail btn-sm px-2 px-lg-3">More
                    Details</a>
                @if (!auth()->user())
                    <a href="{{ route('job-detail', $job->slug) }}" class="btn btn-primary btn-sm">Apply Now</a>
                @endif
                @role('jobseeker')


                    @if ($job->appliedJob && $job->appliedJob->is_apply == 0)
                        <a class="disabled btn btn-outline-success btn-sm px-lg-3" href="javascript:void(0)"
                            title="{!! __('label.already_apply_title') !!}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="12" viewBox="0 0 20 12"
                                fill="none">
                                <path
                                    d="M0.833984 6.00033L5.41732 10.5837M10.0007 6.00033L14.584 1.41699M5.41732 6.00033L10.0007 10.5837L19.1673 1.41699"
                                    stroke="#36951E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            {!! __('label.applied_btn') !!}
                        </a>
                    @else
                        <a href="{{ route('job-detail', $job->slug) }}" class="btn btn-primary btn-sm ">Apply Now</a>
                    @endif
            @endrole
        </div>

    </div>
</div>
