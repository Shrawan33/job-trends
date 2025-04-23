@extends('layouts.front')
@section('content')
    <div class="emp_dashboard_page">
        <div class="container">
            <div class="d-flex align-items-center justify-content-between flex-wrap mb-40">
                {{-- <h1 class="inner_page_heading">Hi {{$user->first_name}}</h1> --}}
                <h1 class="inner_page_heading m-0">Welcome!</h1>
                @if (Session::get('last_login'))
                    <p class="mb-0 text-black font-weight-medium">{{ trans('label.last_login') }}:
                        {{ date('M d, Y g:i A', strtotime(Session::get('last_login'))) }}
                    </p>
                @endif

            </div>
            <div class="row mx-0">
                <div class="col-12 table_box mb-50 pb-20">
                    <h3 class="">{{ trans('label.personal_details') }}</h3>
                    {{-- @if (isset($user->usersProfile) && isset($user)) --}}
                    <div class="row">
                        @if (!empty($user->company_name))
                            <div class="col-md-4 col-lg-3 mb-4">
                                <span class="label_text">{{ trans('label.company_name') }}</span>
                                <p class="label_value mb-0">{{ $user->company_name ?? null }}</p>
                            </div>
                        @endif

                        @if ($user)
                            <div class="col-md-4 col-lg-3 mb-4">
                                <span class="label_text">{{ trans('label.contact_person_name') }}</span>
                                <p class="label_value mb-0">{{ $user->first_name . ' ' . $user->last_name ?? '-' }}</p>
                            </div>
                        @endif

                        @if ($user->email)
                            {{-- <div class="col-md-4 col-lg-3 mb-4">
                        <span class="label_text">{{trans('label.email')}}</span>
                        <p class="label_value mb-0">{{$user->email ?? null}}</p>
                    </div> --}}

                            <div class="col-md-4 col-lg-3 mb-4">
                                <span class="label_text">{{ trans('label.email') }}</span>
                                <a href="mailto:{{ $user->email ?? '' }}"
                                    class="label_value mb-0">{{ $user->email ?? '' }}</a>
                            </div>
                        @endif

                        @if ($user->phone_number)
                            <div class="col-md-4 col-lg-3 mb-4">
                                <span class="label_text">{{ trans('label.phone_number') }}</span>
                                <p class="label_value mb-0">{{ $user->phone_number ?? null }}</p>
                            </div>
                        @endif



                        @if (!empty($user->usersProfile->company_email))
                            <div class="col-md-4 col-lg-3 mb-4">
                                <span class="label_text">Company {{ trans('label.company_email') }}</span>
                                <p class="label_value mb-0">{{ $user->usersProfile->company_email ?? null }}</p>
                            </div>
                        @endif

                        @if (!empty($user->usersProfile->company_phone))
                            <div class="col-md-4 col-lg-3 mb-4">
                                <span class="label_text">{{ trans('Office Number') }}</span>
                                <p class="label_value mb-0">{{ $user->usersProfile->company_phone ?? null }}</p>
                            </div>
                        @endif

                        @if ($user->usersProfile->address ?? null)
                            <div class="col-md-4 col-lg-3 mb-4">
                                <span class="label_text">{{ trans('label.permanent_address') }}</span>
                                <p class="label_value mb-0">{{ $user->usersProfile->user_address ?? null }}</p>
                            </div>
                        @endif

                        @if ($user->usersProfile->company_website ?? null)
                            <div class="col-md-4 col-lg-3 mb-4">
                                <span class="label_text">{{ trans('label.company_website') }}</span>
                                <p class="label_value mb-0">{{ $user->usersProfile->company_website ?? null }}</p>
                            </div>
                        @endif

                        @if ($user->dob)
                            <div class="col-md-4 col-lg-3 mb-4">
                                <span class="label_text">{{ trans('label.dob') }}</span>
                                <p class="label_value mb-0">
                                    {{ isset($user->dob) ? FunctionHelper::fromSqlDate($user->dob->toDateString(), true, 'd M, Y') : null }}
                                </p>
                            </div>
                        @endif

                        @if (!empty($user->nin))
                            <div class="col-md-4 col-lg-3 mb-4">
                                <span class="label_text">{{ trans('label.nin') }}</span>
                                <p class="label_value mb-0">{{ $user->nin ?? null }}</p>
                            </div>
                        @endif
                        {{-- @if (!empty($user->usersProfile->qec))
                            <div class="col-md-4 col-lg-3">
                                <span class="label_text">{!! trans('label.qec') !!}</span>
                                <p class="label_value mb-0">{!! $user->usersProfile->qec ?? '-' !!}</p>
                            </div>
                        @endif --}}
                    </div>
                    {{-- @endif --}}
                </div>
                <div class="col-12 table_box mb-50">
                    <ul class="p-0 m-0 counter_wraper">
                        <li>
                            <span class="number">{{ $activejobs }}</span>
                            <p class="mb-0">
                                @if ($activejobs == 0 || $activejobs == 1)
                                    Active Job
                                @else
                                    Active Jobs
                                @endif
                            </p>
                        </li>

                        <li>
                            <span class="number">{{ $hired ?? 0 }}</span>
                            <p class="mb-0">
                                @if ($hired == 0 || $hired == 1)
                                    Hired Application
                                @else
                                    Hired Applications
                                @endif
                            </p>
                            {{-- <p class="mb-0">Hired Applications @if ($hired > 1)
                                    <span class="s-text-wrapper"></span>
                                @endif
                            </p> --}}
                        </li>
                        <li>
                            <span class="number">{{ $rejected ?? 0 }}</span>
                            <p class="mb-0">
                                @if ($rejected == 0 || $rejected == 1)
                                    Rejected Application
                                @else
                                    Rejected Applications
                                @endif
                            </p>
                            {{-- <p class="mb-0">Rejected Applications @if ($rejected > 1)
                                    <span class="s-text-wrapper"></span>
                                @endif
                            </p> --}}
                        </li>
                        <li>
                            <span class="number">{{ $shortlisted ?? 0 }}</span>
                            <p class="mb-0">
                                @if ($shortlisted == 0 || $shortlisted == 1)
                                    Shortlisted Application
                                @else
                                    Shortlisted Applications
                                @endif
                            </p>
                            {{-- <p class="mb-0">Shortlisted Applications @if ($shortlisted > 1)
                                    <span class="s-text-wrapper"></span>
                                @endif
                            </p> --}}
                        </li>
                        <li>
                            <span class="number">{{ $Contacting ?? 0 }}</span>
                            <p class="mb-0">
                                @if ($Contacting == 0 || $Contacting == 1)
                                    Contacting Application
                                @else
                                    Contacting Applications
                                @endif
                            </p>
                            {{-- <p class="mb-0">Contacting Application @if ($Contacting > 1)
                                    <span class="s-text-wrapper">s</span>
                                @endif
                            </p> --}}
                        </li>
                        <li>
                            <span class="number">{{ $pending ?? 0 }}</span>
                            <p class="mb-0">
                                @if ($pending == 0 || $pending == 1)
                                    Pending Application
                                @else
                                    Pending Applications
                                @endif
                            </p>
                            {{-- <p class="mb-0">Pending Application @if ($pending > 1)
                                    <span class="s-text-wrapper">s</span>
                                @endif
                            </p> --}}
                        </li>
                        <li>
                            <span class="number">{{ $interviewschedulecount ?? 0 }}</span>
                            <p class="mb-0">
                                @if ($interviewschedulecount == 0 || $interviewschedulecount == 1)
                                    Interview Schedule
                                @else
                                    Interview Schedules
                                @endif
                            </p>
                            {{-- <p class="mb-0">Interview Schedules @if ($interviewschedulecount > 1)
                                    <span class="s-text-wrapper"></span>
                                @endif
                            </p> --}}
                        </li>
                    </ul>
                </div>
                <div class="col-12 table_box mb-50 pb-20">
                    <div class="d-flex align-items-center justify-content-between mb-40 flex-wrap">
                        <h3 class="mb-0">{{ trans('label.my_jobs') }}</h3>
                        <div class="d-flex align-item-center ">
                            <a class="btn btn-primary btn-sm" href="{{ route('employerJobs.index') }}"> View All Jobs </a>
                            <a class="btn btn-secondary btn-sm ml-3" href="{{ route('subscription.service.employer') }}">{!! __('label.buy_package') !!}</a>
                        </div>
                    </div>
                    @if (isset($myjobs))
                        <div class="table-responsive">
                            <table class="table table-theme mb-0">
                                <thead class="">
                                    <tr>
                                        <th> {{ trans('label.job_title') }}</th>
                                        <th> {{ trans('label.days_of_posting') }}</th>
                                        <th> {{ trans('Applications') }}</th>
                                        <th> {{ trans('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($myjobs as $myjob)
                                        <tr>
                                            <td data-title="Title"> <a href="{{ route('job-detail', $myjob->slug) }}">
                                                    {{ $myjob->title ?? '' }} </a></td>
                                            <td data-title="Date">{{ $myjob->created_at->diffForHumans() ?? '' }}</td>
                                            <td data-title="Counts"><a
                                                    href="{{ route('applicationTrackings.index', $myjob->id) }}">{{ $myjob->apply_job_count }}</a>
                                            </td>
                                            <td>
                                                <input type="hidden" value="{{ route('job-detail', $myjob->slug) }}"
                                                    id="copy_url_input_{{ $myjob->id }}">
                                                <a href="javascript:void(0);"
                                                    onclick="copyToClipboard('#copy_url_input_{{ $myjob->id }}')"
                                                    data-toggle="tooltip" data-placement="top" title="Copy Link"
                                                    id="shareJob_{{ $myjob->id }}"
                                                    class="share_btn {{ $class_share_btn ?? ' btn-lg ' }}">
                                                    {{-- <svg xmlns="http://www.w3.org/2000/svg" width="18" height="20" viewBox="0 0 18 20" fill="none">
                                        <path d="M6.15833 11.2587L11.85 14.5753M11.8417 5.42533L6.15833 8.74199M16.5 4.16699C16.5 5.5477 15.3807 6.66699 14 6.66699C12.6193 6.66699 11.5 5.5477 11.5 4.16699C11.5 2.78628 12.6193 1.66699 14 1.66699C15.3807 1.66699 16.5 2.78628 16.5 4.16699ZM6.5 10.0003C6.5 11.381 5.38071 12.5003 4 12.5003C2.61929 12.5003 1.5 11.381 1.5 10.0003C1.5 8.61961 2.61929 7.50033 4 7.50033C5.38071 7.50033 6.5 8.61961 6.5 10.0003ZM16.5 15.8337C16.5 17.2144 15.3807 18.3337 14 18.3337C12.6193 18.3337 11.5 17.2144 11.5 15.8337C11.5 14.4529 12.6193 13.3337 14 13.3337C15.3807 13.3337 16.5 14.4529 16.5 15.8337Z" stroke="#717884" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg> --}}
                                                    {{-- <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 20 20" fill="none">
                                            <path d="M3.7 12.7C2.86131 12.7 2.44196 12.7 2.11117 12.563C1.67012 12.3803 1.31971 12.0299 1.13702 11.5888C1 11.258 1 10.8387 1 10V3.88C1 2.87191 1 2.36786 1.19619 1.98282C1.36876 1.64413 1.64413 1.36876 1.98282 1.19619C2.36786 1 2.87191 1 3.88 1H10C10.8387 1 11.258 1 11.5888 1.13702C12.0299 1.31971 12.3803 1.67012 12.563 2.11117C12.7 2.44196 12.7 2.86131 12.7 3.7M10.18 19H16.12C17.1281 19 17.6321 19 18.0172 18.8038C18.3559 18.6312 18.6312 18.3559 18.8038 18.0172C19 17.6321 19 17.1281 19 16.12V10.18C19 9.17191 19 8.66786 18.8038 8.28282C18.6312 7.94413 18.3559 7.66876 18.0172 7.49619C17.6321 7.3 17.1281 7.3 16.12 7.3H10.18C9.17191 7.3 8.66786 7.3 8.28282 7.49619C7.94413 7.66876 7.66876 7.94413 7.49619 8.28282C7.3 8.66786 7.3 9.17191 7.3 10.18V16.12C7.3 17.1281 7.3 17.6321 7.49619 18.0172C7.66876 18.3559 7.94413 18.6312 8.28282 18.8038C8.66786 19 9.17191 19 10.18 19Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            </svg> --}}

                                                    {{-- <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                                <path d="M15 7.62712V5.38983C15 3.51769 13.4843 2 11.6146 2H5.38542C3.51568 2 2 3.51769 2 5.38983V14.6102C2 16.4823 3.51568 18 5.38542 18H7.38281" stroke="#717884" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M14.6049 13C15.1833 13.7916 15.1539 14.9584 14.3355 15.895L13.1609 17.2395C12.2937 18.2322 11.1948 18.2105 10.5054 17.4215C9.81604 16.6324 9.79715 15.3747 10.6645 14.382" stroke="#717884" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M13.421 14C12.816 13.2162 12.8341 12.0138 13.6644 11.0763L14.8391 9.75017C15.7064 8.77098 16.8052 8.79231 17.4946 9.57064C18.184 10.349 18.2028 11.5896 17.3356 12.5688" stroke="#717884" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                                </svg> --}}
                                                    {{-- <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                                    <path d="M18 10.1017V15.9661C18 17.0894 17.0894 18 15.9661 18H4.0339C2.91061 18 2 17.0894 2 15.9661V4.0339C2 2.91061 2.91061 2 4.0339 2H9.9322" stroke="#717884" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"/>
                                                    <path d="M13.5932 6.44088L9.1864 10.8477" stroke="#717884" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"/>
                                                    <path d="M14.373 8.99023C15.0733 8.83857 15.7906 8.42454 16.4859 7.73067L16.5566 7.64912L16.6382 7.5784C17.5286 6.68667 18.0001 5.74823 18.0001 4.86566C18.0001 4.16359 17.7037 3.51159 17.1191 2.92786C17.005 2.81396 16.8857 2.70905 16.7645 2.6161L16.6986 2.56562L16.6922 2.55671C16.2214 2.21 15.7092 2.03433 15.1687 2.03433C14.2868 2.03433 13.349 2.50518 12.4559 3.3963L12.3854 3.47789L12.3036 3.54864C11.4133 4.44034 10.9418 5.37881 10.9418 6.26128C10.9418 6.62905 11.0327 6.99071 11.1938 7.32813C11.1938 7.32813 11.558 7.8883 11.754 8.08437" stroke="#717884" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                                    <path d="M8.33899 8.27609C7.65885 8.44256 6.97692 8.87646 6.2938 9.55805L6.22319 9.63965L6.14153 9.71036C5.25112 10.6021 4.77966 11.5405 4.77966 12.4231C4.77966 13.1252 5.07607 13.7771 5.66065 14.3609C5.77471 14.4748 5.89404 14.5797 6.01526 14.6726L6.08112 14.7231L6.08749 14.7321C6.55834 15.0787 7.07051 15.2544 7.61102 15.2544C8.49299 15.2544 9.43075 14.7836 10.3238 13.8925L10.3944 13.8108L10.4761 13.7401C11.3665 12.8484 11.838 11.9099 11.838 11.0274C11.838 10.6597 11.7471 10.2981 11.5859 9.96066C11.5859 9.96066 11.2778 9.34449 11.0537 9.12039" stroke="#717884" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                                    </svg> --}}
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                        viewBox="0 0 20 20" fill="none">
                                                        <g clip-path="url(#clip0_1201_4525)">
                                                            <path
                                                                d="M9.98095 5.70578L13.7934 1.89335C14.9845 0.702216 16.9157 0.702216 18.1069 1.89335C19.298 3.08449 19.298 5.01569 18.1069 6.20683L13.2161 11.0977C12.0249 12.2888 10.0937 12.2888 8.90259 11.0977"
                                                                stroke="#717884" stroke-width="1.5" stroke-miterlimit="10"
                                                                stroke-linecap="round" stroke-linejoin="round" />
                                                            <path
                                                                d="M9.98101 14.3326L6.20671 18.1069C5.01557 19.298 3.08437 19.298 1.89323 18.1069C0.702094 16.9157 0.702094 14.9845 1.89323 13.7934L6.74589 8.94072C7.93703 7.74958 9.86823 7.74958 11.0594 8.94072"
                                                                stroke="#717884" stroke-width="1.5" stroke-miterlimit="10"
                                                                stroke-linecap="round" stroke-linejoin="round" />
                                                            <path d="M3.07019 6.79639L4.45234 7.44091" stroke="#717884"
                                                                stroke-width="1.5" stroke-miterlimit="10"
                                                                stroke-linecap="round" stroke-linejoin="round" />
                                                            <path d="M15.5096 12.5977L16.8918 13.2422" stroke="#717884"
                                                                stroke-width="1.5" stroke-miterlimit="10"
                                                                stroke-linecap="round" stroke-linejoin="round" />
                                                            <path d="M6.75842 3.1084L7.40295 4.49055" stroke="#717884"
                                                                stroke-width="1.5" stroke-miterlimit="10"
                                                                stroke-linecap="round" stroke-linejoin="round" />
                                                            <path d="M12.559 15.5479L13.2035 16.93" stroke="#717884"
                                                                stroke-width="1.5" stroke-miterlimit="10"
                                                                stroke-linecap="round" stroke-linejoin="round" />
                                                        </g>
                                                        <defs>
                                                            <clipPath id="clip0_1201_4525">
                                                                <rect width="20" height="20" fill="white" />
                                                            </clipPath>
                                                        </defs>
                                                    </svg>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        {{ 'N/A' }}
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
