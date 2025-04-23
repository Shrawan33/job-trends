<style>
    li {
        cursor: pointer;
    }
</style>
{{-- @if (auth()->user()->isProfileComplete() !== true)
<div class="profile_alert_msg alert alert-danger">
    <p class="mb-0">{{ trans('message.incomplete_profile_js') }} <a href="{{ route('users.profile') }}">{{__('label.click_here')}}</a></p>
</div>
@endif --}}

<div class="container">
    <div class="row my-5">
        <div class="col-md-12 job_detail_wraper px-0 px-md-15">
            <div class="">
                <div class="row mx-0 align-items-center candidate-details-section p-20 p-lg-40 mb-20">
                    <div class="col-md-2 col-xl-1 col-3 p-0 info_box">
                        <div class="candidate-single-profile profile_box mb-40 d-flex">
                            @if (!empty($candidate->seekerDetail) && $candidate->seekerDetail->logo->count())
                                @include('vendor.image_upload.display', [
                                    'document_type' => config('constants.document_type.image', 0),
                                    'imageModel' => $candidate->seekerDetail,
                                    'class_li' => '',
                                    'thumbnail' => true,
                                ])
                            @else
                                @include('vendor.image_upload.no_user', ['class_li' => ''])
                            @endif
                        </div>
                    </div>
                    <div class="col-md-7 col-lg-5 pl-md-0 col-9">
                        <div>
                            <div class="candidate-single-dagignation ml-10">
                                <h2 class="mb-10">
                                    {{ $candidate->first_name . ' ' . $candidate->middle_name . ' ' . $candidate->last_name ?? null }}
                                    @if ($candidate->verified == 1)
                                        &nbsp;
                                    @endif
                                </h2>
                                @if (!empty($candidate->seekerDetail))
                                    <p class="posted_on mb-0">{{ $candidate->seekerDetail->title ?? '' }} </span></p>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div
                        class="col-xl-6 col-md-12 mt-3 mt-lg-0 d-flex flex-wrap justify-content-start justify-content-md-end pl-lg-0">

                        <div class="candidate-daunlode-cv mt-3 mt-lg-0 mr-40 mr-md-0">
                            <a href="{{ route('download-cv', $candidate->id) }}" class="btn btn-primary ml-auto btn-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                    viewBox="0 0 18 18" fill="none">
                                    <path
                                        d="M17.25 11.75V12.85C17.25 14.3901 17.25 15.1602 16.9503 15.7485C16.6866 16.2659 16.2659 16.6866 15.7485 16.9503C15.1602 17.25 14.3901 17.25 12.85 17.25H5.15C3.60986 17.25 2.83978 17.25 2.25153 16.9503C1.73408 16.6866 1.31338 16.2659 1.04973 15.7485C0.75 15.1602 0.75 14.3901 0.75 12.85V11.75M13.5833 7.16667L9 11.75M9 11.75L4.41667 7.16667M9 11.75V0.75"
                                        stroke="white" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                                {{ __('label.download_resume') }}
                            </a>
                        </div>

                        <div class="candidate-daunlode-cv mt-3 mt-lg-0">
                            @include('components.candidate_note_button', [
                                'entity' => 'candidate',
                                'entityData' => $candidate,
                                'id' => $candidate->id,
                            ])
                        </div>
                        @if (auth()->user() &&
                                (auth()->user()->hasRole('jobseeker') ||
                                    auth()->user()->hasRole('employer')))
                            @if (auth()->user()->id !== $candidate->id)
                                <div class="candidate-daunlode-cv mt-3 mt-lg-0 ml-20">
                                    @include('components.review_button', [
                                        'entity' => 'candidate',
                                        'entityData' => $candidate,
                                        'id' => $candidate->id,
                                    ])
                                </div>
                            @endif
                        @endif

                        @if (config('constants.enable_cover_video', false) === true &&
                                ($candidate->display_cover_video ?? false) == true &&
                                !empty($candidate->video))
                            <div class="candidate-cover-video ml-lg-3 mt-3 mt-lg-0">
                                <a href="javascript:void(0)"
                                    onclick="contentModal('{{ trans('label.cover_video_modal_title') }}', 'cover-video-{{ $candidate->id }}')"
                                    title="{!! __('label.cover_video_button_text') !!}"><i class="fa fa-video"></i>
                                    {{ __('label.cover_video_button_text') }} </a>
                                <div class="d-none" class="cover-video" id="cover-video-{{ $candidate->id }}">
                                    @include('components.video', [
                                        'video' => $candidate->video,
                                        'width' => '100%',
                                        'height' => '100%',
                                    ])
                                </div>
                            </div>
                        @endif
                        {{-- <div class="candidate-attachment">
									<a href="javascript:void(0)" onclick="contentModal('{{trans('label.download_attachments')}}', 'document-list-{{$candidate->id}}')"><i class="fa fa-download"></i> {{ trans('label.attachments')}}</a>
									<div class="d-none" class="cover-video" id="document-list-{{$candidate->id}}">
										@include('candidates.attachments', ['candidate' => $candidate, 'width' => '100%', 'height' => '100%'])
									</div>
							</div> --}}
                    </div>
                </div>
            </div>



            <div class="candidate-detailse-menu-section">
                <div class="menu-candidate-detailse-iner-description">
                    <ul class="candiddate-details-nav m-0 p-0 tabs_nav_wraper">
                        <li class="candidate-details-nav-li">
                            <a class="cd-nav-a-link tablink active" onclick="openPage('Career Profile')"
                                id="defaultOpen">{{ __('label.per_info') }}
                            </a>
                        </li>


                        <li class="candidate-details-nav-li">
                            <a class="cd-nav-a-link tablink" onclick="openPage('Attachments')">{{ __('label.attachments') }}</a>
                        </li>


                        <li class="candidate-details-nav-li">
                            <a class="cd-nav-a-link tablink" onclick="openPage('Reviews')" id="review_tab"
                                data-tab="review_tab">{{ __('label.reviews') }}</a>
                        </li>

                    </ul>
                </div>
            </div>
            <div class="candidate-detailse-containte-section">
                <div class="">
                    <div class="">
                        <div class="tabcontent" id="Career Profile">
                            {{-- <h3 class="can-d-h3 mb-0 mt-30">{{ __('label.about_me') }}</h3> --}}
                            <div class="candi-about-me-area py-10 mb-20">
                                <p class="label_value mb-0">{!! $candidate->seekerDetail->profile_summary ?? '' !!}</p>
                            </div>
                            @if (isset($candidate->seekerDetail->professional_manner))
                                <div class="candi-about-me-area py-10 mb-20">
                                    <div class="can-info-text-area">
                                        <span
                                            class="label_text">{{ __('label.professional_manner') }}</span>
                                        <p class="label_value mb-0">
                                            {!! $candidate->seekerDetail->professional_manner !!}
                                        </p>
                                    </div>
                                </div>
                            @endif
                            @if (isset($candidate->seekerDetail))
                                <div class="candidate-informatin-can-d-area border-bottom">
                                    <div class="can-information-box row">

                                        <div class="can-info-icone-text-box col-md-4 col-xl-2 mb-30">
                                            <div class="can-info-text-area">
                                                <span class="label_text">{{ __('Contact Number') }}</span>
                                                <p class="label_value mb-0">{{ $candidate->phone_number ?? '' }}</p>
                                            </div>
                                        </div>
                                        <div class="can-info-icone-text-box col-md-4 col-xl-2 mb-30 pl-lg-0">
                                            <div class="can-info-text-area">
                                                <span class="label_text">{{ __('Email Address') }}</span>
                                                <p class="label_value mb-0">{{ $candidate->email ?? '' }}</p>
                                            </div>
                                        </div>

                                        <?php $parent_user = auth()->user()->created_by; ?>

                                        @if (isset($candidate->seekerDetail->nationality))
                                            <div class="can-info-icone-text-box col-md-4 col-xl-2 mb-30">
                                                <div class="can-info-text-area">
                                                    <span class="label_text">{{ __('label.nationality') }}</span>
                                                    <p class="label_value mb-0">
                                                        {{ config('constants.nationality_choices.data.' . $candidate->seekerDetail->nationality) }}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="can-info-icone-text-box col-md-4 col-xl-2 mb-30">
                                                <div class="can-info-text-area">
                                                    <span class="label_text">{{ __('label.work_permit') }}</span>
                                                    <p class="label_value mb-0">
                                                        @if ($candidate->seekerDetail->nationality == 1)
                                                            No
                                                        @else
                                                            Yes
                                                        @endif
                                                    </p>
                                                </div>
                                            </div>
                                        @endif
                                        @if (isset($candidate->seekerDetail->dob))
                                            <div class="can-info-icone-text-box col-md-4 col-xl-2 mb-30">
                                                <div class="can-info-text-area">
                                                    <span class="label_text">{{ __('label.dob') }}</span>
                                                    <p class="label_value mb-0">
                                                        {{ \Carbon\Carbon::parse($candidate->seekerDetail->dob)->format('M d, Y') }}
                                                    </p>
                                                </div>
                                            </div>
                                        @endif


                                        @if (isset($candidate->seekerDetail->place_of_birth))
                                            <div class="can-info-icone-text-box col-md-4 col-xl-2 mb-30">
                                                <div class="can-info-text-area">
                                                    <span class="label_text">{{ __('label.place_of_birth') }}</span>
                                                    <p class="label_value mb-0">
                                                        {{ $candidate->seekerDetail->place_of_birth }}
                                                    </p>
                                                </div>
                                            </div>
                                        @endif
                                        @if (!empty($candidate->seekerDetail->marital_status))
                                            <div class="can-info-icone-text-box col-md-4 col-xl-2 mb-30">
                                                <label for="">{{ trans('Marital Status') }}</label>
                                                <p class="label_value mb-0">
                                                    {{ $candidate->seekerDetail->marital_status ? config('constants.marital_status.' . $candidate->seekerDetail->marital_status) : '-' }}
                                                </p>
                                            </div>
                                        @endif
                                        @if (isset($candidate->seekerDetail->Religion))
                                            <div class="can-info-icone-text-box col-md-4 col-xl-2 mb-30">
                                                <div class="can-info-text-area">
                                                    <span class="label_text">{{ __('label.Religion') }}</span>
                                                    <p class="label_value mb-0">
                                                        {{ $candidate->seekerDetail->Religion }}
                                                    </p>
                                                </div>
                                            </div>
                                        @endif
                                        @if (isset($candidate->seekerDetail->currently_staying_in))
                                            <div class="can-info-icone-text-box col-md-4 col-xl-2 mb-30 pl-lg-0">
                                                <div class="can-info-text-area">
                                                    <span
                                                        class="label_text">{{ __('label.currently_staying_in') }}</span>
                                                    <p class="label_value mb-0">
                                                        {{ $candidate->seekerDetail->currently_staying_in }}
                                                    </p>
                                                </div>
                                            </div>
                                        @endif
                                        @if (!is_null($candidate->seekerDetail->Relocation))
                                            <div class="can-info-icone-text-box col-md-4 col-xl-2 mb-30">
                                                <label for="">{{ trans('label.Relocation') }}</label>
                                                <p class="label_value mb-0">
                                                    @if ($candidate->seekerDetail->Relocation == 1)
                                                        Yes
                                                    @else
                                                        No
                                                    @endif
                                                </p>
                                            </div>
                                        @endif
                                        <div class="can-info-icone-text-box col-md-3 col-xl-2 mb-30 pl-lg-0">
                                            <div class="can-info-text-area">
                                                <span class="label_text">{{ __('label.experience') }}</span>
                                                <p class="label_value mb-0">
                                                    @if ($candidate->seekerDetail->total_experience == 0)
                                                        {{ __('0 year') }}
                                                    @elseif($candidate->seekerDetail->total_experience == 1)
                                                        {{ __('1 year') }}
                                                    @else
                                                        {{ $candidate->seekerDetail->total_experience }}
                                                        {{ __('years') }}
                                                    @endif
                                                </p>
                                            </div>

                                        </div>

                                        <div class="can-info-icone-text-box col-md-4 col-xl-2 mb-30 pl-lg-0">
                                            <div class="can-info-text-area">
                                                <span class="label_text">{{ __('label.qualification') }}</span>
                                                @foreach ($candidate->seekerDetail->seekerEducation as $education)
                                                    <p class="label_value mb-0">
                                                        {{ $education->qualification->title ?? '-' }}</p>
                                                @endforeach
                                            </div>
                                        </div>

                                        @if (isset($candidate->seekerDetail->preferred_position))
                                            <div class="can-info-icone-text-box col-md-4 col-xl-2 mb-30">
                                                <div class="can-info-text-area">
                                                    <span class="label_text">{{ __('label.preferred_position') }}</span>
                                                    <p class="label_value mb-0">
                                                        {{ $candidate->seekerDetail->preferred_position }}
                                                    </p>
                                                </div>
                                            </div>
                                        @endif
                                        {{-- <div class="can-info-icone-text-box col-md-4 col-xl-2 mb-30 pl-lg-0">
                                            <div class="can-info-text-area">
                                                <span class="label_text">{{ __('label.qualification') }}</span>
                                                @foreach ($candidate->seekerEducation as $education)
                                                    <p class="label_value mb-0">
                                                        {{ $education->qualification->title ?? '' }}</p>
                                                @endforeach
                                            </div>
                                        </div> --}}
                                    </div>
                                </div>
                            @endif

                            @if (isset($candidate->seekerDetail->seekerEducation) && $candidate->seekerDetail->seekerEducation->count() > 0)
                                <div class="candi-education-area py-30 border-bottom">
                                    <h3 class="can-d-h3">{{ __('label.education') }}</h3>
                                    @foreach ($candidate->seekerDetail->seekerEducation as $education)
                                        <div class="de-dont-containt awards">
                                            <ul>
                                                <li class="name">{{ $education->university ?? '' }}</li>
                                                <li class="role">{{ $education->qualification->title ?? '' }}</li>
                                                <li class="time">
                                                    {{ config('constants.months_range.duration_months.' . $education->duration_from_month) . ' ' ?? '' }}{{ $education->duration_from ?? '' }}
                                                    -
                                                    @if ($education->currently_working == 1)
                                                        {{ trans('label.present') }}
                                                    @else
                                                        {{ config('constants.months_range.duration_months.' . $education->duration_to_month) . ' ' ?? '' }}{{ $education->duration_to ?? '' }}
                                                    @endif
                                                </li>
                                            </ul>
                                        </div>
                                    @endforeach
                                </div>
                            @endif

                            @if (isset($candidate->seekerDetail->seekerExperience) && $candidate->seekerDetail->seekerExperience->count() > 0)
                                <div class="can-d-exprience-area py-30 border-bottom">
                                    <h3 class="can-d-h3">{{ __('label.experience') }}</h3>
                                    @foreach ($candidate->seekerDetail->seekerExperience as $experience)
                                        <div class="de-dont-containt awards">
                                            <ul>
                                                <li class="name">{{ $experience->company ?? '' }}</li>
                                                <li class="role">{{ $experience->role ?? '' }}</li>
                                                <li class="time">
                                                    {{ config('constants.months_range.duration_months.' . $experience->duration_from_month) . ' ' ?? '' }}{{ $experience->duration_from ?? '' }}
                                                    -
                                                    @if ($experience->currently_working == 1)
                                                        {{ trans('label.present') }}
                                                    @else
                                                        {{ config('constants.months_range.duration_months.' . $experience->duration_to_month) . ' ' ?? '' }}{{ $experience->duration_to ?? '' }}
                                                    @endif
                                                </li>
                                            </ul>
                                        </div>
                                    @endforeach
                                </div>
                            @endif

                            @if (isset($candidate->seekerDetail->seekerSkill) && $candidate->seekerDetail->seekerSkill->count() > 0)
                                <div class="can-d-skils-area py-30">
                                    <h3 class="can-d-h3">{{ __('label.skills') }}</h3>
                                    <ul class="profile_list_item inline_btn_style m-0 p-0">
                                        @if (isset($candidate->seekerDetail->seekerSkill))
                                            @foreach ($candidate->seekerDetail->seekerSkill as $skill)
                                                <li class="">{{ $skill->skill->title ?? '' }} </li>
                                            @endforeach
                                        @endif
                                    </ul>
                                </div>
                            @endif
                            @if (isset($candidate->seekerDetail->seekerLicense) && $candidate->seekerDetail->seekerLicense->count() > 0)
                                <div class="can-d-exprience-area py-30 border-bottom">
                                    <h3 class="can-d-h3">{{ __('Certifications') }}</h3>
                                    @foreach ($candidate->seekerDetail->seekerLicense as $license)
                                        <div class="de-dont-containt awards">
                                            <ul>
                                                <li class="name">{{ $license->certificate_name ?? '' }}</li>
                                                <li class="role">{{ $license->certifying_authority ?? '' }}</li>
                                                <p class="duration">
                                                    {{ date('M', mktime(0, 0, 0, $license->from_month, 1)) }} /
                                                    {{ $license->from_year ?? '' }}
                                                </p>
                                            </ul>
                                        </div>
                                    @endforeach
                                </div>
                            @endif

                            @if (isset($candidate->candidateNote) && $candidate->candidateNote->count() > 0)
                                @if (auth()->user() &&
                                        auth()->user()->hasRole('employer'))
                                    <div class="can-information-box row border-top">
                                        <div class="col-md-12">
                                            <div class="can-d-skils-area border-0 py-30">
                                                <h3 class="can-d-h3 mb-0">{{ __('label.admin_notes') }}</h3>
                                                <div id="note-list">
                                                    @include('components.note_list', [
                                                        'candidate' => $candidate,
                                                    ])
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endif

                        </div>

                        <div class="tabcontent" id="Attachments">
                            <div class="candi-about-me-area mb-100">
                                <h3 class="can-d-h3 mt-4">{{ __('Attachments') }}</h3>
                                <div class="row attachment_listed_wraper">
                                    <div class="col-md-6 col-lg-4 mb-4 mb-md-0">
                                        <p class="mb-2">{{ __('label.your_resume') }}</p>
                                        @include('candidates.attachments', [
                                            'candidate' => $candidate,
                                            'width' => '100%',
                                            'height' => '100%',
                                        ])
                                    </div>
                                    <div class="col-md-6 col-lg-4">
                                        <p class="mb-2">{{ __('label.your_cover_letter') }}</p>
                                        @include('candidates.cover', [
                                            'candidate' => $candidate,
                                            'width' => '100%',
                                            'height' => '100%',
                                        ])
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tabcontent" id="Reviews">
                            <div class="candi-about-me-area">
                                @include('candidates.review')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
</div>

<script>
    $(document).ready(function() {
        $('a.cd-nav-a-link').click(function() {
            $('a.cd-nav-a-link.active').removeClass("active");
            $(this).addClass("active");
        });
    });
</script>
<script>
    $(document).ready(function() {
        // Activate tab based on URL hash
        const urlHash = window.location.hash;
        if (urlHash === "#review_tab") {
            activateTab('review_tab');
        }

        // Click event for tab links
        $('a.cd-nav-a-link').click(function() {
            $('a.cd-nav-a-link.active').removeClass("active");
            $(this).addClass("active");
        });

        // Function to activate a specific tab
        function activateTab(tabName) {
            const tabLink = document.getElementById(tabName);
            if (tabLink) {
                tabLink.click();
            }
        }
    });
</script>

<script>
    function openPage(pageName, elmnt, color) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablink");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].style.backgroundColor = "";
        }
        document.getElementById(pageName).style.display = "block";
    }

    // Get the element with id="defaultOpen" and click on it
    document.getElementById("defaultOpen").click();
</script>
