<div class="col-md-6 col-lg-3 mb-4 mb-lg-0">
    <div class="inner_box featured-job-box">
        <div class="d-flex flex-md-column">
            @if (!empty($job->createdByUser->usersProfile) && $job->createdByUser->usersProfile->logo->count())
                @include('vendor.image_upload.display', [
                    'document_type' => config('constants.document_type.image', 0),
                    'imageModel' => $job->createdByUser->usersProfile,
                    'class_li' => '',
                    'title' => $job->createdByUser->company_name,
                    'thumbnail' => true,
                ])
            @else
                @if ($job->createdByUser)
                    @include('vendor.image_upload.no_image', [
                        'class_li' => '',
                        'title' => $job->createdByUser->company_name,
                        'employerlogo' => 1,
                    ])
                @endif
            @endif
            <div>
                <div class="school_detail">
                    <h3>{{ $job->title ?? '' }}</h3>
                    @if ($job->job_type_id == config('constants.job_type_id'))
                        <div class="principal_tag">
                            <span>Principal</span>
                        </div>
                    @endif
                    @if ($job->createdByUser)
                        <a
                            href="{{ route('job-detail.employer.show', $job->createdByUser->slug) }}">{{ $job->createdByUser->company_name ?? '' }}</a>
                    @endif

                </div>
            </div>
        </div>
        <div class="veiv-all-catagory d-flex flex-wrap align-items-center justify-content-between">
            <a href="{{ route('job-detail', $job->slug) }}"
                class="btn btn-outline-primary more_detail btn-sm px-2 w-100">More
                Details</a>
        </div>
    </div>
</div>

<style>
    .ribbon-container {
        position: relative;
    }

    .ribbon-image {
        position: absolute;
        top: 0;
        right: 0;
        width: 100px;
        /* Adjust the width as needed */
        height: auto;
        /* Adjust the height as needed */
        transform: translate(-50%, -50%);
        z-index: 1;
    }

    .inner_box {
        position: relative;
        /* Add other styling for the box */
    }
</style>
