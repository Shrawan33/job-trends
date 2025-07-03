<footer class="footer_wraper position-relative py-30 border-top">
      <!-- FOOTER analytics -->
      {!! $analytics['google_analytics_footer'] ?? '' !!}
      
    {{-- <img src="{{ asset('images/footer_bg.png') }}" alt="fea_img" width="100%" class="footer_bg_img"> --}}
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-2 mb-40 mb-md-0">
                <a class="footer-logo" href="#">
                    {{-- <img src="{{ asset('images/Logo.png') }}" alt="logo" class="white_logo"> --}}
                    <img src="{{ asset('images/Logo.png') }}" class="footer_logo" alt="footer_logo" height="46px">
                </a>
                {{-- <p class="mb-4" style="color: black;">Education is the process of acquiring knowledge, skills, values, beliefs, and habits. It is the foundation of human development and enables individuals to lead a fulfilling and productive life.</p> --}}
                {{-- {{__('label.footer_label.title')}}</p> --}}
            </div>
            <div class="col-md-10 text-md-right">
                {{-- <h3 style="color: black;">{{__('label.footer_label.quick_links')}}</h3> --}}
                <ul class="p-0 mb-0 top_menu_wraper mb-20">
                    <li ><a class="" href="{{route('blog')}}">{{__('label.career_advice')}}</a></li>
                    <li ><a class="" href="{{ route('career-service') }}">{{__('label.career_services')}}</a></li>
                    {{-- <li ><a class="" href="#">{{__('label.smart_resume_writing')}}</a></li> --}}
                    <li ><a class="" href="{{ route('search-jobs.index') }}">{{__('label.browse_companies')}}</a></li>
                    <li ><a class="" href="{{ route('search-jobs.index') }}">{{__('label.salaries')}}</a></li>
                    <li ><a class="" href="{{ route('events') }}">{{__('label.events')}}</a></li>
                    {{-- <li ><a class="" href="{{route('work-with-us')}}">{{__('label.work_with_us')}}</a></li> --}}
                    <li ><a class="" href="{{route('about-us')}}">{{__('label.about')}}</a></li>
                    <li ><a class="" href="{{route('faq')}}">{{__('Faq')}}</a></li>

                </ul>
                <ul class="p-0 mb-0 bottom_menu_wraper">
                    <li><a class="" href="{{route('privacy-policy')}}">{{__('label.privacy-policy')}}</a></li>
                    <li><a class="" href="{{route('terms-conditions')}}">{{__('label.terms-conditions')}}</a></li>
                    <li><a class="" href="{{route('contact-us')}}">{{__('label.help')}}</a></li>
                </ul>
            </div>
            {{-- <div class="col-md-12 col-lg-3 mb-4 mb-lg-0">
                <h3>Get In Touch</h3>
                <ul class="d-flex flex-column p-0 list-unstyled mb-0">
                    <li><a class="icons" href="mailto:communications@moey.gov.jm">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="12" viewBox="0 0 16 12" fill="none">
                            <path d="M14.3333 10L9.90477 6.00002M6.09525 6.00002L1.6667 10M1.33334 2.66669L6.77662 6.47698C7.2174 6.78553 7.43779 6.9398 7.67752 6.99956C7.88927 7.05234 8.11075 7.05234 8.3225 6.99956C8.56223 6.9398 8.78262 6.78553 9.2234 6.47698L14.6667 2.66669M4.53334 11.3334H11.4667C12.5868 11.3334 13.1468 11.3334 13.5747 11.1154C13.951 10.9236 14.2569 10.6177 14.4487 10.2413C14.6667 9.81351 14.6667 9.25346 14.6667 8.13335V3.86669C14.6667 2.74658 14.6667 2.18653 14.4487 1.75871C14.2569 1.38238 13.951 1.07642 13.5747 0.884674C13.1468 0.666687 12.5868 0.666687 11.4667 0.666687H4.53334C3.41324 0.666687 2.85319 0.666687 2.42536 0.884674C2.04904 1.07642 1.74308 1.38238 1.55133 1.75871C1.33334 2.18653 1.33334 2.74658 1.33334 3.86669V8.13335C1.33334 9.25346 1.33334 9.81351 1.55133 10.2413C1.74308 10.6177 2.04904 10.9236 2.42536 11.1154C2.85319 11.3334 3.41324 11.3334 4.53334 11.3334Z" stroke="#FF9F0E" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        communications@moey.gov.jm</a></li>
                    <li><a class="icons" href="tel:876 612-5700">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                            <path d="M4.51548 5.06246C4.96438 5.99743 5.57632 6.87371 6.3513 7.6487C7.12629 8.42368 8.00257 9.03562 8.93754 9.48452C9.01796 9.52313 9.05817 9.54244 9.10905 9.55727C9.28987 9.60998 9.51191 9.57212 9.66505 9.46247C9.70814 9.43161 9.745 9.39475 9.81873 9.32102C10.0442 9.09553 10.157 8.98279 10.2703 8.90908C10.6979 8.6311 11.2491 8.6311 11.6766 8.90908C11.79 8.98279 11.9027 9.09554 12.1282 9.32102L12.2539 9.44671C12.5967 9.78947 12.768 9.96085 12.8611 10.1449C13.0463 10.511 13.0463 10.9433 12.8611 11.3093C12.768 11.4934 12.5967 11.6648 12.2539 12.0076L12.1522 12.1092C11.8106 12.4508 11.6398 12.6216 11.4076 12.7521C11.15 12.8968 10.7498 13.0009 10.4542 13C10.1879 12.9992 10.0058 12.9475 9.64179 12.8442C7.68534 12.2889 5.83919 11.2412 4.29901 9.70098C2.75883 8.1608 1.71109 6.31466 1.15579 4.35821C1.05246 3.99415 1.0008 3.81213 1.00001 3.54579C0.999126 3.25025 1.1032 2.85005 1.24794 2.59238C1.37839 2.36017 1.54919 2.18937 1.89078 1.84778L1.99245 1.74611C2.33521 1.40335 2.5066 1.23196 2.69066 1.13886C3.05672 0.953712 3.48902 0.953712 3.85508 1.13886C4.03914 1.23196 4.21053 1.40334 4.55329 1.74611L4.67898 1.8718C4.90447 2.09728 5.01721 2.21003 5.09092 2.3234C5.3689 2.75094 5.3689 3.30212 5.09092 3.72967C5.01721 3.84304 4.90447 3.95578 4.67898 4.18127C4.60525 4.255 4.56839 4.29186 4.53753 4.33495C4.42788 4.48809 4.39002 4.71013 4.44273 4.89095C4.45756 4.94183 4.47687 4.98204 4.51548 5.06246Z" stroke="#FF9F0E" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        876 612-5700</a></li>
                    <li><p class="icons address">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                            <path d="M8.00033 8.33337C9.1049 8.33337 10.0003 7.43794 10.0003 6.33337C10.0003 5.2288 9.1049 4.33337 8.00033 4.33337C6.89576 4.33337 6.00033 5.2288 6.00033 6.33337C6.00033 7.43794 6.89576 8.33337 8.00033 8.33337Z" stroke="#FF9F0E" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M8.00033 14.6667C9.33366 12 13.3337 10.2789 13.3337 6.66671C13.3337 3.72119 10.9458 1.33337 8.00033 1.33337C5.05481 1.33337 2.66699 3.72119 2.66699 6.66671C2.66699 10.2789 6.66699 12 8.00033 14.6667Z" stroke="#FF9F0E" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        Ministry of Education and Youth<br class="d-none d-lg-block"><span class="pl-lg-4">2-4 National Heroes Circle</span> <br class="d-none d-lg-block"><span class="pl-lg-4">Kingston 4</span></p></li>
                </ul>
            </div> --}}
            {{-- @if(!auth()->user())
                <div class="col-6 col-lg-2">
                    <h3>{{__('label.footer_label.school_title')}}</h3>
                    <ul class="d-flex flex-column p-0 list-unstyled mb-0">
                        <li><a class="" href="{{route('candidates.index')}}">{{__('label.footer_label.browse_candidates')}}</a></li>
                        <li><a class="" href="{{route('employerJobs.create')}}">{{__('label.footer_label.post_job')}}</a></li>
                        <li><a class="" href="{{route('users.profile')}}">{{__('label.footer_label.company_profile')}}</a></li>
                        <li><a class="" href="{{route('faq')}}">{{__('label.footer_label.job_faqs')}}</a></li>
                    </ul>
                </div>
                <div class="col-6 col-lg-2">
                    <h3>{{__('label.footer_label.teacher_title')}}</h3>
                    <ul class="d-flex flex-column p-0 list-unstyled mb-0">
                        <li><a class="" href="{{route('search-jobs.index')}}">{{__('label.footer_label.browse_jobs')}}</a></li>
                        <li><a class="" href="{{route('jobAlerts.index')}}">{{__('label.footer_label.job_alerts')}}</a></li>
                        <li><a class="" href="{{route('applyJobs.index')}}">{{__('label.footer_label.applied_jobs')}}</a></li>
                        <li><a class="" href="{{route('favoriteJobs.index')}}">{{__('label.footer_label.favorites')}}</a></li>
                    </ul>
                </div>
            @endif
            @role('employer')
                <div class="col-6 col-lg-2">
                    <h3>{{__('label.footer_label.school_title')}}</h3>
                    <ul class="d-flex flex-column p-0 list-unstyled mb-0">
                        <li><a class="" href="{{route('candidates.index')}}">{{__('label.footer_label.browse_candidates')}}</a></li>
                        <li><a class="" href="{{route('employerJobs.create')}}">{{__('label.footer_label.post_job')}}</a></li>
                        <li><a class="" href="{{route('users.profile')}}">{{__('label.footer_label.company_profile')}}</a></li>
                        <li><a class="" href="{{route('faq')}}">{{__('label.footer_label.job_faqs')}}</a></li>
                    </ul>
                </div>
            @endrole
            @role('jobseeker')
                <div class="col-6 col-lg-2">
                    <h3>{{__('label.footer_label.teacher_title')}}</h3>
                    <ul class="d-flex flex-column p-0 list-unstyled mb-0">
                        <li><a class="" href="{{route('search-jobs.index')}}">{{__('label.footer_label.browse_jobs')}}</a></li>
                        <li><a class="" href="{{route('jobAlerts.index')}}">{{__('label.footer_label.job_alerts')}}</a></li>
                        <li><a class="" href="{{route('applyJobs.index')}}">{{__('label.footer_label.applied_jobs')}}</a></li>
                        <li><a class="" href="{{route('favoriteJobs.index')}}">{{__('label.footer_label.favorites')}}</a></li>
                    </ul>
                </div>
            @endrole --}}
        </div>
    </div>
    {{-- <div class="fotter_bottom position-relative">
        <div class="text-center">
            ©<?php echo date("Y"); ?> <a href="{{ route('home.verfied') }}" class="font-weight-medium">{{__('label.footer_label.Jamaica')}}</a>
            {{__('label.footer_label.all_right_reserved')}}
        </div>
    </div> --}}

</footer>

