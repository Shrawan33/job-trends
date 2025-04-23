<div class="col-12  {{ $class ?? 'col-md-4' }}">

    <div
        class="list_card position-relative d-flex align-items-md-center justify-content-between flex-wrap flex-md-row flex-column">
        <div class="d-flex flex-wrap flex-md-row flex-column align-items-start align-items-md-center">
            <div class="user-profile-img mb-md-0 mb-3">
                @if (!empty($employer->usersProfile) && $employer->usersProfile->logo->count())
                    @include('vendor.image_upload.display', [
                        'document_type' => config('constants.document_type.image', 0),
                        'imageModel' => $employer->usersProfile,
                        'class_li' => 'mb-2',
                    ])
                @else
                    @include('vendor.image_upload.no_user', ['class_li' => 'mb-2'])
                @endif
                {{-- @if (isset($prefix) && $prefix != 'account.' && $prefix != 'mentor.')
                    <div class="check-input text-center ml-3">
                        {!! Form::checkbox('checked', $candidate->id, null,['class' => 'candidate-checkbox', 'label' => null])
                        !!}
                    </div>
                    @endif --}}
            </div>

            <div class="user-profile-info pl-md-3 mb-md-0 mb-4">
                <div class="user-basic-info flex-fill">
                    <a href="{{ route($prefix . 'job-detail.employer.show', $employer->slug) }}" class="name">
                        {{ $employer->company_name ?? '' }}
                    </a>
                    {{-- @if (!empty($candidate->seekerDetail))
                        @if (!empty($candidate->seekerDetail->title))
                        <p class="mb-3 title">{{$candidate->seekerDetail->title??''}}</p>
                        @endif
                        @endif --}}
                    {{-- @if (!empty($candidate->seekerDetail))
                        @if (!empty($candidate->seekerDetail->gender))
                        <p class="mb-1 d-flex">
                            <span class="flex-shrink-0 font-weight-medium label-text">{{trans('label.gender')}}</span>
                            <span
                                class="flex-fill ml-4">{{config('constants.gender.'.$candidate->seekerDetail->gender)??''}}</span>
                        </p>
                        @endif
                        @endif --}}






                    {{-- @if (!empty($candidate->seekerExperience) && $candidate->seekerExperience->count() > 0)
                        <p class="mb-1 d-flex"><span
                                class="flex-shrink-0 font-weight-medium label-text">{{trans('label.current_employer')}}</span>

                            <span class="flex-fill ml-4">
                                {{$candidate->currentEmployer($candidate->seekerExperience)??''}}</span>

                        </p>
                        @endif --}}



                    {{-- @if (!empty($candidate->seekerEducation) && $candidate->seekerEducation->count() > 0)
                        <p class="mb-1 d-flex"><span class="flex-shrink-0 font-weight-medium label-text">
                                {{trans('label.education')}}</span>
                            <span class="flex-fill ml-4"> @foreach ($candidate->seekerEducation as $seekereducation)
                                {{isset($seekereducation->education) ? $seekereducation->education: '' }}<br>
                                @endforeach</span>
                        </p>
                        @endif --}}

                    {{-- @if (!empty($candidate->seekerSkill) && $candidate->seekerSkill->count() > 0)
                        <p class="mb-1 d-flex"><span class="flex-shrink-0 font-weight-medium label-text">
                                {{trans('label.key_skill')}}</span>
                            <span class="flex-fill ml-4">
                                @foreach ($candidate->seekerSkill as $key => $seekerskill)
                                {{isset($seekerskill->skill->title) ? $seekerskill->skill->title: '' }}

                                @if ($key < $candidate->seekerSkill->count() - 1)
                                    {{','}}
                                    @endif

                                    @endforeach

                            </span>
                        </p>
                        @endif --}}

                    {{-- @if (!empty($candidate->seekerLicense) && $candidate->seekerLicense->count() > 0)
                        <p class="mb-1 d-flex"><span
                                class="flex-shrink-0 font-weight-medium label-text">{{trans('label.certifications')}}</span>
                            <span class="flex-fill ml-4">

                                @foreach ($candidate->seekerLicense as $key => $seekerlicense)
                                {{isset($seekerlicense->license->title) ? $seekerlicense->license->title: '' }}

                                @if ($key < $candidate->seekerLicense->count() - 1)
                                    {{','}}
                                    @endif

                                    @endforeach

                        </p>
                        @endif --}}

                    <div class="d-flex align-items-center">
                        @if (!empty($employer->usersProfile))
                            @if (!empty($employer->usersProfile->user_address))
                                <p class="location">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                        viewBox="0 0 18 18" fill="none" class="mr-1">
                                        <path
                                            d="M9 9.74939C10.2426 9.74939 11.25 8.74203 11.25 7.49939C11.25 6.25675 10.2426 5.24939 9 5.24939C7.75736 5.24939 6.75 6.25675 6.75 7.49939C6.75 8.74203 7.75736 9.74939 9 9.74939Z"
                                            stroke="#717884" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path
                                            d="M9 16.4994C12 13.4994 15 10.8131 15 7.49939C15 4.18568 12.3137 1.49939 9 1.49939C5.68629 1.49939 3 4.18568 3 7.49939C3 10.8131 6 13.4994 9 16.4994Z"
                                            stroke="#717884" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                    {{ $employer->usersProfile->user_address ?? '' }}
                                </p>
                            @endif
                        @endif
                    </div>
                    {{-- <br>
                        <div class="d-flex align-items-center">
                            @if (isset($employer->usersProfile->company_profile))
                                <p style="font-size:14px;">{{ FunctionHelper::truncateString($employer->usersProfile->company_profile ) ?? ''}} . . .</p>
                            @endif
                        </div> --}}
                </div>
            </div>
        </div>
        <div class="d-flex align-items-center">
            <a href="{{ route($prefix . 'job-detail.employer.show', $employer->slug) }}"
                class="btn btn-primary btn-sm ml-md-2">View Profile
                <svg xmlns="http://www.w3.org/2000/svg" width="8" height="14" viewBox="0 0 8 14" fill="none"
                    class="ml-3 mr-0">
                    <path d="M1.25 12.5L6.75 7L1.25 1.5" stroke="white" stroke-width="1.5" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
            </a>
        </div>
    </div>

</div>
