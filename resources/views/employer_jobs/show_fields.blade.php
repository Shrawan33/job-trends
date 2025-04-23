<div class="col-md-9 job_detail_wraper pr-4">
    <div class="row mx-0 align-items-center job_detail_inner border-bottom pb-4">
        <div class="col-md-2 col-3 p-0">
            @if (!empty($employerJob->createdByUser->usersProfile) && $employerJob->createdByUser->usersProfile->logo->count())
                @include('vendor.image_upload.display', ['document_type' => config('constants.document_type.image', 0), 'imageModel' => $employerJob->createdByUser->usersProfile, 'wrapper_class' => 'mb-0'])
            @else
                @include('vendor.image_upload.no_image', ['wrapper_class' => 'mb-0', 'title' => $employerJob->createdByUser->company_name, 'employerlogo' => 1])
            @endif
        </div>
        <div class="col-md-6 col-9">
            @if($employerJob->is_featured == 1)
            <span class="badge badge-primary text-uppercase mb-2 p-2">{{ trans('label.featured_job') }}</span>
            @endif
            <h2 class="font-weight-bold d-flex align-items-center"> {{$employerJob->title}} @if ($employerJob->job_type_id == config('constants.job_type_id'))
                {{-- <span class="principle_badge">Principal</span> --}}
                @endif</h2>
            <div class="d-flex align-items-center flex-wrap">
                <a class="company_name" href="{{route('job-detail.employer.show', $employerJob->createdByUser->slug)}}">{{$employerJob->createdByUser->company_name ?? ''}}</a>
                <p class="posted_on mb-0 pl-1">
                    {{$employerJob->jobType->title??''}} &middot; {{trans('label.posted')}} {{$employerJob->created_at->diffForHumans()  ?? ''}}
                </p>
            </div>
        </div>
        <div class="col-lg-4 mt-3 mt-lg-0 pr-lg-0" id="employer_job_actions">
            @include('components.jobs.action_buttons', ['job' => $employerJob])
        </div>
    </div>

    @if(!empty($employerJob->description))
    <div class="row border-bottom py-4 mx-0">
        <div class="col-12 p-lg-0 my-lg-1">
            <h3 class="font-weight-bold">{{__('label.job_detail_page.title')}}</h3>
            <p class="mb-0">{!! $employerJob->description ?? ''!!}</p>
        </div>
    </div>
    @endif
    @if(isset($employerJob->qualifications) && $employerJob->qualifications->count() > 0)
    <div class="row border-bottom py-4 mx-0">
        <div class="col-12 p-lg-0 my-lg-1">
            <h3 class="font-weight-bold">{{__('label.education')}}</h3>
            <ul class="m-0 pl-4">
                @foreach($employerJob->qualifications as $qualification)
                <li class="">
                    {{$qualification->qualification->title ?? ''}}</li>
                @endforeach
            </ul>
        </div>
    </div>
    @endif
    @if(isset($employerJob->skills) && $employerJob->skills->count() > 0)
    <div class="row border-bottom py-4 mx-0">
        <div class="col-12 p-lg-0 my-lg-1">
            <h3 class="font-weight-bold">{{__('label.job_detail_page.skill_required')}}</h3>
            <ul class="pl-4 m-0">
                @foreach($employerJob->skills as $skill)
                <li class="">
                    {{$skill->skill->title ?? ''}}</li>
                @endforeach
            </ul>
        </div>
    </div>

    @endif
    @if(isset($employerJob->certifications) && $employerJob->certifications->count() )
    <div class="row  border-bottom py-4 mx-0">
        <div class="col-12 p-lg-0 my-lg-1">
            <h3 class="font-weight-bold mb-3">{{__('label.job_detail_page.training_certificate')}}</h3>
            <ul class="m-0 pl-4">
                @foreach($employerJob->certifications as $certification)
                <li class="">
                    {{$certification->certification->title ?? ''}}</li>
                @endforeach
            </ul>
        </div>
    </div>
    @endif
    @if(!empty($employerJob->other_recuirements))
        <div class="row py-4 mx-0">
            <div class="col-12 p-lg-0 my-lg-1">
                <h3 class="font-weight-bold">{{__('label.other_requirements')}}</h3>
                <p class="mb-0">{!! $employerJob->other_recuirements ?? ''!!}</p>
            </div>
        </div>
    @endif
</div>

<div class="col-md-3 mt-5 mt-md-0 p-lg-0">
    <div class="detail_sidebar">
        <h3 class="font-weight-bold">{{__('label.job_detail_page.job_overview')}}</h3>
        {{-- <img src="{{ asset('img/logo.png') }}" alt="" class="rounded-circle user-90 mb-3"> --}}
        <a class="d-none" href="{{route('job-detail.employer.show',$employerJob->createdByUser->slug)}}" title="employer view">
            @if(!empty($employerJob->createdByUser->usersProfile) &&
            $employerJob->createdByUser->usersProfile->logo->count())
            @include('vendor.image_upload.display', ['document_type' =>
            config('constants.document_type.image', 0), 'imageModel' =>
            $employerJob->createdByUser->usersProfile, 'class_li' => 'mb-3'])
            @else
            @include('vendor.image_upload.no_image', ['class_li' => 'mb-3'])
            @endif
        </a>
        {{-- <p class="mb-3"> <span class="font-weight-medium">Job ID :</span> <span>{{$employerJob->job_number ?? ''}}</span>
        </p> --}}

        @if(isset($employerJob->workTypes) && $employerJob->workTypes->count() > 0)
        <span class="">{{__('label.job_detail_page.job_type')}}</span>
            <p class="">
                @foreach($employerJob->workTypes as $key => $workType)
                    {{$workType->workType->title?? ''}}@if($loop->index < $employerJob->workTypes->count()-1){{',' }}@endif
                @endforeach
            </p>
        </p>
        @endif
        @if($employerJob->address)
            <span class="">{{__('label.job_detail_page.job_location')}}</span>
            <p>{{$employerJob->address ?? ''}}</p>
        @endif
        {{-- @if($employerJob->area)
            <span class="">{{__('label.job_detail_page.community')}}</span>
            <p>{{$employerJob->area ?? '-'}}</p>
        @endif --}}
        @if($employerJob->salary)
            <span class="">{{__('label.job_detail_page.salary')}}</span> <p>
            {{config('constants.currency_symbol', 'BD')}} {{$employerJob->salary->title ?? ''}} /
                {{config('constants.salary_type.data.'. $employerJob->salary_type_id)}}</p>
        @endif
        @if($employerJob->experience)
            <span class="">{{__('label.job_detail_page.experience')}}</span>
            {{-- <p> {{$employerJob->experience->title ?? ''}} Years</p> --}}
            <p>
        @if($employerJob->experience->title == 1)
             1 year
        @elseif($employerJob->experience->title > 1)
            {{$employerJob->experience->title}} years
        @else
            No experience
        @endif
    </p>
        @endif
        @if($employerJob->category)
            <span class="">{{__('label.job_detail_page.category')}}</span> <p>
                {{$employerJob->category->title ?? ''}}</p>
        @endif
        {{-- @if($employerJob->job_type_id)
            <span class="">{{__('label.job_detail_page.job_type_id')}}</span> <p>
                {{$employerJob->jobTypes->title ?? ''}}</p>
        @endif
        @if($employerJob->specialization_id)
        <span class="">{{__('label.job_detail_page.specialization')}}</span> <p>
            {{$employerJob->specialization->name ?? '-'}}</p>
        @endif --}}
    </div>


</div>

@role('jobseeker')
@if($relatedJobs->count() > 0)
<div class="col-12">
    <div class="row mt-5">
        <div class="col-12">
            <h4 class="font-weight-bold mb-3">{{__('label.job_detail_page.related_job')}}</h4>
        </div>
        @foreach($relatedJobs as $job)
        @include('components.jobs.card')
        @endforeach
    </div>
</div>
@endif
@endrole
