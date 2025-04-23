<div class="tab-pane fade show @if ($loop->index == 0) active @endif" id="v-pills-{{ $job->id }}"
    role="tabpanel" aria-labelledby="v-pills-home-tab">
    <div class="d-flex align-items-center justify-content-between mb-4 flex-wrap border-bottom pb-4 pb-lg-3">
        <div>

                <h3>{{ $job->title ?? '' }}
                    @if ($job->job_type_id == config('constants.job_type_id'))
                    {{-- <span class="principle_badge">Principal</span> --}}
                </h3>
            @endif
            <h4 class="post_info mb-0">{{ trans('label.posted') }} <a
                    href="{{ route('job-detail.employer.show', $job->createdByUser->slug) }}"
                    class="text-primary">{{ $job->createdByUser->company_name ?? '' }}</a> •
                {{ $job->created_at->diffForHumans() ?? '' }}</h4>
        </div>
        <div class="d-flex mt-3 mt-lg-0">
            {{-- <a href="#" class="social_btn">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="18" viewBox="0 0 20 18" fill="none">
                    <path d="M13.4253 1.5C16.3605 1.5 18.3327 4.29375 18.3327 6.9C18.3327 12.1781 10.1475 16.5 9.99935 16.5C9.8512 16.5 1.66602 12.1781 1.66602 6.9C1.66602 4.29375 3.63824 1.5 6.57342 1.5C8.25861 1.5 9.36046 2.35312 9.99935 3.10312C10.6382 2.35312 11.7401 1.5 13.4253 1.5Z" stroke="#717884" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </a> --}}
            <div id="employer_job_actions_{{ $job->id }}">
                @role('jobseeker')
                    @include('components.ajax-favourit-job-buttons', [
                        'class_a' => 'social_btn',
                        'id' => $job->id,
                        'entityData' => $job ?? [],
                    ])
                @endrole
            </div>

            <a href="{{ route('job-detail', $job->slug) }}" class="btn btn-primary ml-2 btn-sm">View Details</a>
        </div>
    </div>
    {{-- <div class="detail_info_box p-3 border">
        <div class="row">
            <div class="col-6 col-lg-3 mb-3">
                <span>Location</span>
                <p>{{ $job->address ?? '' }}</p>
            </div>
            {{-- @if ($job->salary)
                <div class="col-6 col-lg-3 mb-3">
                    <span>Salary Offered</span>
                    <p>{{$job->salary->title ?? ''}} / {{config('constants.salary_type.data.'. $job->salary_type_id)}}</p>
                </div>
            @endif --}

            @if ($job->experience)
                <div class="col-6 col-lg-3 mb-3">
                    <span class="">{{ __('label.job_detail_page.experience') }}</span>
                    <p>{{ $job->experience->title ?? '' }}</p>
                </div>
            @endif

            @if (isset($job->workTypes) && $job->workTypes->count() > 0)
                <div class="col-6 col-lg-3 mb-3 mb-lg-0">
                    <span class="">{{ __('label.job_detail_page.job_type') }}</span>
                    @foreach ($job->workTypes as $key => $workType)
                        <p class="">{{ $workType->workType->title ?? '' }}
                            @if ($loop->index < $job->workTypes->count() - 1)
                                {{ ',' }}
                            @endif
                        </p>
                    @endforeach
                </div>
            @endif
            @if ($job->category)
                <div class="col-6 col-lg-3 mb-3 mb-lg-0">
                    <span class="">{{ __('label.job_detail_page.category') }}</span>
                    <p>{{ $job->category->title ?? '' }}</p>
                </div>
            @endif


            <div class="col-6 col-lg-3 mb-3 mb-lg-0">
                <span>Expiration Date</span>
                <p>{{ $job->expiration_date ? FunctionHelper::fromSqlDateTime($job->expiration_date, true, '') : '' }}
                </p>
            </div>

            <div class="col-6 col-lg-3 mb-3 mb-lg-0">
                <span>Specialization</span>
                <p class="mb-0">{{$job->specialization->name ?? '-'}}</p>
            </div>

            <div class="col-6 col-lg-3 mb-3 mb-lg-0">
                <span>Job Type</span>
                <p class="mb-0">{{$job->jobTypes->title ?? '-'}}</p>
            </div>
        </div>
    </div> --}}
    @if (!empty($job->description))
        <div class="inner_box border-bottom pb-2">
            <h3>{{ __('label.job_detail_page.title') }}</h3>
            <p class="mb-0">{!! $job->description ?? '' !!}</p>
        </div>
    @endif
    @if (!empty($job->other_recuirements))
        <div class="inner_box border-bottom pt-4 pb-2">
            <h3>{{ __('label.other_requirements') }}</h3>
            <p class="mb-0">{!! $job->other_recuirements ?? '' !!}</p>
        </div>
    @endif
    @if (isset($job->skills) && $job->skills->count() > 0)
        <div class="inner_box border-bottom pt-4 pb-2">
            <h3>{{ __('label.job_detail_page.skill_required') }}</h3>
            <ul class="pl-4 detail_ul_format">
                @foreach ($job->skills as $skill)
                    <li class="">{{ $skill->skill->title ?? '' }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if (isset($employerJob->qualifications) && $employerJob->qualifications->count() > 0)
        <div class="inner_box border-bottom pt-4 pb-2">
            <h3>{{ __('label.education') }}</h3>
            <ul class="pl-4 detail_ul_format">
                @foreach ($job->qualifications as $qualification)
                    <li class="">{{ $qualification->qualification->title ?? '' }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if (isset($employerJob->certifications) && $employerJob->certifications->count() > 0)
        <div class="row py-4 mx-0">
            <div class="col-12 p-lg-0">
                <h4 class="font-weight-bold mb-3">{{ __('label.job_detail_page.training_certificate') }}</h4>
                <ul class="m-0 pl-4 detail_ul_format">
                    @foreach ($employerJob->certifications as $certification)
                        <li class="">
                            {{ $certification->certification->title ?? '' }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    @if (isset($employerJob->certifications) && $employerJob->certifications->count() > 0)
        <div class="inner_box border-bottom pt-4 pb-2">
            <h3>{{ __('label.job_detail_page.training_certificate') }}</h3>
            <ul class="pl-4 detail_ul_format">
                @foreach ($employerJob->certifications as $certification)
                    <li class="">{{ $certification->certification->title ?? '' }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>




{{-- <div class="col-12 col-sm-6 {{$class ??'col-md-4'}} mb-4">
    <div class="item-box bg-white px-4 h-100">
        @role('jobseeker')
            @include('components.favourit-job-buttons', ['class_a' => 'btn btn-circle btn-md position-absolute fav-btn rounded-circle btn-icon text-primary', 'id' => $job->id, 'entityData' =>$job??[]])
        @endrole

        <a href="{{route('job-detail', $job->slug)}}" class="text-body">
            @if (!empty($job->createdByUser->usersProfile) && $job->createdByUser->usersProfile->logo->count())
                @include('vendor.image_upload.display', ['document_type' => config('constants.document_type.image', 0), 'imageModel' => $job->createdByUser->usersProfile, 'class_li' => 'mb-3'])
            @else
                @include('vendor.image_upload.no_image', ['class_li' => 'mb-3'])
            @endif
            <h4 class="text-primary mb-1 text-truncate">{{$job->title ?? ''}}</h4>
        </a>
         <p class="mb-2 "> <a href="{{route('job-detail.employer.show', $job->createdByUser->slug)}}" class="text-secondary ">{{$job->createdByUser->company_name??''}}</a></p>
        <p class="mb-1">{{$job->address??''}}</p>
        @if (isset($job->workTypes) && $job->workTypes->count() > 0)
        <p class="mb-0">
            @foreach ($job->workTypes as $key => $workType)
                <span class="">{{$workType->workType->title?? ''}}
                    @if ($loop->index < $job->workTypes->count() - 1)
                        {{',' }}

                    @endif
                </span>
            @endforeach
            <br>&middot;{{trans('label.posted')}} {{$job->created_at->diffForHumans() ?? ''}}
        </p>
        @endif
    </div>
</div> --}}
