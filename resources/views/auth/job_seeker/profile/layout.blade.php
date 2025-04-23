<style>
    .add-sidebar-image {
        position: relative;
        overflow: hidden;
        display: inline-block;
    }

    .add-sidebar-image {
        position: absolute;
        left: 0;
        top: 0;
        opacity: 0;
        right: 0;
        bottom: 0;
    }
</style>
<div class="col-md-4 col-lg-3 mb-40 mb-md-0 js_left_sidebar">
    <div class="left_side_wraper bg-white pr-lg-0">

        <ul class="m-0 menu_wraper">
            <li>
                <a href="{{ route('jobseekerDashboard.index') }}" class="@if (Route::is('jobseekerDashboard.index')) active @endif">
                    <span class="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18"
                            fill="none">
                            <path
                                d="M9 9L1 9M9 17L9 1M12.7333 17H5.26667C3.77319 17 3.02646 17 2.45603 16.7094C1.95426 16.4537 1.54631 16.0457 1.29065 15.544C1 14.9735 1 14.2268 1 12.7333V5.26667C1 3.77319 1 3.02646 1.29065 2.45603C1.54631 1.95426 1.95426 1.54631 2.45603 1.29065C3.02646 1 3.77319 1 5.26667 1H12.7333C14.2268 1 14.9735 1 15.544 1.29065C16.0457 1.54631 16.4537 1.95426 16.7094 2.45603C17 3.02646 17 3.77319 17 5.26667V12.7333C17 14.2268 17 14.9735 16.7094 15.544C16.4537 16.0457 16.0457 16.4537 15.544 16.7094C14.9735 17 14.2268 17 12.7333 17Z"
                                stroke="#9197A1" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </span>
                    {{ __('label.dashboard') }}
                </a>
            </li>
            <li>
                <a href="{{ route('users.profile') }}" class="@if (Route::is('users.profile') ||
                        Route::is('users.edit.profile', ['mainTitle' => 'intro']) ||
                        Route::is('users.edit.profile', ['mainTitle' => 'experience']) ||
                        Route::is('users.edit.profile', ['mainTitle' => 'education']) ||
                        Route::is('users.edit.profile', ['mainTitle' => 'licenses']) ||
                        Route::is('users.edit.profile', ['mainTitle' => 'skill']) ||
                        Route::is('users.edit.profile', ['mainTitle' => 'language_skill']) ||
                        Route::is('users.edit.profile', ['mainTitle' => 'video']) ||
                        Route::is('users.edit.profile', ['mainTitle' => 'personal'])) active @endif">
                    <span class="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18"
                            fill="none">
                            <path
                                d="M3.65304 14.9507C4.1397 13.8042 5.27594 13 6.6 13H11.4C12.7241 13 13.8603 13.8042 14.347 14.9507M12.2 7C12.2 8.76731 10.7673 10.2 9 10.2C7.23269 10.2 5.8 8.76731 5.8 7C5.8 5.23269 7.23269 3.8 9 3.8C10.7673 3.8 12.2 5.23269 12.2 7ZM17 9C17 13.4183 13.4183 17 9 17C4.58172 17 1 13.4183 1 9C1 4.58172 4.58172 1 9 1C13.4183 1 17 4.58172 17 9Z"
                                stroke="#9197A1" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </span>{{ __('label.profile') }}</a>
            </li>
            <li>
                <a href="{{ route('employers.index') }}" class="@if (Route::is('employers.index')) active @endif">
                    <span class="icon">
                        <svg width="16" height="18" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <mask id="mask0_1094_4493" style="mask-type:luminance" maskUnits="userSpaceOnUse"
                                x="0" y="0" width="24" height="24">
                                <path d="M0 1.90735e-06H24V24H0V1.90735e-06Z" fill="white" />
                            </mask>
                            <g mask="url(#mask0_1094_4493)">
                                <path d="M0.703125 21.5625H23.2969" stroke="#9197A1" stroke-width="1.5"
                                    stroke-miterlimit="10" stroke-linecap="round" />
                                <path d="M10.5085 4.09387H3.51562L0.703125 9.71582H23.2969L20.4844 4.09387H13.4915"
                                    stroke="#9197A1" stroke-width="1.5" stroke-miterlimit="10"
                                    stroke-linejoin="round" />
                                <path d="M21.8906 9.71592H2.10938V21.5625H21.8906V9.71592Z" stroke="#9197A1"
                                    stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path d="M18.6105 9.71582L12.0001 2.45587L5.38965 9.71582" stroke="#9197A1"
                                    stroke-width="1.5" stroke-miterlimit="10" stroke-linejoin="round" />
                            </g>
                            <path d="M18.7578 14.168V12.7594" stroke="#9197A1" stroke-width="1.5" stroke-miterlimit="10"
                                stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M12 14.168V12.7594" stroke="#9197A1" stroke-width="1.5" stroke-miterlimit="10"
                                stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M15.3789 14.168V12.7594" stroke="#9197A1" stroke-width="1.5" stroke-miterlimit="10"
                                stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M8.62109 14.168V12.7594" stroke="#9197A1" stroke-width="1.5" stroke-miterlimit="10"
                                stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M5.24219 14.168V12.7594" stroke="#9197A1" stroke-width="1.5" stroke-miterlimit="10"
                                stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M18.7578 18.5947V17.1861" stroke="#9197A1" stroke-width="1.5"
                                stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                            <mask id="mask1_1094_4493" style="mask-type:luminance" maskUnits="userSpaceOnUse"
                                x="0" y="0" width="24" height="24">
                                <path d="M0 1.90735e-06H24V24H0V1.90735e-06Z" fill="white" />
                            </mask>
                            <g mask="url(#mask1_1094_4493)">
                                <path d="M12 21.5625V17.1861" stroke="#9197A1" stroke-width="1.5"
                                    stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                            </g>
                            <path d="M15.3789 18.5947V17.1861" stroke="#9197A1" stroke-width="1.5"
                                stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M8.62109 18.5947V17.1861" stroke="#9197A1" stroke-width="1.5"
                                stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M5.24219 18.5947V17.1861" stroke="#9197A1" stroke-width="1.5"
                                stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </span>{{ __('label.search_employers') }}</a>
            </li>
            <li>
                <a href="{{ route('candidates.index') }}" class="@if (Route::is('candidates.index')) active @endif">
                    <span class="icon">
                        <svg width="18" height="18" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M18.3334 17.5V15.8333C18.3334 14.2801 17.2711 12.9751 15.8334 12.605M12.9167 2.7423C14.1383 3.23679 15.0001 4.43443 15.0001 5.83333C15.0001 7.23224 14.1383 8.42988 12.9167 8.92437M14.1667 17.5C14.1667 15.9469 14.1667 15.1703 13.913 14.5577C13.5747 13.741 12.9258 13.092 12.109 12.7537C11.4965 12.5 10.7199 12.5 9.16675 12.5H6.66675C5.11361 12.5 4.33704 12.5 3.72447 12.7537C2.90771 13.092 2.2588 13.741 1.92048 14.5577C1.66675 15.1703 1.66675 15.9469 1.66675 17.5M11.2501 5.83333C11.2501 7.67428 9.7577 9.16667 7.91675 9.16667C6.0758 9.16667 4.58341 7.67428 4.58341 5.83333C4.58341 3.99238 6.0758 2.5 7.91675 2.5C9.7577 2.5 11.2501 3.99238 11.2501 5.83333Z" stroke="#9197A1" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </span>{{ __('label.search_jobseeker') }}</a>
            </li>
            <li>
                <a href="{{ route('applyJobs.index') }}" class="@if (Route::is('applyJobs.index')) active @endif">
                    <span class="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="18" viewBox="0 0 16 18"
                            fill="none">
                            <path
                                d="M13.8 9.4V4.84C13.8 3.49587 13.8 2.82381 13.5384 2.31042C13.3083 1.85883 12.9412 1.49168 12.4896 1.26158C11.9762 1 11.3041 1 9.96 1H4.84C3.49587 1 2.82381 1 2.31042 1.26158C1.85883 1.49168 1.49168 1.85883 1.26158 2.31042C1 2.82381 1 3.49587 1 4.84V13.16C1 14.5041 1 15.1762 1.26158 15.6896C1.49168 16.1412 1.85883 16.5083 2.31042 16.7384C2.82381 17 3.49587 17 4.84 17H7.4M9 8.2H4.2M5.8 11.4H4.2M10.6 5H4.2M9.4 14.6L11 16.2L14.6 12.6"
                                stroke="#9197A1" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                    </span>{{ __('label.applied_jobs') }}</a>
            </li>
            <li>
                <a href="{{ route('favoriteJobs.index') }}" class="@if (Route::is('favoriteJobs.index')) active @endif">
                    <span class="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="16" viewBox="0 0 18 16"
                            fill="none">
                            <path
                                d="M6.6 7.4L8.2 9L11.8 5.4M8.99452 2.70865C7.39504 0.83872 4.7278 0.335714 2.72376 2.04801C0.719715 3.76031 0.437574 6.62318 2.01136 8.64832C3.20007 10.178 6.57703 13.2488 8.15841 14.6599C8.44911 14.9193 8.59446 15.049 8.76466 15.1001C8.91242 15.1444 9.07662 15.1444 9.22438 15.1001C9.39458 15.049 9.53993 14.9193 9.83064 14.6599C11.412 13.2488 14.789 10.178 15.9777 8.64832C17.5515 6.62318 17.3038 3.7423 15.2653 2.04801C13.2268 0.353726 10.594 0.83872 8.99452 2.70865Z"
                                stroke="#9197A1" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                    </span>{{ __('label.favourites') }} </a>
            </li>
            <li>
                <a href="{{ route('jobAlerts.index') }}" class="@if (Route::is('jobAlerts.index')) active @endif">
                    <span class="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="17" viewBox="0 0 18 17"
                            fill="none">
                            <path
                                d="M17 4.97679V8.17679M7.6 2.97678H4.84C3.49587 2.97678 2.82381 2.97678 2.31042 3.23837C1.85883 3.46847 1.49168 3.83562 1.26158 4.28721C0.999999 4.8006 0.999999 5.47266 1 6.81679L1 7.77678C1 8.52229 1 8.89505 1.12179 9.18908C1.28419 9.58112 1.59566 9.8926 1.98771 10.055C2.28174 10.1768 2.65449 10.1768 3.4 10.1768V13.5768C3.4 13.7625 3.4 13.8554 3.40771 13.9336C3.48252 14.6933 4.08353 15.2943 4.84317 15.3691C4.9214 15.3768 5.01427 15.3768 5.2 15.3768C5.38574 15.3768 5.4786 15.3768 5.55683 15.3691C6.31647 15.2943 6.91748 14.6933 6.9923 13.9336C7 13.8554 7 13.7625 7 13.5768V10.1768H7.6C9.01314 10.1768 10.7418 10.9343 12.0754 11.6613C12.8535 12.0854 13.2425 12.2975 13.4973 12.2663C13.7335 12.2373 13.9122 12.1313 14.0507 11.9377C14.2 11.7289 14.2 11.3112 14.2 10.4758V2.67781C14.2 1.84238 14.2 1.42467 14.0507 1.2159C13.9122 1.02231 13.7335 0.916225 13.4973 0.887288C13.2425 0.856082 12.8535 1.06814 12.0754 1.49227C10.7418 2.21927 9.01314 2.97678 7.6 2.97678Z"
                                stroke="#9197A1" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                    </span>{{ __('label.job_alerts') }} </a>
            </li>
            {{-- <li>
                <a href="{{ route('messages.index') }}" class="@if (Route::is('messages.index')) active @endif">
                    <span class="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18"
                            fill="none">
                            <path
                                d="M4.46701 5.76714H8.80078M4.46701 8.80078H11.401M4.46701 14.0013V16.0256C4.46701 16.4875 4.46701 16.7184 4.56169 16.837C4.64402 16.9401 4.76888 17.0001 4.90086 17C5.05262 16.9998 5.23294 16.8556 5.59358 16.5671L7.66119 14.913C8.08356 14.5751 8.29474 14.4061 8.52991 14.286C8.73855 14.1794 8.96063 14.1015 9.19014 14.0544C9.44883 14.0013 9.71928 14.0013 10.2602 14.0013H12.4411C13.8974 14.0013 14.6256 14.0013 15.1818 13.7179C15.6711 13.4686 16.0689 13.0708 16.3182 12.5815C16.6016 12.0253 16.6016 11.2972 16.6016 9.84089V5.16042C16.6016 3.70413 16.6016 2.97599 16.3182 2.41977C16.0689 1.9305 15.6711 1.53271 15.1818 1.28341C14.6256 1 13.8974 1 12.4411 1H5.16042C3.70413 1 2.97599 1 2.41977 1.28341C1.9305 1.53271 1.53271 1.9305 1.28341 2.41977C1 2.97599 1 3.70413 1 5.16042V10.5343C1 11.3403 1 11.7434 1.0886 12.074C1.32904 12.9714 2.02993 13.6723 2.92726 13.9127C3.25793 14.0013 3.66096 14.0013 4.46701 14.0013Z"
                                stroke="#9197A1" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                    </span>{{ __('label.messages') }}</a>
            </li> --}}

            <li>
                <a href="{{ route('messages.index') }}" class="@if (Route::is('messages.index')) active @endif">
                    <span class="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18"
                            fill="none">
                            <path
                                d="M4.46701 5.76714H8.80078M4.46701 8.80078H11.401M4.46701 14.0013V16.0256C4.46701 16.4875 4.46701 16.7184 4.56169 16.837C4.64402 16.9401 4.76888 17.0001 4.90086 17C5.05262 16.9998 5.23294 16.8556 5.59358 16.5671L7.66119 14.913C8.08356 14.5751 8.29474 14.4061 8.52991 14.286C8.73855 14.1794 8.96063 14.1015 9.19014 14.0544C9.44883 14.0013 9.71928 14.0013 10.2602 14.0013H12.4411C13.8974 14.0013 14.6256 14.0013 15.1818 13.7179C15.6711 13.4686 16.0689 13.0708 16.3182 12.5815C16.6016 12.0253 16.6016 11.2972 16.6016 9.84089V5.16042C16.6016 3.70413 16.6016 2.97599 16.3182 2.41977C16.0689 1.9305 15.6711 1.53271 15.1818 1.28341C14.6256 1 13.8974 1 12.4411 1H5.16042C3.70413 1 2.97599 1 2.41977 1.28341C1.9305 1.53271 1.53271 1.9305 1.28341 2.41977C1 2.97599 1 3.70413 1 5.16042V10.5343C1 11.3403 1 11.7434 1.0886 12.074C1.32904 12.9714 2.02993 13.6723 2.92726 13.9127C3.25793 14.0013 3.66096 14.0013 4.46701 14.0013Z"
                                stroke="#9197A1" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>

                    </span> {{ __('label.messages') }} @if (Auth::user()->id)
                        ({{ $notificationUnreadCount }})
                    @endif
                </a>
            </li>
            <li>
                <a href="{{ route('interviews.index') }}"
                    class="@if (Route::is('interviews.index')) active @endif">
                    <span class="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"
                            fill="none">
                            <path
                                d="M3.63647 11.6164C3.63647 11.1878 3.80409 10.7767 4.10244 10.4736C4.40079 10.1705 4.80545 10.0003 5.22738 10.0003C5.64932 10.0003 6.05397 10.1705 6.35233 10.4736C6.65068 10.7767 6.81829 11.1878 6.81829 11.6164V13.2326C6.81829 13.6612 6.65068 14.0723 6.35233 14.3754C6.05397 14.6785 5.64932 14.8488 5.22738 14.8488C4.80545 14.8488 4.40079 14.6785 4.10244 14.3754C3.80409 14.0723 3.63647 13.6612 3.63647 13.2326V11.6164ZM3.63647 11.6164V9.19218C3.63647 7.47765 4.30693 5.83335 5.50034 4.62099C6.69375 3.40863 8.31237 2.72754 10.0001 2.72754C11.6879 2.72754 13.3065 3.40863 14.4999 4.62099C15.6933 5.83335 16.3637 7.47765 16.3637 9.19218V11.6164M16.3637 11.6164C16.3637 11.1878 16.1961 10.7767 15.8978 10.4736C15.5994 10.1705 15.1948 10.0003 14.7728 10.0003C14.3509 10.0003 13.9463 10.1705 13.6479 10.4736C13.3495 10.7767 13.1819 11.1878 13.1819 11.6164V13.2326C13.1819 13.6612 13.3495 14.0723 13.6479 14.3754C13.9463 14.6785 14.3509 14.8488 14.7728 14.8488M16.3637 11.6164V13.2326C16.3637 13.6612 16.1961 14.0723 15.8978 14.3754C15.5994 14.6785 15.1948 14.8488 14.7728 14.8488M14.7728 14.8488C14.7728 15.492 14.2701 16.1085 13.3752 16.5627C12.4796 17.0176 11.2649 17.273 10.0001 17.273"
                                stroke="#9197A1" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                    </span>Interviews </a>
            </li>
            <li>
                <a href="{{ route('userReviews.advanceReviewsByCurrentUser') }}" class="@if (Route::is('userReviews.advanceReviewsByCurrentUser')) active @endif">
                    <span class="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" class="__web-inspector-hide-shortcut__">
                            <path d="M15 22C20 22 22 20 22 15V9C22 4 20 2 15 2H5C3.34315 2 2 3.34315 2 5V8M2.99936 20L4.19936 18.8L5.28934 17.7509M5.28934 17.7509C4.24581 16.7178 3.59936 15.2844 3.59936 13.7C3.59936 10.552 6.15134 8 9.29936 8C12.4474 8 14.9994 10.552 14.9994 13.7C14.9994 16.848 12.4474 19.4 9.29936 19.4C7.73574 19.4 6.31918 18.7704 5.28934 17.7509Z" stroke="#9197A1" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                    </span>{{ __('label.advance_review') }}
                </a>
            </li>

            <li>
                <a href="{{ route('orderHistory.index') }}"
                    class="@if (Route::is('orderHistory.index')) active @endif">
                    <span class="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none">
                            <path d="M3 11.5L4.99941 13.5L7 11.5M4.75488 13C4.71858 12.6717 4.69995 12.338 4.69995 12C4.69995 7.02944 8.72939 3 13.7 3C18.6705 3 22.7 7.02944 22.7 12C22.7 16.9706 18.6705 21 13.7 21C10.8727 21 8.34991 19.6963 6.69995 17.6573M13 7V12L16 14" stroke="#9197A1" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                    </span>{{trans('label.orderHistory')}} </a>
            </li>
            <li>
                <a href="{{ route('resume-builder.index') }}"
                    class="mb-0  @if (Route::is('resume-builder.index')) active @endif">
                    <span class="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none">
                            <path d="M3 11.5L4.99941 13.5L7 11.5M4.75488 13C4.71858 12.6717 4.69995 12.338 4.69995 12C4.69995 7.02944 8.72939 3 13.7 3C18.6705 3 22.7 7.02944 22.7 12C22.7 16.9706 18.6705 21 13.7 21C10.8727 21 8.34991 19.6963 6.69995 17.6573M13 7V12L16 14" stroke="#9197A1" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                    </span>{{trans('label.resumeBuilder')}} </a>
            </li>
            {{-- <li>
                    <a href="{{ route('interviews.index') }}" class="@if (Route::is('interviews.index')) active @endif">
                        <span class="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="20" viewBox="0 0 18 20" fill="none">
                            <path d="M6 8.5L8 10.5L12.5 6M17 19V5.8C17 4.11984 17 3.27976 16.673 2.63803C16.3854 2.07354 15.9265 1.6146 15.362 1.32698C14.7202 1 13.8802 1 12.2 1H5.8C4.11984 1 3.27976 1 2.63803 1.32698C2.07354 1.6146 1.6146 2.07354 1.32698 2.63803C1 3.27976 1 4.11984 1 5.8V19L3.75 17L6.25 19L9 17L11.75 19L14.25 17L17 19Z" stroke="#777777" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        </span>Interviews </a>
                </li> --}}

        </ul>
    </div>
    {{-- @if (\Request::route()->getName() == 'jobseekerDashboard.index')
            <div class="pr-lg-0 upcoming_md_wraper">
                <div class="inner_box_wraper bg-white mb-5 upcoming_interviews_wraper" style="padding: 15px !important">
                    <h3 class="border-0">{{trans('Upcoming Interviews')}}</h3>
                    @if (isset($interviews))
                        @foreach ($interviews as $interview)
                        <div class="main_inner_wraper">
                            <div class="d-flex">
                                <div class="img_wraper">
                                    @if (!empty($job->createdByUser->usersProfile) && $job->createdByUser->usersProfile->logo->count())
                                        @include('vendor.image_upload.display', ['document_type' => config('constants.document_type.image', 0),
                                        'imageModel' => $job->createdByUser->usersProfile, 'class_li' => 'mb-3'])
                                        @else
                                        @include('vendor.image_upload.no_image', ['class_li' => 'mb-3'])
                                    @endif
                                </div>
                                <div class="info">
                                    <h3><a data-mode="edit" data-modal-size="modal-lg" data-title="{{trans('Interview Schedule Detail')}}" data-model="message"
                                            data-url="{{ route('interview.detail',$interview->id) }}"
                                            class="pre-screening"
                                            href="javascript:void(0)" style="color:#333!important">
                                            {{$interview->job_title ?? ''}}
                                        </a></h3>
                                    <p class="company_name"><a href="{{route('job-detail.employer.show', $myjob->createdByUser->slug ?? 0)}}">{{$interview->createdByUser->company_name ?? ''}}</a></p>
                                </div>
                            </div>

                        </div>
                        @endforeach
                    @else
                    {{'N/A'}}
                    @endif
                </div>
            </div>
        @endif --}}
</div>

@push('page_scripts')
    @if (isset($elementExists) && $elementExists)
        <script src="{{ asset('js/jquery.form.js') }}"></script>
        <script>
            $(document).ready(function() {
                $('#frmajaximage').ajaxForm();
            });
        </script>
    @endif
@endpush
