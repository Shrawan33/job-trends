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
                    <div class="col-md-6 col-lg-5 col-xl-4 pl-md-0 col-9">
                        <div>
                            <div class="candidate-single-dagignation ml-10">
                                <h2 class="mb-5">
                                    {{ $candidate->first_name . ' ' . $candidate->middle_name . ' ' . $candidate->last_name ?? null }}
                                    @if ($candidate->verified == 1)
                                        &nbsp;
                                    @endif
                                </h2>
                                @if (!empty($candidate->seekerDetail))
                                    <p class="posted_on mb-10">{{ $candidate->seekerDetail->title ?? '' }} </span></p>
                                @endif
                                <ul class="social_icons m-0 p-0 d-flex job_detail_social_readonly">

                                    @if ($candidate->seekerDetail->facebook_url)
                                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40"
                                            viewBox="0 0 40 40" fill="none">
                                            <circle cx="19.5" cy="20" r="17"
                                                fill="url(#paint0_linear_1223_1218)" />
                                            <path
                                                d="M25.8305 25.199L26.5857 20.4008H21.8616V17.2885C21.8616 15.9755 22.5203 14.6949 24.6362 14.6949H26.7853V10.6099C26.7853 10.6099 24.8358 10.2857 22.9728 10.2857C19.0805 10.2857 16.5387 12.5843 16.5387 16.7438V20.4008H12.2139V25.199H16.5387V36.799C17.407 36.9319 18.2953 37 19.2002 37C20.1051 37 20.9934 36.9319 21.8616 36.799V25.199H25.8305Z"
                                                fill="white" />
                                            <defs>
                                                <linearGradient id="paint0_linear_1223_1218" x1="19.5"
                                                    y1="3" x2="19.5" y2="36.8992"
                                                    gradientUnits="userSpaceOnUse">
                                                    <stop stop-color="#18ACFE" />
                                                    <stop offset="1" stop-color="#0163E0" />
                                                </linearGradient>
                                            </defs>
                                        </svg>
                                    @endif


                                    @if ($candidate->seekerDetail->linkedin_url)
                                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40"
                                            viewBox="0 0 40 40" fill="none">
                                            <rect x="2.5" y="2.5" width="34" height="34" rx="17"
                                                fill="#1275B1" />
                                            <path
                                                d="M14.5232 12.1152C14.5232 13.2834 13.5106 14.2304 12.2616 14.2304C11.0126 14.2304 10 13.2834 10 12.1152C10 10.947 11.0126 10 12.2616 10C13.5106 10 14.5232 10.947 14.5232 12.1152Z"
                                                fill="white" />
                                            <path d="M10.3093 15.7851H14.1753V27.5H10.3093V15.7851Z" fill="white" />
                                            <path
                                                d="M20.3995 15.7851H16.5335V27.5H20.3995C20.3995 27.5 20.3995 23.812 20.3995 21.5061C20.3995 20.122 20.8721 18.7319 22.7577 18.7319C24.8888 18.7319 24.8759 20.5432 24.866 21.9464C24.853 23.7806 24.884 25.6523 24.884 27.5H28.75V21.3171C28.7173 17.3692 27.6885 15.5501 24.3041 15.5501C22.2942 15.5501 21.0484 16.4626 20.3995 17.2881V15.7851Z"
                                                fill="white" />
                                        </svg>
                                    @endif


                                    @if ($candidate->seekerDetail->instagram_url)
                                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40"
                                            viewBox="0 0 40 40" fill="none">
                                            <rect x="2.5" y="3" width="34" height="34" rx="17"
                                                fill="url(#paint0_radial_1093_4533)" />
                                            <rect x="2.5" y="3" width="34" height="34" rx="17"
                                                fill="url(#paint1_radial_1093_4533)" />
                                            <rect x="2.5" y="3" width="34" height="34" rx="17"
                                                fill="url(#paint2_radial_1093_4533)" />
                                            <path
                                                d="M26.9802 14.1229C26.9802 15.0081 26.2625 15.7257 25.3773 15.7257C24.4921 15.7257 23.7745 15.0081 23.7745 14.1229C23.7745 13.2376 24.4921 12.52 25.3773 12.52C26.2625 12.52 26.9802 13.2376 26.9802 14.1229Z"
                                                fill="white" />
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M19.5002 25.3429C22.4509 25.3429 24.843 22.9508 24.843 20C24.843 17.0492 22.4509 14.6572 19.5002 14.6572C16.5494 14.6572 14.1573 17.0492 14.1573 20C14.1573 22.9508 16.5494 25.3429 19.5002 25.3429ZM19.5002 23.2057C21.2706 23.2057 22.7059 21.7705 22.7059 20C22.7059 18.2295 21.2706 16.7943 19.5002 16.7943C17.7297 16.7943 16.2945 18.2295 16.2945 20C16.2945 21.7705 17.7297 23.2057 19.5002 23.2057Z"
                                                fill="white" />
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M8.81445 19.5726C8.81445 15.9818 8.81445 14.1865 9.51326 12.815C10.1279 11.6086 11.1088 10.6278 12.3152 10.0131C13.6866 9.3143 15.482 9.3143 19.0727 9.3143H19.9276C23.5183 9.3143 25.3137 9.3143 26.6852 10.0131C27.8916 10.6278 28.8724 11.6086 29.4871 12.815C30.1859 14.1865 30.1859 15.9818 30.1859 19.5726V20.4274C30.1859 24.0182 30.1859 25.8135 29.4871 27.185C28.8724 28.3914 27.8916 29.3722 26.6852 29.9869C25.3137 30.6857 23.5183 30.6857 19.9276 30.6857H19.0727C15.482 30.6857 13.6866 30.6857 12.3152 29.9869C11.1088 29.3722 10.1279 28.3914 9.51326 27.185C8.81445 25.8135 8.81445 24.0182 8.81445 20.4274V19.5726ZM19.0727 11.4514H19.9276C21.7582 11.4514 23.0027 11.4531 23.9646 11.5317C24.9015 11.6082 25.3807 11.747 25.7149 11.9173C26.5192 12.3271 27.1731 12.981 27.5829 13.7852C27.7532 14.1195 27.8919 14.5986 27.9685 15.5356C28.0471 16.4975 28.0487 17.742 28.0487 19.5726V20.4274C28.0487 22.2581 28.0471 23.5025 27.9685 24.4644C27.8919 25.4014 27.7532 25.8805 27.5829 26.2148C27.1731 27.019 26.5192 27.6729 25.7149 28.0827C25.3807 28.253 24.9015 28.3918 23.9646 28.4683C23.0027 28.5469 21.7582 28.5486 19.9276 28.5486H19.0727C17.2421 28.5486 15.9977 28.5469 15.0358 28.4683C14.0988 28.3918 13.6196 28.253 13.2854 28.0827C12.4811 27.6729 11.8273 27.019 11.4175 26.2148C11.2472 25.8805 11.1084 25.4014 11.0318 24.4644C10.9533 23.5025 10.9516 22.2581 10.9516 20.4274V19.5726C10.9516 17.742 10.9533 16.4975 11.0318 15.5356C11.1084 14.5986 11.2472 14.1195 11.4175 13.7852C11.8273 12.981 12.4811 12.3271 13.2854 11.9173C13.6196 11.747 14.0988 11.6082 15.0358 11.5317C15.9977 11.4531 17.2421 11.4514 19.0727 11.4514Z"
                                                fill="white" />
                                            <defs>
                                                <radialGradient id="paint0_radial_1093_4533" cx="0"
                                                    cy="0" r="1" gradientUnits="userSpaceOnUse"
                                                    gradientTransform="translate(14.6429 28.5) rotate(-55.3758) scale(30.9881)">
                                                    <stop stop-color="#B13589" />
                                                    <stop offset="0.79309" stop-color="#C62F94" />
                                                    <stop offset="1" stop-color="#8A3AC8" />
                                                </radialGradient>
                                                <radialGradient id="paint1_radial_1093_4533" cx="0"
                                                    cy="0" r="1" gradientUnits="userSpaceOnUse"
                                                    gradientTransform="translate(13.4286 38.2143) rotate(-65.1363) scale(27.4359)">
                                                    <stop stop-color="#E0E8B7" />
                                                    <stop offset="0.444662" stop-color="#FB8A2E" />
                                                    <stop offset="0.71474" stop-color="#E2425C" />
                                                    <stop offset="1" stop-color="#E2425C" stop-opacity="0" />
                                                </radialGradient>
                                                <radialGradient id="paint2_radial_1093_4533" cx="0"
                                                    cy="0" r="1" gradientUnits="userSpaceOnUse"
                                                    gradientTransform="translate(0.678573 4.21429) rotate(-8.1301) scale(47.2246 10.1009)">
                                                    <stop offset="0.156701" stop-color="#406ADC" />
                                                    <stop offset="0.467799" stop-color="#6A45BE" />
                                                    <stop offset="1" stop-color="#6A45BE" stop-opacity="0" />
                                                </radialGradient>
                                            </defs>
                                        </svg>
                                    @endif

                                    @if ($candidate->seekerDetail->blog_url)
                                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40"
                                            viewBox="0 0 40 40" fill="none">
                                            <path
                                                d="M19 37C28.3888 37 36 29.3888 36 20C36 10.6112 28.3888 3 19 3C9.61116 3 2 10.6112 2 20C2 29.3888 9.61116 37 19 37Z"
                                                fill="#F2780C" />
                                            <path
                                                d="M25.4221 18.3274V15.6286C25.4221 12.7143 22.4001 10.7714 20.4572 10.7714H15.5453C12.1453 10.7714 9.77148 13.2 9.77148 16.6V24.3714C9.77148 27.7184 12.1453 30.2 15.6001 30.2H23.4262C26.8262 30.2 29.2001 27.7273 29.2001 24.3714V22.4286C29.2001 19.5143 28.3364 18.3274 25.4221 18.3274ZM15.978 15.6286H20.2947C20.6526 15.6286 20.9958 15.7707 21.2489 16.0238C21.5019 16.2769 21.6441 16.6201 21.6441 16.978C21.6441 17.3359 21.5019 17.6791 21.2489 17.9321C20.9958 18.1852 20.6526 18.3274 20.2947 18.3274H15.978C15.6201 18.3274 15.2769 18.1852 15.0239 17.9321C14.7708 17.6791 14.6286 17.3359 14.6286 16.978C14.6286 16.6201 14.7708 16.2769 15.0239 16.0238C15.2769 15.7707 15.6201 15.6286 15.978 15.6286ZM22.9935 25.3429H15.978C15.6201 25.3429 15.2769 25.2007 15.0239 24.9476C14.7708 24.6946 14.6286 24.3513 14.6286 23.9934C14.6286 23.6356 14.7708 23.2923 15.0239 23.0393C15.2769 22.7862 15.6201 22.644 15.978 22.644H22.9935C23.3514 22.644 23.6946 22.7862 23.9477 23.0393C24.2007 23.2923 24.3429 23.6356 24.3429 23.9934C24.3429 24.3513 24.2007 24.6946 23.9477 24.9476C23.6946 25.2007 23.3514 25.3429 22.9935 25.3429Z"
                                                fill="white" />
                                        </svg>
                                    @endif

                                </ul>
                            </div>
                        </div>
                    </div>
                    <div
                        class="col-xl-7 col-lg-6 col-md-12 mt-3 mt-lg-0 d-flex flex-wrap justify-content-start justify-content-md-end pl-lg-0">
                        <div class="user-action-info flex-shrink-0" id="user_action_{{ $candidate->id }}">
                            @role('employer')
                                @include('components.candidate_favourite_button', [
                                    'class_unfav_btn' => ' btn-md',
                                    'class_fav_btn' => 'btn-md',
                                    'class_report_btn' => ' btn-md',
                                    'class_reportmobile_btn' => ' btn-md',
                                    'class_share_btn' => 'btn-md',
                                    'class_sendmail_btn' => ' btn-sm',
                                    'class_sendmailmobile_btn' => ' btn-md',
                                    'id' => $candidate->id,
                                    'model' => $candidate ?? [],
                                    'from' => $from ?? 'detail-page',
                                ])
                            @endrole
                        </div>
                        @if (auth()->check() && auth()->user()->hasRole('employer') && $candidate->seekerDetail->is_public_profile == 1)
                            <div class="candidate-daunlode-cv mt-3 mt-lg-0 mr-40 mr-md-0">
                                <a href="{{ route('download-cv', $candidate->id) }}"
                                    class="btn btn-primary ml-auto btn-sm">
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
                        @endif
                        <div class="candidate-daunlode-cv mt-3 mt-lg-0">
                            @include('components.candidate_note_button', [
                                'entity' => 'candidate',
                                'entityData' => $candidate,
                                'id' => $candidate->id,
                            ])
                        </div>
                        {{-- @if (auth()->user() && (auth()->user()->hasRole('jobseeker') || auth()->user()->hasRole('employer')))
                            <div class="candidate-daunlode-cv mt-3 mt-lg-0 ml-20 ml-md-0">
                                @include('components.review_button', [
                                    'entity' => 'candidate',
                                    'entityData' => $candidate,
                                    'id' => $candidate->id,
                                ])
                            </div>
                        @endif --}}

                        @if (auth()->user() && (auth()->user()->hasRole('jobseeker') || auth()->user()->hasRole('employer')))
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
                                id="defaultOpen">{{ __('label.per_info') }}</a>
                        </li>

                        @if (auth()->check() && auth()->user()->hasRole('employer') && $candidate->seekerDetail->is_public_profile == 1)
                            <li class="candidate-details-nav-li">
                                <a class="cd-nav-a-link tablink"
                                    onclick="openPage('Attachments')">{{ __('label.attachments') }}</a>
                            </li>
                        @endif

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
                                {!! $candidate->seekerDetail->profile_summary ?? '' !!}
                            </div>
                            @if (auth()->check() && auth()->user()->hasRole('employer') && $candidate->seekerDetail->is_public_profile == 1)
                                @if (isset($candidate->seekerDetail))
                                    <div class="candidate-informatin-can-d-area border-bottom">
                                        <div class="can-information-box row">
                                            <div class="can-info-icone-text-box col-md-4 col-xl-2 mb-30">
                                                <div class="can-info-text-area">
                                                    <span class="label_text">{{ __('Contact Number') }}</span>
                                                    <p class="label_value mb-0">{{ $candidate->phone_number ?? '' }}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="can-info-icone-text-box col-md-4 col-xl-2 mb-30 pl-lg-0">
                                                <div class="can-info-text-area">
                                                    <span class="label_text">{{ __('Email Address') }}</span>
                                                    <p class="label_value mb-0 text-lowercase">
                                                        {{ $candidate->email ?? '' }}</p>
                                                </div>
                                            </div>
                                            {{-- @dd($candidate->specialization) --}}
                                            @if (isset($candidate->seekerDetail->specialization) && !empty($candidate->seekerDetail->specialization))
                                                <div class="can-info-icone-text-box col-md-4 col-xl-2 mb-30">
                                                    <div class="can-info-text-area">
                                                        <span class="label_text">{{ __('Specialization') }}</span>
                                                        <p class="label_value mb-0">
                                                            {{ $candidate->seekerDetail->specialization->name ?? '-' }}
                                                        </p>
                                                    </div>
                                                </div>
                                            @endif
                                            @if (isset($candidate->seekerDetail->personal_statement) && !empty($candidate->seekerDetail->personal_statement))
                                                <div class="can-info-icone-text-box col-md-4 col-xl-2 mb-30">
                                                    <div class="can-info-text-area">
                                                        <span class="label_text">{{ __('Personal Statement') }}</span>
                                                        <p class="label_value mb-0"> {!! $candidate->seekerDetail->personal_statement ?? '-' !!}</p>
                                                    </div>
                                                </div>
                                            @endif
                                            {{-- @if (isset($candidate->seekerDetail->personal_statement) && !empty($candidate->seekerDetail->personal_statement))
                                                <span>{{ trans('label.gender') }}</span>
                                                <p class="mb-0">
                                                    {{ $candidate->seekerDetail->gender ? config("constants.gender.$candidate->seekerDetail->gender") : '-' }}
                                                </p>
                                            @endif --}}
                                            {{-- @dd($candidate->seekerDetail) --}}
                                            <div class="can-info-icone-text-box col-md-4 col-xl-2 mb-30">
                                                <div class="can-info-text-area">
                                                    <span>{{ trans('label.gender') }}</span>
                                                    <p class="label_value mb-0">
                                                        {{ $candidate->gender ? config("constants.gender.$candidate->gender") : '-' }}
                                                    </p>
                                                </div>
                                            </div>
                                            {{-- @dd($candidate->seekerDetail->total_experience) --}}
                                            @if (isset($candidate->seekerDetail->personal_statement) && !empty($candidate->seekerDetail->personal_statement))
                                                <div class="can-info-icone-text-box col-md-4 col-xl-2 mb-30">
                                                    <div class="can-info-text-area">
                                                        <span class="label_text">{{ __('Personal Statement') }}</span>
                                                        <p class="label_value mb-0">
                                                            {{ $candidate->seekerDetail->total_experience ? $candidate->seekerDetail->total_experience . ' Years Experience' : '-' }}
                                                        </p>
                                                    </div>
                                                </div>
                                            @endif
                                            {{-- @if (isset($candidate->seekerDetail->personal_statement) && !empty($candidate->seekerDetail->personal_statement)) --}}
                                            <div class="can-info-icone-text-box col-md-4 col-xl-2 mb-30">
                                                <span>{{ trans('label.work_type') }}</span>
                                                @if ($candidate->seekerDetail->workTypes->isEmpty())
                                                    <p>{{ $item->workType->title ?? '-' }}</p>
                                                @else
                                                    @foreach ($candidate->seekerDetail->workTypes as $item)
                                                        <p>{{ $item->workType->title ?? '-' }}</p>
                                                    @endforeach
                                                @endif
                                            </div>
                                            @if (isset($candidate->seekerDetail->address) && !empty($candidate->seekerDetail->address))
                                                <div class="can-info-icone-text-box col-md-4 col-xl-2 mb-30">
                                                    <span>{{ trans('label.employer_address') }}</span>
                                                    <p class="label_value mb-0">
                                                        {{ $candidate->seekerDetail->address ?? '-' }}</p>
                                                </div>
                                            @endif
                                            @if (isset($candidate->seekerDetail->dob) && !empty($candidate->seekerDetail->dob))
                                                <div class="can-info-icone-text-box col-md-4 col-xl-2 mb-30">
                                                    <span>{{ trans('label.dob') }}</span>
                                                    <p class="label_value mb-0">
                                                        {{ \Carbon\Carbon::parse($candidate->seekerDetail->dob)->format('M d, Y') }}
                                                    </p>
                                                </div>
                                            @endif
                                            @if (isset($candidate->seekerDetail->age) && !empty($candidate->seekerDetail->age))
                                                <div class="can-info-icone-text-box col-md-4 col-xl-2 mb-30">
                                                    <span>{{ trans('label.age') }}</span>
                                                    <p class="label_value mb-0">
                                                        {{ $candidate->seekerDetail->age ?? '-' }}</p>
                                                </div>
                                            @endif
                                            @if (isset($candidate->seekerDetail->mobile_number) && !empty($candidate->seekerDetail->mobile_number))
                                                <div class="can-info-icone-text-box col-md-4 col-xl-2 mb-30">
                                                    <span>{{ trans('label.mobile') }}</span>
                                                    <p class="label_value mb-0">
                                                        {{ $candidate->seekerDetail->mobile_number ?? '-' }}</p>
                                                </div>
                                            @endif
                                            {{-- @if (isset($candidate->seekerDetail->language_known) && !empty($candidate->seekerDetail->language_known))
                                                <div class="can-info-icone-text-box col-md-4 col-xl-2 mb-30">
                                                    <span>{{ trans('label.language_known') }}</span>
                                                    <p class="label_value mb-0">
                                                        {{ $candidate->seekerDetail->language_known ?? '-' }}</p>
                                                </div>
                                            @endif --}}
                                            @if (isset($candidate->seekerDetail->professional_manner) && !empty($candidate->seekerDetail->professional_manner))
                                                <div class="can-info-icone-text-box col-md-4 col-xl-2 mb-30">
                                                    <span>{{ trans('label.professional_manner') }}</span>
                                                    <p class="label_value mb-0">
                                                        {{ $candidate->seekerDetail->professional_manner ?? '-' }}</p>
                                                </div>
                                            @endif
                                            @if (isset($candidate->seekerDetail->my_core_competencies) && !empty($candidate->seekerDetail->my_core_competencies))
                                                <div class="can-info-icone-text-box col-md-4 col-xl-2 mb-30">
                                                    <span>{{ trans('label.my_core_competencies') }}</span>
                                                    <p class="label_value mb-0">
                                                        {{ $candidate->seekerDetail->my_core_competencies ?? '-' }}</p>
                                                </div>
                                            @endif
                                            @if (isset($candidate->seekerDetail->current_salary) && !empty($candidate->seekerDetail->current_salary))
                                                <div class="can-info-icone-text-box col-md-4 col-xl-2 mb-30">
                                                    <span>{{ trans('label.current_salary') }}</span>
                                                    <p class="label_value mb-0">
                                                        {{ $candidate->seekerDetail->current_salary ?? '-' }}</p>
                                                </div>
                                            @endif
                                            @if (isset($candidate->seekerDetail->expected_salary) && !empty($candidate->seekerDetail->expected_salary))
                                                <div class="can-info-icone-text-box col-md-4 col-xl-2 mb-30">
                                                    <span>{{ trans('label.expected_salary') }}</span>
                                                    <p class="label_value mb-0">
                                                        {{ $candidate->seekerDetail->expected_salary ?? '-' }}</p>
                                                </div>
                                            @endif
                                            @if (isset($candidate->seekerDetail->current_position) && !empty($candidate->seekerDetail->current_position))
                                                <div class="can-info-icone-text-box col-md-4 col-xl-2 mb-30">
                                                    <span>{{ trans('label.current_position') }}</span>
                                                    <p class="label_value mb-0">
                                                        {{ $candidate->seekerDetail->current_position ?? '-' }}</p>
                                                </div>
                                            @endif
                                            @if (isset($candidate->seekerDetail->category) && !empty($candidate->seekerDetail->category))
                                                <div class="can-info-icone-text-box col-md-4 col-xl-2 mb-30">
                                                    <span>{{ trans('label.category') }}</span>
                                                    <p class="label_value mb-0">
                                                        {{ $candidate->seekerDetail->category->title ?? '-' }}</p>
                                                </div>
                                            @endif
                                            @if (isset($candidate->seekerDetail->current_company) && !empty($candidate->seekerDetail->current_company))
                                                <div class="can-info-icone-text-box col-md-4 col-xl-2 mb-30">
                                                    <span>{{ trans('label.current_company') }}</span>
                                                    <p class="label_value mb-0">
                                                        {{ $candidate->seekerDetail->current_company ?? '-' }}</p>
                                                </div>
                                            @endif
                                            @if (isset($candidate->seekerDetail->city_preference) && !empty($candidate->seekerDetail->city_preference))
                                                <div class="can-info-icone-text-box col-md-4 col-xl-2 mb-30">
                                                    <span>{{ trans('label.city_preference') }}</span>
                                                    <p class="label_value mb-0">
                                                        {{ $candidate->seekerDetail->city_preference->name ?? '-' }}
                                                    </p>
                                                </div>
                                            @endif
                                            @if (isset($candidate->seekerDetail->my_core_competencies) && !empty($candidate->seekerDetail->my_core_competencies))
                                                <div class="can-info-icone-text-box col-md-4 col-xl-2 mb-30">
                                                    <span>{{ trans('label.my_core_competencies') }}</span>
                                                    <p class="label_value mb-0">
                                                        {{ $candidate->seekerDetail->my_core_competencies ?? '-' }}</p>
                                                </div>
                                            @endif
                                            @if (isset($candidate->seekerDetail->place_of_birth) && !empty($candidate->seekerDetail->place_of_birth))
                                                <div class="can-info-icone-text-box col-md-4 col-xl-2 mb-30">
                                                    <span>{{ trans('label.place_of_birth') }}</span>
                                                    <p class="label_value mb-0">
                                                        {{ $candidate->seekerDetail->place_of_birth ?? '-' }}</p>
                                                </div>
                                            @endif
                                            @if (isset($candidate->seekerDetail->marital_status) && !empty($candidate->seekerDetail->marital_status))
                                                <div class="can-info-icone-text-box col-md-4 col-xl-2 mb-30">
                                                    <span>{{ trans('label.marital_status') }}</span>
                                                    {{-- <p class="label_value mb-0"> {{ $candidate->seekerDetail->marital_status ? config("constants.marital_status.$candidate->seekerDetail->marital_status") : '-' }}</p> --}}
                                                    @if ($candidate->seekerDetail->marital_status == 1)
                                                        <p class="label_value mb-0"> Single</p>
                                                    @endif
                                                    @if ($candidate->seekerDetail->marital_status == 2)
                                                        <p class="label_value mb-0"> Married </p>
                                                    @endif
                                                    @if ($candidate->seekerDetail->marital_status == 3)
                                                        <p class="label_value mb-0"> Divorced </p>
                                                    @endif
                                                </div>
                                            @endif
                                            @if (isset($candidate->seekerDetail->permanent_address) && !empty($candidate->seekerDetail->permanent_address))
                                                <div class="can-info-icone-text-box col-md-4 col-xl-2 mb-30">
                                                    <span>{{ trans('label.permanent_address') }}</span>
                                                    <p class="label_value mb-0">
                                                        {{ $candidate->seekerDetail->permanent_address ?? '-' }}</p>
                                                </div>
                                            @endif
                                            @if (isset($candidate->seekerDetail->nationality) && !empty($candidate->seekerDetail->nationality))
                                                <div class="can-info-icone-text-box col-md-4 col-xl-2 mb-30">
                                                    <span>{{ trans('label.permanent_address') }}</span>
                                                    <p class="label_value mb-0">
                                                        @if ($candidate->seekerDetail->nationality == 1)
                                                            Indian
                                                        @else
                                                            Others
                                                        @endif
                                                    </p>
                                                </div>
                                            @endif
                                            @if (isset($candidate->seekerDetail->facebook_url) && !empty($candidate->seekerDetail->facebook_url))
                                                <div class="can-info-icone-text-box col-md-4 col-xl-2 mb-30">
                                                    <span>{{ trans('label.facebook_url') }}</span>
                                                    {{-- <p class="label_value mb-0">
                                                        {{ $candidate->seekerDetail->facebook_url ?? '-' }}</p> --}}
                                                    <p class="label_value mb-0">
                                                        <a href="{{ $candidate->seekerDetail->facebook_url }}"
                                                            target="_blank">
                                                            {{ $candidate->seekerDetail->facebook_url }}
                                                        </a>
                                                    </p>
                                                </div>
                                            @endif
                                            @if (isset($candidate->seekerDetail->instagram_url) && !empty($candidate->seekerDetail->instagram_url))
                                                <div class="can-info-icone-text-box col-md-4 col-xl-2 mb-30">
                                                    <span>{{ trans('label.instagram_url') }}</span>
                                                    {{-- <p class="label_value mb-0">
                                                        {{ $candidate->seekerDetail->facebook_url ?? '-' }}</p> --}}
                                                    <p class="label_value mb-0">
                                                        <a href="{{ $candidate->seekerDetail->instagram_url }}"
                                                            target="_blank">
                                                            {{ $candidate->seekerDetail->instagram_url }}
                                                        </a>
                                                    </p>
                                                </div>
                                            @endif
                                            @if (isset($candidate->seekerDetail->blog_url) && !empty($candidate->seekerDetail->blog_url))
                                                <div class="can-info-icone-text-box col-md-4 col-xl-2 mb-30">
                                                    <span>{{ trans('label.blog_url') }}</span>
                                                    {{-- <p class="label_value mb-0">
                                                        {{ $candidate->seekerDetail->facebook_url ?? '-' }}</p> --}}
                                                    <p class="label_value mb-0">
                                                        <a href="{{ $candidate->seekerDetail->blog_url }}"
                                                            target="_blank">
                                                            {{ $candidate->seekerDetail->blog_url }}
                                                        </a>
                                                    </p>
                                                </div>
                                            @endif
                                            @if (isset($candidate->seekerDetail->linkedin_url) && !empty($candidate->seekerDetail->linkedin_url))
                                                <div class="can-info-icone-text-box col-md-4 col-xl-2 mb-30">
                                                    <span>{{ trans('label.linkedin_url') }}</span>
                                                    {{-- <p class="label_value mb-0">
                                                    {{ $candidate->seekerDetail->facebook_url ?? '-' }}</p> --}}
                                                    <p class="label_value mb-0">
                                                        <a href="{{ $candidate->seekerDetail->linkedin_url }}"
                                                            target="_blank">
                                                            {{ $candidate->seekerDetail->linkedin_url }}
                                                        </a>
                                                    </p>
                                                </div>
                                            @endif
                                            @if (isset($candidate->seekerDetail->is_fresher) && !empty($candidate->seekerDetail->is_fresher))
                                                <div class="can-info-icone-text-box col-md-4 col-xl-2 mb-30">
                                                    <span>{{ trans('label.is_fresher') }}</span>
                                                    <p class="label_value mb-0">
                                                        @if ($candidate->seekerDetail->is_fresher == 1)
                                                            Yes
                                                        @else
                                                            No
                                                        @endif
                                                    </p>
                                                </div>
                                            @endif
                                            @if (isset($candidate->seekerDetail->training_name) && !empty($candidate->seekerDetail->training_name))
                                                <div class="can-info-icone-text-box col-md-4 col-xl-2 mb-30">
                                                    <span>{{ trans('label.training_name') }}</span>
                                                    <p class="label_value mb-0">
                                                        {{ $candidate->seekerDetail->training_name ?? '-' }}</p>
                                                </div>
                                            @endif
                                            @if (isset($candidate->seekerDetail->attended_at_company) && !empty($candidate->seekerDetail->attended_at_company))
                                                <div class="can-info-icone-text-box col-md-4 col-xl-2 mb-30">
                                                    <span>{{ trans('label.attended_at_company') }}</span>
                                                    <p class="label_value mb-0">
                                                        {{ $candidate->seekerDetail->attended_at_company ?? '-' }}</p>
                                                </div>
                                            @endif
                                            @if (isset($candidate->seekerDetail->year) && !empty($candidate->seekerDetail->year))
                                                <div class="can-info-icone-text-box col-md-4 col-xl-2 mb-30">
                                                    <span>{{ trans('label.year') }}</span>
                                                    <p class="label_value mb-0">
                                                        {{ $candidate->seekerDetail->year ?? '-' }}</p>
                                                </div>
                                            @endif
                                            @if (isset($candidate->seekerDetail->Religion) && !empty($candidate->seekerDetail->Religion))
                                                <div class="can-info-icone-text-box col-md-4 col-xl-2 mb-30">
                                                    <span>{{ trans('label.Religion') }}</span>
                                                    <p class="label_value mb-0">
                                                        {{ $candidate->seekerDetail->Religion ?? '-' }}</p>
                                                </div>
                                            @endif
                                            @if (isset($candidate->seekerDetail->Religion) && !empty($candidate->seekerDetail->Religion))
                                                <div class="can-info-icone-text-box col-md-4 col-xl-2 mb-30">
                                                    <span>{{ trans('label.Religion') }}</span>
                                                    <p class="label_value mb-0">
                                                        {{ $candidate->seekerDetail->Religion ?? '-' }}</p>
                                                </div>
                                            @endif
                                            @if (isset($candidate->seekerDetail->currently_staying_in) && !empty($candidate->seekerDetail->currently_staying_in))
                                                <div class="can-info-icone-text-box col-md-4 col-xl-2 mb-30">
                                                    <span>{{ trans('label.currently_staying_in') }}</span>
                                                    <p class="label_value mb-0">
                                                        {{ $candidate->seekerDetail->currently_staying_in ?? '-' }}</p>
                                                </div>
                                            @endif
                                            @if (isset($candidate->seekerDetail->currently_staying_in) && !empty($candidate->seekerDetail->currently_staying_in))
                                                <div class="can-info-icone-text-box col-md-4 col-xl-2 mb-30">
                                                    <span>{{ trans('label.currently_staying_in') }}</span>
                                                    <p class="label_value mb-0">
                                                        {{ $candidate->seekerDetail->currently_staying_in ?? '-' }}</p>
                                                </div>
                                            @endif
                                            @if (isset($candidate->seekerDetail->Relocation) && !empty($candidate->seekerDetail->Relocation))
                                                <div class="can-info-icone-text-box col-md-4 col-xl-2 mb-30">
                                                    <span>{{ trans('label.Relocation') }}</span>
                                                    <p class="label_value mb-0">
                                                        @if ($candidate->seekerDetail->Relocation == 1)
                                                            Yes
                                                        @else
                                                            No
                                                        @endif
                                                    </p>
                                                </div>
                                            @endif
                                            @if (isset($candidate->seekerDetail->is_public_profile) && !empty($candidate->seekerDetail->is_public_profile))
                                            <div class="can-info-icone-text-box col-md-4 col-xl-2 mb-30">
                                                <span>{{ trans('label.is_public_profile') }}</span>
                                                <p class="label_value mb-0">
                                                    @if ($candidate->seekerDetail->is_public_profile == 1)
                                                    Public
                                                    @else
                                                    Private

                                                    @endif
                                                </p>
                                            </div>
                                        @endif
                                            {{-- @endif --}}
                                            {{-- <div class="can-info-icone-text-box">
                                                <div class="can-info-text-area">
                                                    <span>{{__('label.expected_salary')}}</span>
                                                    @if ($candidate->seekerDetail->salary)
                                                        <p>${{$candidate->seekerDetail->salary}} / {{config('constants.salary_type.data.'.$candidate->seekerDetail->salary_type_id)}}</p>
                                                    @endif
                                                </div>
                                            </div> --}}
                                            <?php $parent_user = auth()->user()->created_by; ?>
                                            {{-- @if ($candidate->activeUserPackage($parent_user) || auth()->user()->roles[0]['name'] == 'admin')
                                                <div class="can-info-icone-text-box">
                                                    <div class="icone-img-can-info">
                                                        <i class="fal fa-file"></i>
                                                    </div>
                                                    <div class="can-info-text-area">
                                                        <h3>{{__('Assessment Report')}}</h3>
                                                        <p><a href="{{ route('assesmentcandidate', $candidate->id) }}" class="text-black"><span class="pr-2 float-right"><i class="fas fa-angle-right"></i></span>{{trans('Assessment Report') }}</a></p>
                                                    </div>
                                                </div>
                                            @endif --}}
                                            {{-- @if (isset($candidate->seekerDetail->licence_no) && !empty($candidate->seekerDetail->licence_no))
                                            <div class="can-info-icone-text-box col-md-4 col-xl-2 mb-30">
                                                <div class="can-info-text-area">
                                                    <span class="label_text">{{ __('label.licence_no') }}</span>
                                                    <p class="label_value mb-0">{{ $candidate->seekerDetail->licence_no ?? '' }}</p>
                                                </div>
                                            </div>
                                        @endif --}}
                                            {{-- @if (isset($candidate->seekerDetail->licence_validity) && !empty($candidate->seekerDetail->licence_validity))
                                            <div class="can-info-icone-text-box col-md-4 col-xl-2 mb-30">
                                                <div class="can-info-text-area">
                                                    <span class="label_text">{{ __('label.licence_validity') }}</span>
                                                    <p class="label_value mb-0">{{ isset($candidate->seekerDetail->licence_validity) ? date('M d, Y', strtotime($candidate->seekerDetail->licence_validity)) : '-' }}</p>

                                                    {{-- <p>{{ $candidate->seekerDetail->licence_validity ?? '' }}</p> --}
                                                </div>
                                            </div>
                                        @endif --}}
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
                                                            {{ $education->qualification->title ?? '' }}</p>
                                                    @endforeach
                                                </div>
                                            </div>
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
                                                    <li class="role">{{ $education->qualification->title ?? '' }}
                                                    </li>
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
                                    <div class="can-d-exprience-area py-30 border-bottom ">
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
                                                @foreach ($candidate->seekerSkill as $skill)
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
                                            @if ($license->certificate_name)
                                                <div class="de-dont-containt awards">
                                                    <ul>
                                                        <li class="name">{{ $license->certificate_name ?? '' }}
                                                        </li>
                                                        <li class="role">{{ $license->certifying_authority ?? '' }}
                                                        </li>
                                                        <li class="time">
                                                            {{ date('M', mktime(0, 0, 0, $license->from_month, 1)) }}
                                                            /
                                                            {{ $license->from_year ?? '' }}


                                                        </li>
                                                    </ul>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                @endif


                                @if (isset($candidate->candidateNote) && $candidate->candidateNote->count() > 0)

                                    @if (isset($candidate->candidateNote) && $candidate->candidateNote->count() > 0)
                                        @if (auth()->user() && auth()->user()->hasRole('employer'))
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
                                @endif
                            @endif
                        </div>

                        @if (auth()->check() && auth()->user()->hasRole('employer') && $candidate->seekerDetail->is_public_profile == 1)
                            <div class="tabcontent" id="Attachments">
                                <div class="candi-about-me-area mb-100">
                                    <h3 class="can-d-h3 mt-4">{{ __('Attachments') }}</h3>
                                    @include('candidates.attachments', [
                                        'candidate' => $candidate,
                                        'width' => '100%',
                                        'height' => '100%',
                                    ])
                                </div>
                            </div>
                        @endif
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
