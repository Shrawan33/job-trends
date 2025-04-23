<div class="col-lg-5 left_side p-lg-3 border-right">
    {{-- <div class="d-flex align-items-center justify-content-between mb-3">
        <p class="mb-0">{!! __('label.showing') !!} {{ $totalJobs->firstItem() ?? 0 }}-{{ $totalJobs->lastItem() }} of
            {{ $totalJobs->total() }} {!! __('label.result') !!}</p>
        {!! Form::select(
            'sort_by',
            ['newest' => 'Newest First', 'oldest' => 'Oldest First'],
            old($name ?? 'sort_by', $selected ?? null),
            ['class' => 'form-control no-select2 py-2', 'multiple' => false, 'id' => 'sort_by'],
        ) !!}

    </div>   --}}
    <div class="d-flex align-items-center justify-content-between mb-3 mt-1">
        <p class="mb-0">@lang('label.showing') {{ $totalJobs->firstItem() ?? 0 }}-{{ $totalJobs->lastItem() }} of
            {{ $totalJobs->total() }} @lang('label.result')</p>
        {!! Form::select(
            'sort_by',
            ['newest' => __('Newest First'), 'oldest' => __('Oldest First')],
            Request::get('sort_by', 'newest'),
            ['class' => 'form-control no-select2 py-2', 'id' => 'sort_by'],
        ) !!}
    </div>




    <div class="mb-4">
        @role('jobseeker')
            <a href="javascript:void(0)" class="btn btn-primary open-form w-100" data-mode="create" data-modal-size="modal-lg"
                data-title="{{ trans('label.add_alert') }}" data-model="jobAlert" data-url="{{ route('jobAlerts.create') }}"
                class="open-form btn gets-job-arlert-button">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="18" viewBox="0 0 16 12" fill="none">
                    <path
                        d="M14.3333 10L9.90477 6.00002M6.09525 6.00002L1.6667 10M1.33334 2.66669L6.77662 6.47698C7.2174 6.78553 7.43779 6.9398 7.67752 6.99956C7.88927 7.05234 8.11075 7.05234 8.3225 6.99956C8.56223 6.9398 8.78262 6.78553 9.2234 6.47698L14.6667 2.66669M4.53334 11.3334H11.4667C12.5868 11.3334 13.1468 11.3334 13.5747 11.1154C13.951 10.9236 14.2569 10.6177 14.4487 10.2413C14.6667 9.81351 14.6667 9.25346 14.6667 8.13335V3.86669C14.6667 2.74658 14.6667 2.18653 14.4487 1.75871C14.2569 1.38238 13.951 1.07642 13.5747 0.884674C13.1468 0.666687 12.5868 0.666687 11.4667 0.666687H4.53334C3.41324 0.666687 2.85319 0.666687 2.42536 0.884674C2.04904 1.07642 1.74308 1.38238 1.55133 1.75871C1.33334 2.18653 1.33334 2.74658 1.33334 3.86669V8.13335C1.33334 9.25346 1.33334 9.81351 1.55133 10.2413C1.74308 10.6177 2.04904 10.9236 2.42536 11.1154C2.85319 11.3334 3.41324 11.3334 4.53334 11.3334Z"
                        stroke="#FFF" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
              {{ trans('label.get_job_alert') }} </a>
        @else
            <a href="{{ route('login') }}" class="btn btn-primary open-form w-100">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="18" viewBox="0 0 16 12" fill="none">
                    <path
                        d="M14.3333 10L9.90477 6.00002M6.09525 6.00002L1.6667 10M1.33334 2.66669L6.77662 6.47698C7.2174 6.78553 7.43779 6.9398 7.67752 6.99956C7.88927 7.05234 8.11075 7.05234 8.3225 6.99956C8.56223 6.9398 8.78262 6.78553 9.2234 6.47698L14.6667 2.66669M4.53334 11.3334H11.4667C12.5868 11.3334 13.1468 11.3334 13.5747 11.1154C13.951 10.9236 14.2569 10.6177 14.4487 10.2413C14.6667 9.81351 14.6667 9.25346 14.6667 8.13335V3.86669C14.6667 2.74658 14.6667 2.18653 14.4487 1.75871C14.2569 1.38238 13.951 1.07642 13.5747 0.884674C13.1468 0.666687 12.5868 0.666687 11.4667 0.666687H4.53334C3.41324 0.666687 2.85319 0.666687 2.42536 0.884674C2.04904 1.07642 1.74308 1.38238 1.55133 1.75871C1.33334 2.18653 1.33334 2.74658 1.33334 3.86669V8.13335C1.33334 9.25346 1.33334 9.81351 1.55133 10.2413C1.74308 10.6177 2.04904 10.9236 2.42536 11.1154C2.85319 11.3334 3.41324 11.3334 4.53334 11.3334Z"
                        stroke="#FFF" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
                {{ trans('label.get_job_alert') }}</a>
        @endrole
    </div>
    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
        @forelse($totalJobs as $job)
            <button
                class="nav-link particular_job @if ($loop->index == 0) active @endif @if ($job->job_type_id == config('constants.job_type_id')) @endif"
                id="v-pills-{{ $job->id }}-tab" data-toggle="pill" data-target="#v-pills-{{ $job->id }}"
                type="button" role="tab" aria-controls="v-pills-home" aria-selected="true">
                {{-- <a href="{{route('job-detail', $job->slug)}}" class="text-body"> --}}
                @if (!empty($job->createdByUser->usersProfile) && $job->createdByUser->usersProfile->logo->count())
                    @include('vendor.image_upload.display', [
                        'document_type' => config('constants.document_type.image', 0),
                        'imageModel' => $job->createdByUser->usersProfile,
                        'class_li' => '',
                        'wrapper_class' => 'place_logo',
                        'thumbnail' => true,
                    ])
                @else
                    @include('vendor.image_upload.no_image', ['class_li' => ''])
                @endif
                {{-- @if ($job->job_type_id == config('constants.job_type_id'))
                    <div class="principal_tag">
                        <span>Principal</span>
                    </div>
                @endif --}}

                {{-- <h4 class="text-primary mb-1 text-truncate">{{$job->title ?? ''}}</h4> --}}
                {{-- </a> --}}

                <div class="ml-3 job_name">
                    <h3>{{ $job->title ?? '' }}</h3>
                    <h4 class="post_info">{{ trans('label.posted') }} <a
                        href="{{ route('job-detail.employer.show', $job->createdByUser->slug) }}"
                        class="text-primary">{{ $job->createdByUser->company_name ?? '' }}</a> •
                    {{ $job->created_at->diffForHumans() ?? '' }}</h4>
                    @if (Auth::check())

                        @if ($job->appliedJob && $job->appliedJob->is_apply == 0)
                        <a class="disabled principle_badge ml-0 mt-2 applied_job" href="javascript:void(0)"
                            >
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="12" viewBox="0 0 20 12"
                                fill="none">
                                <path
                                    d="M0.833984 6.00033L5.41732 10.5837M10.0007 6.00033L14.584 1.41699M5.41732 6.00033L10.0007 10.5837L19.1673 1.41699"
                                    stroke="#36951E" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                            {!! __('label.applied_btn') !!}
                        </a>
                    @endif
                    @endif

                    {{-- @if ($job->salary)
                            <p class="package mb-0">{{$job->salary->title ?? ''}} / {{config('constants.salary_type.data.'. $job->salary_type_id)}}</p>
                        @endif --}}
                </div>

                {{-- <svg xmlns="http://www.w3.org/2000/svg" width="8" height="14" viewBox="0 0 8 14" fill="none" class="right_arrow">
                    <path d="M1 13L7 7L1 1" stroke="#357de8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg> --}}
            </button>
        @empty
            <p>{!! __('label.no_data_found') !!}</p>
        @endforelse
    </div>
</div>
<div class="col-lg-7 right_side p-3">
    <div class="back_to_listing d-lg-none d-flex align-items-center my-4">
        <svg width="32" height="32" fill="#357de8" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
            class="mr-2">
            <path
                d="M12 2a10 10 0 1 0 0 20 10 10 0 0 0 0-20Zm4.375 9.375a.624.624 0 1 1 0 1.25H9.134l2.684 2.682a.627.627 0 0 1-.886.885l-3.75-3.75a.625.625 0 0 1 0-.885l3.75-3.75a.626.626 0 0 1 .886.886l-2.684 2.682h7.241Z">
            </path>
        </svg>
        Back
    </div>
    <div class="tab-content" id="v-pills-tabContent">
        @forelse($totalJobs as $job)
            @include('components.jobs.detail_card', ['class' => ''])
        @empty
            <p>{!! __('label.no_data_found') !!}</p>
        @endforelse
    </div>
</div>

{{-- <div class="list-item-view" id="load">
    <p>{!! __('label.showing') !!} {{$totalJobs->firstItem()??0}}-{{$totalJobs->lastItem()}} of {{$totalJobs->total()}} {!! __('label.result') !!}</p>
    <div class="row mt-3">

        @forelse($totalJobs as $job)

        @include('components.jobs.card',['class' => "col-md-6"])

        @empty
        <p>{!! __('label.no_data_found') !!}</p>
        @endforelse

    </div>
</div> --}}
<div class="col-md-12 col-lg-5 mt-5">
    <div class="text-center">
        {!! $totalJobs->render('vendor.pagination.custom') !!}
    </div>
</div>


<script>
    $(document).ready(function() {

        $(".particular_job").on("click", function() {
            $('.right_side').addClass('active_job_detail');
        });

        $('.back_to_listing').click(function() {
            $('.right_side').removeClass('active_job_detail');
        });

        $("#v-pills-tab button").on("shown.bs.tab", function(event) {
            var targetTab = $(event.target).data("target");
            $('html, body').animate({
                scrollTop: $("#check-search").offset().top
            }, 100);
        });
    });
</script>
