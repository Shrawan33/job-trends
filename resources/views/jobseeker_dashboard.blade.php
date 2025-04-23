@extends('layouts.front')
<style>
    .img-fluid {
        max-width: 50px !important;
    }
</style>
@section('content')
    <div class="container mt-5">
        <div class="job_top_banner bg_frame position-relative">
            <img src="{{ asset('images/inner_banner.png') }}" alt="fea_img" width="100%" class="inner_banner">
            <div class="row mx-0 position-relative p-lg-2">
                <div class="col-md-12 mb-3 mb-md-0 d-flex align-items-center justify-content-between flex-wrap">
                    <div class="mb-3 mb-md-0">
                        <h1 class="mb-3">Welcome {{ $user->first_name }} </h1>
                        {{-- <h6 class="text-dark font-wight-bold h6 mb-0 ml-4">{{trans('label.profile_views')}}: @if ($user->seekerDetail) {{$user->seekerDetail->views}} @else 0 @endif</h6> --}}
                        <p class="last_jobi_text d-flex align-items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22"
                                fill="none">
                                <path
                                    d="M4.87319 17.8182C5.43082 16.5044 6.73276 15.583 8.24992 15.583H13.7499C15.2671 15.583 16.569 16.5044 17.1266 17.8182M14.6666 8.70801C14.6666 10.7331 13.025 12.3747 10.9999 12.3747C8.97487 12.3747 7.33325 10.7331 7.33325 8.70801C7.33325 6.68296 8.97487 5.04134 10.9999 5.04134C13.025 5.04134 14.6666 6.68296 14.6666 8.70801ZM20.1666 10.9997C20.1666 16.0623 16.0625 20.1663 10.9999 20.1663C5.93731 20.1663 1.83325 16.0623 1.83325 10.9997C1.83325 5.93706 5.93731 1.83301 10.9999 1.83301C16.0625 1.83301 20.1666 5.93706 20.1666 10.9997Z"
                                    stroke="#717884" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            {{ trans('label.last_login') }}: @if (Session::get('last_login') != '')
                                {{ FunctionHelper::fromSqlDateTime(Session::get('last_login'), true, '') }}
                            @endif
                        </p>
                    </div>
                    <a class="btn btn-primary ml-auto" href="{{ route('subscription.chatgpt-service-plan') }}">
                        <span class="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                <path d="M7.99998 1.58331V14.4166M1.58331 7.99998H14.4166" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </span> {!! __('label.resume_builder') !!}
                    </a>
                    {{-- <a href="{{ route('resumebuilder') }}" class="btn btn-primary ml-auto btn-sm">
                        Resume builder
                    </a> --}}
                </div>
                {{-- <div class="col-md-4 d-flex justify-content-end">
				<div class="counter_wraper">
					<span class="number text-primary">{{$applied_jobs}}</span>
					<p class="mb-0">Applied Jobs</p>
				</div>
			</div> --}}
            </div>
        </div>
    </div>
    <div class="container jobseeker_dashboard my-lg-50">
        @if (auth()->user()->isProfileComplete()['incompleteSections'] !== true)
            <div class="profile_alert_msg alert alert-info">
                <p class="mb-0">{{ trans('message.incomplete_profile_js') }} <a
                        href="{{ route('users.profile') }}">{{ __('label.click_here') }}</a></p>
            </div>
        @endif
        <div class="row">
            @include('auth.job_seeker.profile.layout')
            <div class="col-md-8 col-lg-9">
                <div class="right_side_wraper">
                    <div class="col-12 table_box mb-5">
                        <ul class="p-0 m-0 counter_wraper">
                            <li>
                                <span class="number">{{ $applied_jobs }}</span>
                                <p class="mb-0">
                                    @if ($applied_jobs == 0 || $applied_jobs == 1)
                                        {{ trans('label.applied_job') }}
                                    @else
                                        {{ trans('label.applied_jobs') }}
                                    @endif
                                </p>
                            </li>
                            <li>
                                <span class="number">{{ $shortlisted ?? 0 }}</span>
                                <p class="mb-0">{{ trans('label.shortlisted') }}</p>
                            </li>
                            <li>
                                <span class="number">{{ $hired ?? 0 }}</span>
                                <p class="mb-0">{{ trans('label.accepted') }}</p>
                            </li>
                            <li>
                                <span class="number">{{ $rejected ?? 0 }}</span>
                                <p class="mb-0">{{ trans('label.rejected') }}</p>
                            </li>
                            <li>
                                <span class="number">{{ $pending ?? 0 }}</span>
                                <p class="mb-0">{{ trans('label.pending') }}</p>
                            </li>
                            <li>
                                <span class="number">{{ $hired ?? 0 }}</span>
                                <p class="mb-0">{{ trans('label.hired') }}</p>
                            </li>
                        </ul>
                    </div>
                    <div class="table_box mb-5">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <h3 class="mb-0">{{ trans('label.my_applied_job') }}</h3>
                            <a class="btn btn-primary btn-sm"
                                href="{{ route('applyJobs.index') }}">{{ trans('label.view_applied_job') }}</a>
                        </div>
                        @if (isset($myjobs))
                            <table class="table table-theme mb-0">
                                <thead class="">
                                    <tr>
                                        <th>{{ trans('label.candidate_profile_title') }}</th>
                                        <th>{{ trans('label.employer') }}</th>
                                        <!--<th>{{ trans('label.employer_view.location') }}-->
                                        {{-- <th>{{trans('label.statusSelect')}}</th> --}}
                                        <th>{{ trans('label.applied_on') }}</th>
                                        <th class="text-center">{{ trans('label.action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($myjobs as $myjob)
                                        <tr>
                                            <td data-title="Title"><a
                                                    href="{{ route('job-detail', $myjob->slug) }}">{{ $myjob->title ?? '' }}</a>
                                            </td>
                                            <td data-title="Company"><a
                                                    href="{{ route('job-detail', $myjob->employerJob->slug) }}">{{ $myjob->company_name ?? '' }}</a>
                                            </td>

                                            {{-- <td data-title="Company" class="company_name_column"><a href="{{route('job-detail.employer.show', $myjob->createdByUser->slug ?? 0)}}" style="color:#007bff">{{$myjob->company_name ??''}}</a></td> --}}
                                            <!--<td data-title="Location">{{ $myjob->employerJob->location->title ?? '' }}</td>-->
                                            {{-- <td data-title="Status">{{$myjob->status ??''}}</td> --}}
                                            {{-- <td data-title="Created At">{{$myjob->created_at ? date('M d, Y', strtotime($myjob->created_at)) : ''}}</td> --}}

                                            <td data-title="Created At">
                                                {{ $myjob->created_at ? FunctionHelper::fromSqlDateTime($myjob->created_at, true, '') : '' }}
                                            </td>
                                            <td data-title="Action" class="text-center">
                                                {!! Form::open([
                                                    'route' => ['applyJobs' . '.update-destroy', $myjob->id],
                                                    'method' => 'delete',
                                                    'class' => 'mb-0',
                                                    'data-model' => 'applyJob',
                                                    'id' => "applyJob_$myjob->id",
                                                ]) !!}
                                                {!! Form::hidden('process', 'delete') !!}
                                                <a class="d-block text-center p-3 text-danger withdrow_btn"
                                                    href="javascript:submitFormByaction('delete', 'applyJob_{{ $myjob->id }}','{{ $msg ?? __(' Do you really want to withdraw application from this job?') }}')"
                                                    data-toggle="tooltip" data-placement="top"
                                                    title="{!! __('label.withdrow_job') !!}" style="padding:0!important">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="20"
                                                        viewBox="0 0 18 20" fill="none" class="mr-2">
                                                        <path
                                                            d="M12.5556 4.6V3.88C12.5556 2.87191 12.5556 2.36786 12.3618 1.98282C12.1913 1.64413 11.9194 1.36876 11.5849 1.19619C11.2046 1 10.7068 1 9.71111 1H8.28889C7.29324 1 6.79542 1 6.41513 1.19619C6.08062 1.36876 5.80865 1.64413 5.63821 1.98282C5.44444 2.36786 5.44444 2.87191 5.44444 3.88V4.6M7.22222 9.55V14.05M10.7778 9.55V14.05M1 4.6H17M15.2222 4.6V14.68C15.2222 16.1921 15.2222 16.9482 14.9316 17.5258C14.6759 18.0338 14.268 18.4469 13.7662 18.7057C13.1958 19 12.449 19 10.9556 19H7.04445C5.55097 19 4.80423 19 4.2338 18.7057C3.73204 18.4469 3.32409 18.0338 3.06843 17.5258C2.77778 16.9482 2.77778 16.1921 2.77778 14.68V4.6"
                                                            stroke="#F00404" stroke-width="1.5" stroke-linecap="round"
                                                            stroke-linejoin="round"></path>
                                                    </svg>
                                                    {{-- {{__('Withdraw')}} --}}
                                                </a>
                                                {!! Form::close() !!}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            {{ 'N/A' }}
                        @endif
                    </div>
                    <div class="profile_box related_box jobi_dashboard_related">
                        @if ($relatedJobs->count() > 0)
                            <h3 class="">{{ trans('label.recommended_job') }}</h3>
                            <div class="row related_job_wraper">
                                @foreach ($relatedJobs as $job)
                                    @include('components.jobs.recommended-job')
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
@push('page_scripts')
    <script>
        $('#globalModal').on('shown.bs.modal', function(e) {
            $("#message_box").animate({
                scrollTop: $('#message_box').prop("scrollHeight")
            }, 500);
        });
    </script>
@endpush
