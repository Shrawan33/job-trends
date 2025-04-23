<div class="col-6 col-lg-3 mb-4 mb-lg-0">
    <div class="inner_box">
        <div class="img_wraper">
            @if (!empty($job->createdByUser->usersProfile) && $job->createdByUser->usersProfile->logo->count())
                @include('vendor.image_upload.display', ['document_type' => config('constants.document_type.image', 0), 'imageModel' => $job->createdByUser->usersProfile, 'class_li' => 'img-slick-slid', 'title' => $job->createdByUser->company_name])
            @else
                @include('vendor.image_upload.no_image', ['class_li' => 'img-slick-slid', 'title' => $job->createdByUser->company_name, 'employerlogo' => 1])
            @endif
        </div>
        <div class="content_wraper">
            <a href="{{route('job-detail', $job->slug)}}" class="d-block position-relative">
                <h3>{{$job->title ?? ''}}</h3>
                <p class="field">{{$job->createdByUser->company_name??''}}</p>
                <span class="location row mx-0">
                    <div class="col-1 p-0">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                            <path d="M8.00002 8.3335C9.10459 8.3335 10 7.43807 10 6.3335C10 5.22893 9.10459 4.3335 8.00002 4.3335C6.89545 4.3335 6.00002 5.22893 6.00002 6.3335C6.00002 7.43807 6.89545 8.3335 8.00002 8.3335Z" stroke="#777777" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M8.00002 14.6668C9.33335 12.0002 13.3334 10.279 13.3334 6.66683C13.3334 3.72131 10.9455 1.3335 8.00002 1.3335C5.0545 1.3335 2.66669 3.72131 2.66669 6.66683C2.66669 10.279 6.66669 12.0002 8.00002 14.6668Z" stroke="#777777" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <div class="col-11 pl-1">
                        {{ $job->address?? '' }}
                    </div>
                </span>
                <span class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="8" height="14" viewBox="0 0 8 14" fill="none">
                        <path d="M1 13L7 7L1 1" stroke="#357de8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </span>
            </a>
        </div>

    </div>
</div>

