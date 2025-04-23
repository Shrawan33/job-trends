@extends('layouts.front')

@section('content')

    <div class="container">
        <div class="row mb-50 jobseeker_dashboard job_seeker_profile">
            {{-- <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="inner_page_heading">{{ trans('label.jobseeker_profile') }}</h1>
                {{-- @include('components.logout_link')

            </div>
        </div> --}}

            <div class="col-12">
                @if (auth()->user()->isProfileComplete()['incompleteSections'] !== true)
                    <div class="alert alert-danger">
                        {{ trans('message.incomplete_profile') }}
                    </div>
                @else
                    {{-- <div class="alert alert-success">
                        {{ trans('message.complete_profile') }} <a href="{{ route('search-jobs.index') }}">Apply Jobs</a>.
                    </div> --}}
                @endif
                <div class="d-flex justify-content-between align-items-center mb-40">
                    <h1 class="inner_page_heading my-0">{{ trans('label.jobseeker_profile') }}</h1>
                    {{-- <div style="text-align: right;">
                        <p class="m-0">{{ trans('message.profile_completion_ration') }} {{auth()->user()->isProfileComplete()['total_percentage_count']}}%</p>
                    </div> --}}
                </div>

            </div>
            @include('auth.job_seeker.profile.layout')

            <div class="col-md-8 col-lg-9">
                <label class="text-black font-weight-bold">{{ trans('message.profile_completion_ration') }}</label>
                <div class="progress mb-4">
                    <div class="progress-bar progress-bar-striped progress-bar-animated font-weight-bold" role="progressbar" aria-valuenow="{{auth()->user()->isProfileComplete()['total_percentage_count']}}" aria-valuemin="0" aria-valuemax="100" style="width: {{auth()->user()->isProfileComplete()['total_percentage_count']}}%">{{auth()->user()->isProfileComplete()['total_percentage_count']}}%</div>
                </div>
                <div class="job_top_banner bg_frame position-relative mb-40 p-xl-40">
                    <img src="{{ asset('images/Profile_fram.png') }}" alt="fea_img" width="100%" class="inner_banner">
                    <div class="position-relative row align-items-center">
                        <div class="col-lg-9">
                            <h2>{{ trans('label.welcome_to_jobtrendsindia') }}</h2>
                            <p class="mb-4 mb-md-0">{{ trans('message.profile_text') }}</p>
                        </div>
                        <div class="col-lg-3 text-md-right px-lg-0">
                            <a href="{{ route('help') }}" class="edit_btn btn btn-secondary ml-md-auto">
                                <svg xmlns="http://www.w3.org/2000/svg" width="23" height="24" viewBox="0 0 23 24"
                                    fill="none">
                                    <path d="M6.5959 21.998C4.50565 21.998 2.92188 20.5282 2.92188 18.2737V15.2832"
                                        stroke="white" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path
                                        d="M18.2334 15.1806C18.5267 15.3157 18.8473 15.3998 19.1876 15.4233C20.6835 15.525 21.9798 14.3938 22.0815 12.8947C22.1812 11.3975 21.051 10.1019 19.5552 10.0001C19.084 9.96879 18.6343 10.0589 18.2334 10.2428V15.1806Z"
                                        stroke="white" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path
                                        d="M8.6816 4.12891C9.51264 4.12891 10.1911 3.44977 10.1911 2.61797C10.1911 1.78618 9.51264 1.10704 8.6816 1.10704C7.84863 1.10704 7.17212 1.78618 7.17212 2.61797C7.17212 3.44977 7.84863 4.12891 8.6816 4.12891Z"
                                        stroke="white" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path
                                        d="M15.1153 4.12891C15.9463 4.12891 16.6248 3.44977 16.6248 2.61797C16.6248 1.78618 15.9463 1.10704 15.1153 1.10704C14.2842 1.10704 13.6057 1.78618 13.6057 2.61797C13.6057 3.44977 14.2842 4.12891 15.1153 4.12891Z"
                                        stroke="white" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path
                                        d="M7.5983 20.994H8.92787C9.47932 20.994 9.93095 21.4441 9.93095 21.996V21.998C9.93095 22.5499 9.47932 23 8.92787 23H7.5983C7.04691 23 6.59521 22.5499 6.59521 21.998V21.996C6.59521 21.4441 7.04691 20.994 7.5983 20.994Z"
                                        stroke="white" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path
                                        d="M4.93354 15.1806C4.64216 15.3157 4.32153 15.3998 3.98123 15.4233C2.48348 15.525 1.18908 14.3938 1.0874 12.8947C0.985721 11.3975 2.11787 10.1019 3.61369 10.0001C4.08492 9.96879 4.53468 10.0589 4.93354 10.2428V15.1806Z"
                                        stroke="white" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path d="M8.68164 6.64648V4.12971" stroke="white" stroke-width="1.5"
                                        stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M15.1147 6.64648V4.12971" stroke="white" stroke-width="1.5"
                                        stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M7.63745 11.0723C8.10281 9.98613 9.85084 9.98613 10.3181 11.0723"
                                        stroke="white" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path d="M10.2815 14.9494C10.7801 16.108 12.6474 16.108 13.146 14.9494" stroke="white"
                                        stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path
                                        d="M7.92156 6.62171H15.2482C16.8906 6.62171 18.2339 7.96619 18.2339 9.61219V15.8122C18.2339 17.4562 16.8906 18.8008 15.2482 18.8008H7.92156C6.27907 18.8008 4.93384 17.4562 4.93384 15.8122V9.61219C4.93384 7.96619 6.27907 6.62171 7.92156 6.62171Z"
                                        stroke="white" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path d="M13.1421 11.0723C13.6094 9.98613 15.3574 9.98613 15.8248 11.0723"
                                        stroke="white" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                                {{ trans('label.need_help') }}</a>
                        </div>
                    </div>
                </div>


                {{-- <a href="{{ route('help') }}" class="edit_btn btn btn-primary btn-sm ml-3"> {{ trans('label.need_help') }}</a> --}}


                <div class="d-flex align-items-center justify-content-between profile_box mb-40 flex-wrap">
                    {{-- <h3 class="mb-0">{{ trans('label.about_me') }}</h3> --}}

                    <div class="d-flex align-items-center info_box profile_box mb-30 mb-lg-0">
                        <div class="candidate-single-profile profile_box d-flex">
                            @if (!empty($seekerDetail) && $seekerDetail->logo->count())
                                @include('vendor.image_upload.display', [
                                    'document_type' => config('constants.document_type.image', 0),
                                    'imageModel' => $seekerDetail,
                                    'class_li' => '',
                                    'thumbnail' => true,
                                ])
                            @else
                                @include('vendor.image_upload.no_user', ['class_li' => ''])
                            @endif
                        </div>
                        <div class="ml-4">
                            {{-- @dd($seekerDetail->parent_name) --}}
                            <h3 class="mb-1">{{ $user->first_name ?? null }} {{ $user->parent_name }}
                                {{ $user->last_name }}</h3>
                            <p class="name mb-0">{{ $user->email ?? null }}</p>

                            <p class="name mb-0">{{ $seekerDetail->title ?? null }}</p>
                        </div>
                    </div>
                    <div class="d-flex">
                        <a href="{{ route('candidate') }}" target="_blank"
                            class="btn btn btn-outline-primary priview_btn btn-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="16" viewBox="0 0 20 16"
                                fill="none">
                                <path
                                    d="M1.21845 8.65391C1.09361 8.45624 1.03119 8.3574 0.996247 8.20496C0.970001 8.09045 0.970001 7.90987 0.996247 7.79536C1.03119 7.64292 1.09361 7.54408 1.21845 7.34642C2.25007 5.71293 5.32078 1.5835 10.0004 1.5835C14.68 1.5835 17.7507 5.71293 18.7823 7.34642C18.9071 7.54408 18.9696 7.64292 19.0045 7.79536C19.0307 7.90987 19.0307 8.09045 19.0045 8.20496C18.9696 8.3574 18.9071 8.45624 18.7823 8.65391C17.7507 10.2874 14.68 14.4168 10.0004 14.4168C5.32078 14.4168 2.25007 10.2874 1.21845 8.65391Z"
                                    stroke="#357de8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                </path>
                                <path
                                    d="M10.0004 10.7502C11.5192 10.7502 12.7504 9.51894 12.7504 8.00016C12.7504 6.48138 11.5192 5.25016 10.0004 5.25016C8.48159 5.25016 7.25037 6.48138 7.25037 8.00016C7.25037 9.51894 8.48159 10.7502 10.0004 10.7502Z"
                                    stroke="#357de8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                </path>
                            </svg>
                            {{ trans('label.preview_profile') }}</a>
                        <a href="{{ route('users.edit.profile', ['mainTitle' => 'intro']) }}"
                            class="edit_btn btn btn-primary btn-sm ml-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="17" height="16" viewBox="0 0 19 18"
                                fill="none">
                                <path
                                    d="M14.4818 7.43286L11.0672 4.0182M1.25 17.25L4.13911 16.929C4.49209 16.8898 4.66859 16.8702 4.83355 16.8168C4.97991 16.7694 5.11919 16.7024 5.24761 16.6177C5.39236 16.5223 5.51793 16.3967 5.76906 16.1456L17.0428 4.87186C17.9857 3.92893 17.9857 2.40013 17.0428 1.4572C16.0999 0.514268 14.5711 0.514267 13.6281 1.4572L2.35441 12.7309C2.10328 12.9821 1.97771 13.1076 1.88226 13.2524C1.79757 13.3808 1.73063 13.5201 1.68325 13.6664C1.62984 13.8314 1.61023 14.0079 1.57101 14.3609L1.25 17.25Z"
                                    stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                </path>
                            </svg>{{ trans('label.edit') }}
                        </a>
                    </div>
                </div>

                <div class="row profile_box mx-0 border-bottom mb-40">
                    <div class="col-md-12 p-0">
                        <div class="mb-4 cust-description">
                            {!! $seekerDetail->profile_summary ?? '-' !!}
                        </div>
                    </div>
                    @if (!empty($seekerDetail->professional_manner))
                        <div class="col-md-12 p-0">
                            <label for="">{{ trans('label.professional_manner') }}</label>
                            <p class="mb-4"> {!! $seekerDetail->professional_manner ?? '-' !!} </p>
                        </div>
                    @endif
                    <div class="col-md-6 col-lg-3 mb-40 pl-lg-0">
                        <span>{{ trans('label.gender') }}</span>
                        <p class="mb-0">
                            {{ $seekerDetail->gender ? config("constants.gender.$seekerDetail->gender") : '-' }}</p>
                    </div>

                    <div class="col-md-6 col-lg-3 mb-40">
                        <span>{{ trans('label.experience') }}</span>
                        <p class="mb-0">
                            {{ $seekerDetail->total_experience ? $seekerDetail->total_experience . ' Years Experience' : '-' }}
                        </p>
                    </div>

                    {{-- @if (!empty($seekerDetail->workTypes))
                        <div class="col-md-6 col-lg-3 mb-40">
                            <label for="">{{ trans('label.workType') }}</label>
                            <p class="mb-0"> {{$seekerDetail->workTypes ?? '-' }} </p>
                        </div>
                    @endif --}}

                    <div class="col-md-6 col-lg-3 mb-40">
                        <span>{{ trans('label.work_type') }}</span>
                        @if ($seekerDetail->workTypes->isEmpty())
                            <p>{{ $item->workType->title ?? '-' }}</p>
                        @else
                            @foreach ($seekerDetail->workTypes as $item)
                                <p>{{ $item->workType->title ?? '-' }}</p>
                            @endforeach
                        @endif
                    </div>


                    <div class="col-md-6 col-lg-3 mb-40">
                        <span>{{ trans('label.employer_address') }}</span>
                        <p class="mb-0">{{ $seekerDetail->address ?? '-' }}</p>
                    </div>
                    <div class="col-md-6 mb-40 pl-lg-0 col-lg-3">
                        <span>{{ trans('label.email_address') }}</span>
                        <p class="mb-0">{{ $user->email ?? null }}</p>
                    </div>
                    @if (!empty($seekerDetail->dob))
                        <div class="col-md-6 col-lg-3 mb-40">
                            <label for="">{{ trans('label.dob') }}</label>
                            <p class="mb-0">{{ \Carbon\Carbon::parse($seekerDetail->dob)->format('M d, Y') }}</p>
                        </div>
                    @endif
                    @if (!empty($seekerDetail->age))
                        <div class="col-md-6 col-lg-3 mb-40">
                            <label for="">{{ trans('label.age') }}</label>
                            <p class="mb-0">{{ $seekerDetail->age }}</p>
                        </div>
                    @endif
                    @if (!empty($seekerDetail->mobile_number))
                        <div class="col-md-6 col-lg-3 mb-40">
                            <label for="">{{ trans('label.mobile') }}</label>
                            <p class="mb-0">{{ $seekerDetail->mobile_number }}</p>
                        </div>
                    @endif
                    <div class="pl-lg-0 col-md-6 col-lg-3 mb-40">
                        <span>{{ trans('label.phone_number') }}</span>
                        <p class="mb-0">{{ $user->phone_number ?? '' }}</p>
                    </div>
                    {{-- @if (!empty($seekerDetail->language_known))
                        <div class="col-md-6 mb-40 pl-lg-0 col-lg-3">
                            <label for="">{{ trans('label.language_known') }}</label>
                            <p class="mb-0"> {{ $seekerDetail->language_known ?? '-' }} </p>
                        </div>
                    @endif --}}


                    @if (!empty($seekerDetail->my_core_competencies))
                        <div class="col-md-6 col-lg-3 mb-40">
                            <label for="">{{ trans('label.my_core_competencies') }}</label>
                            <p class="mb-0"> {!! $seekerDetail->my_core_competencies ?? '-' !!} </p>
                        </div>
                    @endif
                    @if (!empty($seekerDetail->current_salary))
                        <div class="col-md-6 col-lg-3 mb-40">
                            <label for="">{{ trans('label.current_salary') }}</label>
                            <p class="mb-0"> {!! $seekerDetail->current_salary ?? '-' !!} </p>
                        </div>
                    @endif
                    @if (!empty($seekerDetail->expected_salary))
                        <div class="col-md-6 mb-40 col-lg-3">
                            <label for="">{{ trans('label.expected_salary') }}</label>
                            <p class="mb-0"> {!! $seekerDetail->expected_salary ?? '-' !!} </p>
                        </div>
                    @endif
                    {{-- @dd($seekerDetail->currency) --}}
                    @if (!empty($seekerDetail->current_position))
                        <div class="pl-lg-0 col-md-6 col-lg-3 mb-40">
                            <label for="">{{ trans('label.current_position') }}</label>
                            <p class="mb-0">
                                {{ $seekerDetail->current_position ?? '-' }}
                            </p>
                        </div>
                    @endif
                    @if (!empty($seekerDetail->category))
                        <div class="col-md-6 col-lg-3 mb-40">
                            <label for="">{{ trans('label.category') }}</label>
                            <p class="mb-0">
                                {{ $seekerDetail->category->title ?? '-' }}
                            </p>
                        </div>
                    @endif
                    @if (!empty($seekerDetail->preferred_position))
                        <div class="col-md-6 col-lg-3 mb-40">
                            <label for="">{{ trans('label.preferred_position') }}</label>
                            <p class="mb-0">
                                {{ $seekerDetail->preferred_position ?? '-' }}
                            </p>
                        </div>
                    @endif
                    @if (!empty($seekerDetail->current_company))
                        <div class="col-md-6 col-lg-3 mb-40">
                            <label for="">{{ trans('label.current_company') }}</label>
                            <p class="mb-0">
                                {{ $seekerDetail->current_company ?? '-' }}
                            </p>
                        </div>
                    @endif

                    @if (!empty($seekerDetail->city_preference))
                        <div class="pl-lg-0 col-md-6 mb-40 col-lg-3">
                            <label for="">{{ trans('label.city_preference') }}</label>
                            <p class="mb-0">
                                {{ $seekerDetail->city_prefer }}
                            </p>
                        </div>
                    @endif

                    @if (!empty($seekerDetail->place_of_birth))
                        <div class="col-md-6 col-lg-3 mb-40">
                            <label for="">{{ trans('label.place_of_birth') }}</label>
                            <p class="mb-0"> {{ $seekerDetail->place_of_birth ?? '-' }} </p>
                        </div>
                    @endif
                    @if (!empty($seekerDetail->marital_status))
                        <div class="col-md-6 col-lg-3 mb-40">
                            <label for="">{{ trans('Marital Status') }}</label>

                            <p class="mb-0">
                                {{ $seekerDetail->marital_status ? config("constants.marital_status.$seekerDetail->marital_status") : '-' }}
                            </p>
                        </div>
                    @endif
                    @if (!empty($seekerDetail->permanent_address))
                        <div class="col-md-6 col-lg-3 mb-40">
                            <label for="">{{ trans('label.permanent_address') }}</label>
                            <p class="mb-0"> {{ $seekerDetail->permanent_address ?? '-' }} </p>
                        </div>
                    @endif
                    {{-- @dd($seekerDetail->nationality) --}}
                    @if (!empty($seekerDetail->nationality))
                        <div class="pl-lg-0  col-md-6 mb-40  col-lg-3">
                            <label for="">{{ trans('label.nationality') }}</label>
                            {{-- <p class="mb-0">
                        {{ $seekerDetail->nationality ? config("constants.nationality_choices.$seekerDetail->nationality") : '-' }}

                        </p> --}}
                            <p class="mb-0">
                                @if ($seekerDetail->nationality == 1)
                                    Indian
                                @else
                                    Others
                                @endif
                            </p>
                        </div>
                    @endif
                    @if (!empty($seekerDetail->facebook_url))
                    <div class="col-md-6 col-lg-3 mb-40">
                        <label for="">{{ trans('label.facebook_url') }}</label>
                        <p class="mb-0">
                            <a href="{{ $seekerDetail->facebook_url }}" target="_blank">
                                {{ $seekerDetail->facebook_url }}
                            </a>
                        </p>
                    </div>
                @endif
                @if (!empty($seekerDetail->instagram_url))
                <div class="col-md-6 col-lg-3 mb-40">
                    <label for="">{{ trans('label.instagram_url') }}</label>
                    <p class="mb-0">
                        <a href="{{ $seekerDetail->instagram_url }}" target="_blank">
                            {{ $seekerDetail->instagram_url }}
                        </a>
                    </p>
                </div>
            @endif
            @if (!empty($seekerDetail->blog_url))
                <div class="col-md-6 col-lg-3 mb-40">
                    <label for="">{{ trans('label.blog_url') }}</label>
                    <p class="mb-0">
                        <a href="{{ $seekerDetail->blog_url }}" target="_blank">
                            {{ $seekerDetail->blog_url }}
                        </a>
                    </p>
                </div>
            @endif
            @if (!empty($seekerDetail->linkedin_url))
                <div class="col-md-6 col-lg-3 mb-40">
                    <label for="">{{ trans('label.linkedin_url') }}</label>
                    <p class="mb-0">
                        <a href="{{ $seekerDetail->linkedin_url }}" target="_blank">
                            {{ $seekerDetail->linkedin_url }}
                        </a>
                    </p>
                </div>
            @endif
            {{-- @dd($seekerDetail->is_fresher) --}}
            {{-- @if (!empty($seekerDetail->is_fresher)) --}}
                <div class="col-md-6 col-lg-3 mb-40">
                    <label for="">{{ trans('label.is_fresher') }}</label>
                    <p class="mb-0">
                        @if ($seekerDetail->is_fresher == 1)
                            Yes
                        @else
                            No
                        @endif
                    </p>
                </div>
            {{-- @endif --}}
            @if (!empty($seekerDetail->training_name))
            <div class="col-md-6 col-lg-3 mb-40">
                <label for="">{{ trans('label.training_name') }}</label>
                <p class="mb-0"> {{ $seekerDetail->training_name ?? '-' }} </p>
            </div>
        @endif
        @if (!empty($seekerDetail->attended_at_company))
            <div class="col-md-6 col-lg-3 mb-40">
                <label for="">{{ trans('label.attended_at_company') }}</label>
                <p class="mb-0"> {{ $seekerDetail->attended_at_company ?? '-' }} </p>
            </div>
        @endif
        {{-- @dd($seekerDetail->year) --}}
        @if (!empty($seekerDetail->year))
            <div class="pl-lg-0  col-md-6 col-lg-3 mb-40">
                <label for="">{{ trans('label.year') }}</label>
                <p class="mb-0"> {{ $seekerDetail->year ?? '-' }} </p>
            </div>
        @endif
                    @if (!empty($seekerDetail->Religion))
                        <div class="col-md-6 col-lg-3 mb-40">
                            <label for="">{{ trans('label.Religion') }}</label>
                            <p class="mb-0"> {{ $seekerDetail->Religion ?? '-' }} </p>
                        </div>
                    @endif
                    @if (!empty($seekerDetail->currently_staying_in))
                        <div class="col-md-6 col-lg-3 mb-40">
                            <label for="">{{ trans('label.currently_staying_in') }}</label>
                            <p class="mb-0"> {{ $seekerDetail->currently_staying_in ?? '-' }} </p>
                        </div>
                    @endif
                    @if (!is_null($seekerDetail->Relocation))
                        <div class="col-md-6 mb-40 col-lg-3">
                            <label for="">{{ trans('label.Relocation') }}</label>
                            <p class="mb-0">
                                @if ($seekerDetail->Relocation == 1)
                                    Yes
                                @else
                                    No
                                @endif
                            </p>
                        </div>
                    @endif
                    @if (!is_null($seekerDetail->visa_status))
                        <div class="pl-lg-0 col-md-6 col-lg-3 mb-40">
                            <label for="">{{ trans('Visa Status') }}</label>
                            <p class="mb-0">
                                @if ($seekerDetail->visa_status == 1)
                                    N/A
                                @else
                                    Active
                                @endif
                            </p>
                        </div>
                    @endif
                    @if (!is_null($seekerDetail->is_public_profile))
                        <div class="col-md-6 col-lg-3 mb-40">
                            <label for="">{{ trans('label.profile_visibility') }}</label>
                            <p class="mb-0">
                                @if ($seekerDetail->is_public_profile == 1)
                                    Public
                                @else
                                    Private
                                @endif
                            </p>
                        </div>
                    @endif
                    {{-- @if (!empty($seekerDetail->visa_status))
                        <div class="col-md-6 col-lg-3 mb-40">
                            <label for="">{{ trans('Visa Status') }}</label>

                            <p class="mb-0">
                                {{ $seekerDetail->visa_status ? config("constants.visa_status.$seekerDetail->visa_status") : '-' }}
                            </p>
                        </div>
                    @endif --}}
                    {{-- <div class="col-md-6 col-lg-3 mb-4">
                    <span>Specialization</span>
                    <p class="mb-0">{{$seekerDetail->specialization->name ?? '-'}}</p>
                </div> --}}
                    {{-- <div class="col-md-6 col-lg-3 mb-4">
                    <span>Website</span>
                    <p class="mb-0">{{$seekerDetail->website ?? ''}}</p>
                </div> --}}
                </div>

                <div class="profile_box mb-40 border-bottom pb-20">
                    <div class="d-flex align-items-center justify-content-between mb-30">
                        <h3 class="mb-0">{{ trans('label.education') }}<b style="color: red; font-weight: 400">*</b>
                        </h3>
                        {{-- <a href="{{ route('users.edit.profile', ['mainTitle' => 'education']) }}" class="edit_btn_link">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18"
                                fill="none">
                                <path
                                    d="M13.076 7.71779L10.2822 4.92398M2.25 15.75L4.61382 15.4874C4.90262 15.4553 5.04702 15.4392 5.18199 15.3955C5.30174 15.3568 5.4157 15.302 5.52077 15.2327C5.63921 15.1546 5.74194 15.0519 5.94742 14.8464L15.1714 5.62243C15.9429 4.85094 15.9429 3.60011 15.1714 2.82862C14.3999 2.05713 13.1491 2.05713 12.3776 2.82862L3.15361 12.0526C2.94814 12.2581 2.8454 12.3608 2.7673 12.4792C2.69801 12.5843 2.64324 12.6983 2.60447 12.818C2.56078 12.953 2.54474 13.0974 2.51265 13.3862L2.25 15.75Z"
                                    stroke="#ff7d57" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>{{ trans('label.edit') }}
                        </a> --}}
                    </div>
                    <ul class="profile_list_item m-0 pl-20 mb-10">
                        @foreach ($listEducation as $item)
                            <li>
                                <div class="d-flex justify-content-between">
                                    <h3 class="company_name">{{ $item->qualification->title ?? '' }}</h3>
                                    <a href="{{ route('users.profile.destroy.list', ['id' => $item->id ?? '', 'type' => 'education']) }}"
                                        class="text-danger edit_btn_link">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="20"
                                            viewBox="0 0 18 20" fill="none" class="mr-2">
                                            <path
                                                d="M12.5556 4.6V3.88C12.5556 2.87191 12.5556 2.36786 12.3618 1.98282C12.1913 1.64413 11.9194 1.36876 11.5849 1.19619C11.2046 1 10.7068 1 9.71111 1H8.28889C7.29324 1 6.79542 1 6.41513 1.19619C6.08062 1.36876 5.80865 1.64413 5.63821 1.98282C5.44444 2.36786 5.44444 2.87191 5.44444 3.88V4.6M7.22222 9.55V14.05M10.7778 9.55V14.05M1 4.6H17M15.2222 4.6V14.68C15.2222 16.1921 15.2222 16.9482 14.9316 17.5258C14.6759 18.0338 14.268 18.4469 13.7662 18.7057C13.1958 19 12.449 19 10.9556 19H7.04445C5.55097 19 4.80423 19 4.2338 18.7057C3.73204 18.4469 3.32409 18.0338 3.06843 17.5258C2.77778 16.9482 2.77778 16.1921 2.77778 14.68V4.6"
                                                stroke="#ff7d57" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round"></path>
                                        </svg>{{ trans('label.delete') }}
                                    </a>
                                </div>
                                <p class="role">{{ $item->university ?? '' }} • {{ $item->location ?? '' }}</p>
                                <p class="duration specialization">{{ trans('label.specialization') }} :
                                    {{ $item->specialization->name ?? '' }} </p>
                                <p class="duration percentile_cgpa">{{ trans('label.percentile_cgpa') }} :
                                    {{ $item->percentile_cgpa ?? '' }}
                                </p>
                                <p class="duration">{{ trans('label.durations_from') }} :
                                    {{ date('M', mktime(0, 0, 0, $item->education_from_month, 1)) }}
                                    / {{ $item->education_duration_from ?? '' }}</p>
                                <p class="duration">{{ trans('label.durations_to') }} :
                                    {{ date('M', mktime(0, 0, 0, $item->education_to_month, 1)) }} /
                                    {{ $item->education_duration_to ?? '' }}</p>
                                {{-- <p class="duration">{{ $item->duration_from ?? '' }} - {{ $item->duration_to ?? '' }}</p> --}}
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="profile_box mb-40 border-bottom pb-20">
                    <div class="d-flex align-items-center justify-content-between mb-30">
                        <h3 class="mb-0">{{ trans('label.skills') }}<b style="color: red; font-weight: 400">*</b></h3>
                        {{-- <a href="{{ route('users.edit.profile', ['mainTitle' => 'skill']) }}" class="edit_btn_link">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18"
                                fill="none">
                                <path
                                    d="M13.076 7.71779L10.2822 4.92398M2.25 15.75L4.61382 15.4874C4.90262 15.4553 5.04702 15.4392 5.18199 15.3955C5.30174 15.3568 5.4157 15.302 5.52077 15.2327C5.63921 15.1546 5.74194 15.0519 5.94742 14.8464L15.1714 5.62243C15.9429 4.85094 15.9429 3.60011 15.1714 2.82862C14.3999 2.05713 13.1491 2.05713 12.3776 2.82862L3.15361 12.0526C2.94814 12.2581 2.8454 12.3608 2.7673 12.4792C2.69801 12.5843 2.64324 12.6983 2.60447 12.818C2.56078 12.953 2.54474 13.0974 2.51265 13.3862L2.25 15.75Z"
                                    stroke="#ff7d57" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>{{ trans('label.edit') }}
                        </a> --}}
                    </div>
                    <ul class="profile_list_item inline_btn_style m-0 p-0 mb-10">
                        @foreach ($listSkill as $item)
                            <li>
                                <p class="company_name">{{ $item->skill->title ?? '' }}</p>
                                {{-- <a class="text-danger ml-4"
                                href="{{route('users.profile.destroy.list',['id' => $item->id??'','type' => 'skill'])}}"><i
                                    class="fi flaticon-trash" aria-hidden="true"></i> </a> --}}
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="profile_box mb-40 border-bottom pb-20">
                    <div class="d-flex align-items-center justify-content-between mb-30">
                        <h3 class="mb-0">{{ trans('label.experience') }}</h3>
                        {{-- <a href="{{ route('users.edit.profile', ['mainTitle' => 'experience']) }}" class="edit_btn_link">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18"
                                fill="none">
                                <path
                                    d="M13.076 7.71779L10.2822 4.92398M2.25 15.75L4.61382 15.4874C4.90262 15.4553 5.04702 15.4392 5.18199 15.3955C5.30174 15.3568 5.4157 15.302 5.52077 15.2327C5.63921 15.1546 5.74194 15.0519 5.94742 14.8464L15.1714 5.62243C15.9429 4.85094 15.9429 3.60011 15.1714 2.82862C14.3999 2.05713 13.1491 2.05713 12.3776 2.82862L3.15361 12.0526C2.94814 12.2581 2.8454 12.3608 2.7673 12.4792C2.69801 12.5843 2.64324 12.6983 2.60447 12.818C2.56078 12.953 2.54474 13.0974 2.51265 13.3862L2.25 15.75Z"
                                    stroke="#ff7d57" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>{{ trans('label.edit') }}</a> --}}
                    </div>
                    <ul class="profile_list_item m-0 pl-20 mb-10">
                        @foreach ($listExperience as $item)
                            <li>
                                <div class="d-flex justify-content-between">
                                    <h3 class="company_name">{{ $item->company ?? '' }}</h3>
                                    <a href="{{ route('users.profile.destroy.list', ['id' => $item->id ?? 0, 'type' => 'experience']) }}"
                                        class="text-danger edit_btn_link">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="18"
                                            viewBox="0 0 18 20" fill="none">
                                            <path
                                                d="M12.5556 4.6V3.88C12.5556 2.87191 12.5556 2.36786 12.3618 1.98282C12.1913 1.64413 11.9194 1.36876 11.5849 1.19619C11.2046 1 10.7068 1 9.71111 1H8.28889C7.29324 1 6.79542 1 6.41513 1.19619C6.08062 1.36876 5.80865 1.64413 5.63821 1.98282C5.44444 2.36786 5.44444 2.87191 5.44444 3.88V4.6M7.22222 9.55V14.05M10.7778 9.55V14.05M1 4.6H17M15.2222 4.6V14.68C15.2222 16.1921 15.2222 16.9482 14.9316 17.5258C14.6759 18.0338 14.268 18.4469 13.7662 18.7057C13.1958 19 12.449 19 10.9556 19H7.04445C5.55097 19 4.80423 19 4.2338 18.7057C3.73204 18.4469 3.32409 18.0338 3.06843 17.5258C2.77778 16.9482 2.77778 16.1921 2.77778 14.68V4.6"
                                                stroke="#ff7d57" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round"></path>
                                        </svg>{{ trans('label.delete') }}
                                    </a>
                                </div>
                                <p class="role">{{ $item->role ?? '' }} • {{ $item->location ?? '' }}</p>
                                <p class="duration">{{ trans('label.durations_from') }} :
                                    {{ date('M', mktime(0, 0, 0, $item->from_month, 1)) }} / {{ $item->duration_from ?? '' }}</p>
                                    @if ($item->currently_working == 1)
                                        <p class="duration">{{ trans('label.durations_to') }} : {{ trans('label.present') }}</p>
                                    @else
                                        <p class="duration">{{ trans('label.durations_to') }} : {{ date('M', mktime(0, 0, 0, $item->to_month, 1)) }} / {{ $item->duration_to ?? '' }}</p>
                                    @endif

                                <p class="duration reference_name">{{ trans('label.reference_name') }} :
                                    {!! $item->reference_name ?? '' !!}</p>
                                <p class="duration reference_phone_number">{{ trans('label.reference_phone_number') }} :
                                    {!! $item->reference_phone_number ?? '' !!}
                                </p>
                                <p class="duration reference_position">{{ trans('label.reference_position') }} :
                                    {!! $item->reference_position ?? '' !!}</p>
                                <p class="duration years_known">{{ trans('label.years_known') }} :
                                    {!! $item->years_known == 0 || $item->years_known == 1
                                        ? $item->years_known . ' year'
                                        : $item->years_known . ' years' !!}
                                </p>

                                {{-- <p class="duration">{{ $item->duration_from ?? '' }} - {{ $item->duration_to ?? '' }}</p> --}}
                                <p class="description">{!! $item->description ?? '' !!}</p>

                            </li>
                        @endforeach
                    </ul>
                </div>


                <div class="profile_box mb-40 border-bottom pb-20">
                    <div class="d-flex align-items-center justify-content-between mb-30">
                        <h3 class="mb-0">{{ trans('label.trainin_certificate') }}</h3>
                        {{-- <a href="{{ route('users.edit.profile', ['mainTitle' => 'licenses']) }}" class="edit_btn_link">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18"
                                fill="none">
                                <path
                                    d="M13.076 7.71779L10.2822 4.92398M2.25 15.75L4.61382 15.4874C4.90262 15.4553 5.04702 15.4392 5.18199 15.3955C5.30174 15.3568 5.4157 15.302 5.52077 15.2327C5.63921 15.1546 5.74194 15.0519 5.94742 14.8464L15.1714 5.62243C15.9429 4.85094 15.9429 3.60011 15.1714 2.82862C14.3999 2.05713 13.1491 2.05713 12.3776 2.82862L3.15361 12.0526C2.94814 12.2581 2.8454 12.3608 2.7673 12.4792C2.69801 12.5843 2.64324 12.6983 2.60447 12.818C2.56078 12.953 2.54474 13.0974 2.51265 13.3862L2.25 15.75Z"
                                    stroke="#ff7d57" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>{{ trans('label.edit') }}</a> --}}
                    </div>
                    <ul class="profile_list_item m-0 pl-20 mb-10">
                        @foreach ($listLicense as $item)
                            <li>
                                <div class="d-flex justify-content-between">
                                    <h3 class="company_name">{{ $item->certificate_name ?? '' }}</h3>
                                    <a href="{{ route('users.profile.destroy.list', ['id' => $item->id ?? 0, 'type' => 'license']) }}"
                                        class="text-danger edit_btn_link">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="18"
                                            viewBox="0 0 18 20" fill="none">
                                            <path
                                                d="M12.5556 4.6V3.88C12.5556 2.87191 12.5556 2.36786 12.3618 1.98282C12.1913 1.64413 11.9194 1.36876 11.5849 1.19619C11.2046 1 10.7068 1 9.71111 1H8.28889C7.29324 1 6.79542 1 6.41513 1.19619C6.08062 1.36876 5.80865 1.64413 5.63821 1.98282C5.44444 2.36786 5.44444 2.87191 5.44444 3.88V4.6M7.22222 9.55V14.05M10.7778 9.55V14.05M1 4.6H17M15.2222 4.6V14.68C15.2222 16.1921 15.2222 16.9482 14.9316 17.5258C14.6759 18.0338 14.268 18.4469 13.7662 18.7057C13.1958 19 12.449 19 10.9556 19H7.04445C5.55097 19 4.80423 19 4.2338 18.7057C3.73204 18.4469 3.32409 18.0338 3.06843 17.5258C2.77778 16.9482 2.77778 16.1921 2.77778 14.68V4.6"
                                                stroke="#ff7d57" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round"></path>
                                        </svg>{{ trans('label.delete') }}
                                    </a>
                                </div>
                                <p class="certifying_authority mb-2 role">{{ $item->certifying_authority ?? '' }}</p>
                                <p class="duration">{{ trans('label.month_year_valid_expired') }} :
                                    {{ date('M', mktime(0, 0, 0, $item->from_month, 1)) }} /
                                    {{ $item->from_year ?? '' }}
                                </p>
                                {{-- <p class="duration">Year Duration {{ $item->from_year ?? '' }} - {{ $item->to_year ?? '' }}</p> --}}

                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="profile_box mb-40 border-bottom pb-20">
                    <div class="d-flex align-items-center justify-content-between mb-30">
                        <h3 class="mb-0">{{ trans('label.language_skill') }}</h3>
                        {{-- <a href="{{ route('users.edit.profile', ['mainTitle' => 'language_skill']) }}"
                            class="edit_btn_link">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18"
                                fill="none">
                                <path
                                    d="M13.076 7.71779L10.2822 4.92398M2.25 15.75L4.61382 15.4874C4.90262 15.4553 5.04702 15.4392 5.18199 15.3955C5.30174 15.3568 5.4157 15.302 5.52077 15.2327C5.63921 15.1546 5.74194 15.0519 5.94742 14.8464L15.1714 5.62243C15.9429 4.85094 15.9429 3.60011 15.1714 2.82862C14.3999 2.05713 13.1491 2.05713 12.3776 2.82862L3.15361 12.0526C2.94814 12.2581 2.8454 12.3608 2.7673 12.4792C2.69801 12.5843 2.64324 12.6983 2.60447 12.818C2.56078 12.953 2.54474 13.0974 2.51265 13.3862L2.25 15.75Z"
                                    stroke="#ff7d57" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>{{ trans('label.edit') }}</a> --}}
                    </div>
                    <ul class="profile_list_item m-0 pl-20 mb-10">
                        @foreach ($listLanguageSkill as $item)
                            <li>
                                <div class="d-flex justify-content-between">
                                    <h3 class="language_id">{{ $item->language->title ?? '' }}</h3>
                                    <a href="{{ route('users.profile.destroy.list', ['id' => $item->id ?? 0, 'type' => 'language_skill']) }}"
                                        class="text-danger edit_btn_link">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="18"
                                            viewBox="0 0 18 20" fill="none">
                                            <path
                                                d="M12.5556 4.6V3.88C12.5556 2.87191 12.5556 2.36786 12.3618 1.98282C12.1913 1.64413 11.9194 1.36876 11.5849 1.19619C11.2046 1 10.7068 1 9.71111 1H8.28889C7.29324 1 6.79542 1 6.41513 1.19619C6.08062 1.36876 5.80865 1.64413 5.63821 1.98282C5.44444 2.36786 5.44444 2.87191 5.44444 3.88V4.6M7.22222 9.55V14.05M10.7778 9.55V14.05M1 4.6H17M15.2222 4.6V14.68C15.2222 16.1921 15.2222 16.9482 14.9316 17.5258C14.6759 18.0338 14.268 18.4469 13.7662 18.7057C13.1958 19 12.449 19 10.9556 19H7.04445C5.55097 19 4.80423 19 4.2338 18.7057C3.73204 18.4469 3.32409 18.0338 3.06843 17.5258C2.77778 16.9482 2.77778 16.1921 2.77778 14.68V4.6"
                                                stroke="#ff7d57" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round"></path>
                                        </svg>{{ trans('label.delete') }}
                                    </a>
                                </div>
                                <p class="certifying_authority mb-2">{{ trans('label.speak') }} : {{ $item->speak->title ?? '' }}</p>
                                <p class="certifying_authority mb-2">{{ trans('label.read') }} : {{ $item->read_write->title ?? '' }}</p>

                            </li>
                        @endforeach
                    </ul>
                </div>

                {{-- <div class="profile_box mb-40 border-bottom pb-20">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h3 class="mb-0">{{ trans('label.trainin_certificate') }}</h3>
                        <a href="{{ route('users.edit.profile', ['mainTitle' => 'licenses']) }}" class="edit_btn_link">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18"
                                fill="none">
                                <path
                                    d="M13.076 7.71779L10.2822 4.92398M2.25 15.75L4.61382 15.4874C4.90262 15.4553 5.04702 15.4392 5.18199 15.3955C5.30174 15.3568 5.4157 15.302 5.52077 15.2327C5.63921 15.1546 5.74194 15.0519 5.94742 14.8464L15.1714 5.62243C15.9429 4.85094 15.9429 3.60011 15.1714 2.82862C14.3999 2.05713 13.1491 2.05713 12.3776 2.82862L3.15361 12.0526C2.94814 12.2581 2.8454 12.3608 2.7673 12.4792C2.69801 12.5843 2.64324 12.6983 2.60447 12.818C2.56078 12.953 2.54474 13.0974 2.51265 13.3862L2.25 15.75Z"
                                    stroke="#ff7d57" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>{{ trans('label.edit') }}
                        </a>
                    </div>
                    <ul class="profile_list_item inline_btn_style m-0 p-0 mb-10">
                        @foreach ($listLicense as $item)
                            <li class="">
                                <p class="company_name">{{ $item->license->title ?? '' }}</p>
                                {{-- <a class="text-danger ml-4"
                            href="{{route('users.profile.destroy.list',['id' => $item->id??'','type' => 'license'])}}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="20" viewBox="0 0 18 20" fill="none" class="mr-2">
                                <path d="M12.5556 4.6V3.88C12.5556 2.87191 12.5556 2.36786 12.3618 1.98282C12.1913 1.64413 11.9194 1.36876 11.5849 1.19619C11.2046 1 10.7068 1 9.71111 1H8.28889C7.29324 1 6.79542 1 6.41513 1.19619C6.08062 1.36876 5.80865 1.64413 5.63821 1.98282C5.44444 2.36786 5.44444 2.87191 5.44444 3.88V4.6M7.22222 9.55V14.05M10.7778 9.55V14.05M1 4.6H17M15.2222 4.6V14.68C15.2222 16.1921 15.2222 16.9482 14.9316 17.5258C14.6759 18.0338 14.268 18.4469 13.7662 18.7057C13.1958 19 12.449 19 10.9556 19H7.04445C5.55097 19 4.80423 19 4.2338 18.7057C3.73204 18.4469 3.32409 18.0338 3.06843 17.5258C2.77778 16.9482 2.77778 16.1921 2.77778 14.68V4.6" stroke="#F00404" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </a> --}
                            </li>
                        @endforeach
                    </ul>
                </div> --}}



                {{-- <div class="profile_box mb-40 border-bottom pb-40">
                <div class="d-flex align-items-center justify-content-between mb-30">
                    <h3 class="mb-0">{{ trans('label.personal_details') }}</h3>
                    <a href="{{route('users.edit.profile', ['mainTitle' => 'personal'])}}"
                        class="edit_btn_link">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                            <path d="M13.076 7.71779L10.2822 4.92398M2.25 15.75L4.61382 15.4874C4.90262 15.4553 5.04702 15.4392 5.18199 15.3955C5.30174 15.3568 5.4157 15.302 5.52077 15.2327C5.63921 15.1546 5.74194 15.0519 5.94742 14.8464L15.1714 5.62243C15.9429 4.85094 15.9429 3.60011 15.1714 2.82862C14.3999 2.05713 13.1491 2.05713 12.3776 2.82862L3.15361 12.0526C2.94814 12.2581 2.8454 12.3608 2.7673 12.4792C2.69801 12.5843 2.64324 12.6983 2.60447 12.818C2.56078 12.953 2.54474 13.0974 2.51265 13.3862L2.25 15.75Z" stroke="#ff7d57" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>{{ trans('label.edit') }}
                    </a>
                </div>
                <div class="row">
                    @if (!empty($seekerDetail->parent_name))
                    <div class="col-md-6 col-lg-3 mb-40">
                        <span>{{trans('label.parent_name')}}</span>
                        <p class="mb-0">{{$seekerDetail->parent_name ?? null}}</p>
                    </div>
                    @endif
                    @if (!empty($seekerDetail->permanent_address))
                    <div class="col-md-6 col-lg-3 mb-40">
                        <span>{{trans('label.permanent_address')}}</span>
                        <p class="mb-0">{{$seekerDetail->permanent_address ?? null}}</p>
                    </div>
                    @endif
                    @if (!empty($seekerDetail->dob))
                    <div class="col-md-6 col-lg-3 mb-40">
                        <span>{{trans('label.dob')}}</span>
                        <p class="mb-0">
                            {{isset($seekerDetail->dob) ? FunctionHelper::fromSqlDate($seekerDetail->dob->toDateString(), true, 'd M, Y') : null}}
                        </p>
                    </div>
                    @endif
                    @if (!empty($seekerDetail->language_known))
                    <div class="col-md-6 col-lg-3 mb-40">
                        <span>{{trans('label.language_known')}}</span>
                        <p class="mb-0">{{$seekerDetail->language_known ?? null}}</p>
                    </div>
                    @endif
                    @if ($seekerDetail->nationality === 0 || $seekerDetail->nationality === 1)
                    <div class="col-md-6 col-lg-3 mb-40">
                        <span>{{trans('label.nationality')}}</span>
                        <p class="mb-0">
                            {{config('constants.nationality_choices.data.'.$seekerDetail->nationality) ?? null}}
                        </p>
                    </div>
                    @endif
                </div>
            </div> --}}
                @if (config('constants.enable_cover_video', false) == true)
                    <div class="profile_box mb-40 pb-40 location_box ">
                        <div class="d-flex align-items-center justify-content-between mb-30">
                            <h3 class="mb-0">{{ trans('label.cover_video') }}</h3>
                            <div class="d-flex">
                                <a href="{{ route('users.edit.profile', ['mainTitle' => 'video']) }}"
                                    class="edit_btn_link">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                        viewBox="0 0 18 18" fill="none">
                                        <path
                                            d="M13.076 7.71779L10.2822 4.92398M2.25 15.75L4.61382 15.4874C4.90262 15.4553 5.04702 15.4392 5.18199 15.3955C5.30174 15.3568 5.4157 15.302 5.52077 15.2327C5.63921 15.1546 5.74194 15.0519 5.94742 14.8464L15.1714 5.62243C15.9429 4.85094 15.9429 3.60011 15.1714 2.82862C14.3999 2.05713 13.1491 2.05713 12.3776 2.82862L3.15361 12.0526C2.94814 12.2581 2.8454 12.3608 2.7673 12.4792C2.69801 12.5843 2.64324 12.6983 2.60447 12.818C2.56078 12.953 2.54474 13.0974 2.51265 13.3862L2.25 15.75Z"
                                            stroke="#ff7d57" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>{{ trans('label.edit') }}
                                </a>
                                <a href="#" class="p-2 btn-link">{{ trans('label.premium') }}</a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                @if ($user->video)
                                    @include('components.video', ['video' => $user->video])
                                @endif
                            </div>
                        </div>
                    </div>
                @endif



                <div class="profile_footer mt-40 mb-50">
                    @include('components.front-profile-footer')
                </div>
            </div>


        </div>


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

            // location.reload();
        });
    </script>

@endsection
