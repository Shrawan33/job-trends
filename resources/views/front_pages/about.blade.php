@extends('layouts.front')


@section('content')
<div class="about_main_wraper">
    <div class="container">
        <div class="job_top_banner bg_frame position-relative py-60 mb-80">
            {{-- <img src="{{ asset('images/about_banner.png') }}" alt="fea_img" width="100%" class="inner_banner"> --}}
            <h1 class="my-30 text-center position-relative text-primary">About Us</h1>
            <p class="text-center position-relative mb-0 mx-auto">At JobTrendsIndia, we envision a harmonious professional ecosystem, bridging the gap between employers and jobseekers. Our mission is to revolutionize the recruitment landscape by fostering meaningful connections, while championing the importance of work-life balance.</p>
        </div>
        <div class="row statement_section">
            <div class="col-md-6">
                <div class="d-flex mb-50">
                    <div class="icon flex-shrink-0 mr-20 mr-lg-30">
                        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 50 50" fill="none">
                            <rect width="50" height="50" rx="10" fill="#FFF3F0"/>
                            <g clip-path="url(#clip0_1399_2090)">
                            <mask id="mask0_1399_2090" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="10" y="10" width="30" height="30">
                            <path d="M10 10H40V40H10V10Z" fill="white"/>
                            </mask>
                            <g mask="url(#mask0_1399_2090)">
                            <path d="M10.8789 14.4531V10.8789H14.4531" stroke="#FF7D57" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M14.4531 39.1211H10.8789V35.5469" stroke="#FF7D57" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M35.5469 10.8789H39.1211V14.4531" stroke="#FF7D57" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M39.1211 35.5469V39.1211H35.5469" stroke="#FF7D57" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M25 30.2734C22.0921 30.2734 19.7266 27.9079 19.7266 25C19.7266 22.0921 22.0921 19.7266 25 19.7266C27.9079 19.7266 30.2734 22.0921 30.2734 25C30.2734 27.9079 27.9079 30.2734 25 30.2734Z" stroke="#FF7D57" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M26.7578 25C26.7578 25.9708 25.9708 26.7578 25 26.7578C24.0292 26.7578 23.2422 25.9708 23.2422 25C23.2422 24.0292 24.0292 23.2422 25 23.2422C25.9708 23.2422 26.7578 24.0292 26.7578 25Z" stroke="#FF7D57" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M39.1211 25C39.1211 25 32.7665 33.7891 25 33.7891C17.2335 33.7891 10.8789 25 10.8789 25C10.8789 25 17.2335 16.2109 25 16.2109C32.7665 16.2109 39.1211 25 39.1211 25Z" stroke="#FF7D57" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                            </g>
                            </g>
                            <defs>
                            <clipPath id="clip0_1399_2090">
                            <rect width="30" height="30" fill="white" transform="translate(10 10)"/>
                            </clipPath>
                            </defs>
                        </svg>
                    </div>
                    <div class="content">
                        <h2 class="mb-20 mb-lg-30">{{ trans('label.vision_statement') }}</h2>
                        <p class="d-flex mb-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none" class="flex-shrink-0 mr-10 mt-1">
                                <g clip-path="url(#clip0_1399_1848)">
                                  <path d="M18.3333 9.23794V10.0046C18.3323 11.8016 17.7504 13.5502 16.6744 14.9895C15.5985 16.4288 14.0861 17.4817 12.3628 17.9912C10.6395 18.5007 8.79772 18.4395 7.11206 17.8168C5.4264 17.194 3.98721 16.043 3.00913 14.5355C2.03105 13.028 1.56649 11.2447 1.68473 9.45154C1.80297 7.65841 2.49767 5.95155 3.66523 4.5855C4.83279 3.21946 6.41065 2.26743 8.16349 1.8714C9.91633 1.47537 11.7502 1.65655 13.3917 2.38794M18.3333 3.33317L10 11.6748L7.5 9.17484" stroke="#357DE8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </g>
                                <defs>
                                  <clipPath id="clip0_1399_1848">
                                    <rect width="20" height="20" fill="white"/>
                                  </clipPath>
                                </defs>
                            </svg>
                            Empowering Careers, Enriching Lives
                        </p>
                    </div>
                </div>
                <div class="d-flex">
                    <div class="icon flex-shrink-0 mr-20 mr-lg-30">
                        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 50 50" fill="none">
                            <rect width="50" height="50" rx="10" fill="#FFF3F0"/>
                            <g clip-path="url(#clip0_1399_2090)">
                            <mask id="mask0_1399_2090" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="10" y="10" width="30" height="30">
                            <path d="M10 10H40V40H10V10Z" fill="white"/>
                            </mask>
                            <g mask="url(#mask0_1399_2090)">
                            <path d="M10.8789 14.4531V10.8789H14.4531" stroke="#FF7D57" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M14.4531 39.1211H10.8789V35.5469" stroke="#FF7D57" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M35.5469 10.8789H39.1211V14.4531" stroke="#FF7D57" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M39.1211 35.5469V39.1211H35.5469" stroke="#FF7D57" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M25 30.2734C22.0921 30.2734 19.7266 27.9079 19.7266 25C19.7266 22.0921 22.0921 19.7266 25 19.7266C27.9079 19.7266 30.2734 22.0921 30.2734 25C30.2734 27.9079 27.9079 30.2734 25 30.2734Z" stroke="#FF7D57" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M26.7578 25C26.7578 25.9708 25.9708 26.7578 25 26.7578C24.0292 26.7578 23.2422 25.9708 23.2422 25C23.2422 24.0292 24.0292 23.2422 25 23.2422C25.9708 23.2422 26.7578 24.0292 26.7578 25Z" stroke="#FF7D57" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M39.1211 25C39.1211 25 32.7665 33.7891 25 33.7891C17.2335 33.7891 10.8789 25 10.8789 25C10.8789 25 17.2335 16.2109 25 16.2109C32.7665 16.2109 39.1211 25 39.1211 25Z" stroke="#FF7D57" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                            </g>
                            </g>
                            <defs>
                            <clipPath id="clip0_1399_2090">
                            <rect width="30" height="30" fill="white" transform="translate(10 10)"/>
                            </clipPath>
                            </defs>
                        </svg>
                    </div>
                    <div class="content">
                        <h2 class="mb-20 mb-lg-30">{{ trans('label.mission_statement') }}</h2>
                        <p class="mb-15">
                            At JobTrendsIndia, we are dedicated to transforming the recruitment experience. We serve as a conduit between employers and jobseekers, facilitating connections that go beyond the conventional hiring process.
                        </p>
                        <p class="mb-30 mb-md-0">Our commitment extends to two vital pillars:</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <img src="{{ asset('images/vision_missuin.jpg') }}" alt="fea_img" width="100%" class="inner_img">
            </div>
        </div>
    </div>
    <div class="support_section_wraper py-90 pt-lg-100">
        <div class="container">
            <div class="row">
                <div class="col-md-6 inner_box mb-30 mb-md-0">
                    <span class="number mb-30">1</span>
                    <h3 class="mb-30">{{ trans('label.jobseeker_advocacy') }}</h3>
                    <p>We prioritize the well-being and work-life balance of jobseekers, ensuring their professional journey aligns with their personal aspirations. Through our platform, we empower candidates to make informed career decisions, fostering a balance that leads to long-term satisfaction.</p>
                </div>
                <div class="col-md-6 inner_box">
                    <span class="number mb-30">2</span>
                    <h3 class="mb-30">{{ trans('label.hr_community_support') }}</h3>
                    <p>JobTrendsIndia is not just a recruitment platform; we're an ally to HR professionals. By providing real-time employee analytics, highlighting strengths and challenges of jobseekers, and addressing the issue of 'window shopping' candidates, we aim to streamline the recruitment process. This not only saves valuable resources for organizations but also enhances the efficiency of the entire hiring community.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="looking_for_Section my-50 my-lg-100 px-30 px-lg-60 py-30 py-lg-60 position-relative top_section">
            <div class="row align-items-center">
                <div class="col-md-6 left_content">
                    <h2 class="mb-30">Looking for Right Job? <br class="d-none d-lg-block"> Its Waiting Here</h2>
                    <p class="mb-40 mb-md-0">Looking for Right Job? Its Waiting Here</p>
                </div>
                <div class="col-md-6">
                    @unlessrole('employer') 
                            @include('components.search.quick_search_about')
                        @else
                            @include('components.search.candidate_quick_search_about')
                        @endunlessrole
                </div>
                {{-- <div class="vaccancy_img_wraper text-center">
                    <img src="{{ asset('images/job_vaccancy_img.png') }}" alt="fea_img" width="100%" class="vaccancy_img">
                </div> --}}
            </div>
        </div>
        <div class="looking_for_Section mb-50 my-mb-100 px-30 px-lg-60 py-30 py-lg-60 position-relative bottom_employer_section">
            <div class="row align-items-center">
                <div class="col-md-6 left_content">
                    <h2 class="mb-30">Are you an Employer?</h2>
                    <p class="mb-40">Post the job and get candidates.</p>
                    <a href="#" class="btn btn-secondary search_btn">Post a Job Now</a>
                </div>
                <div class="vaccancy_img_wraper text-center">
                    <img src="{{ asset('images/job_vaccancy_img.png') }}" alt="fea_img" width="100%" class="vaccancy_img">
                </div>
            </div>
        </div>
        <div class="why_job_trend_wraper mb-50 mb-lg-100">
            <h2 class="text-center mb-60">{{ trans('label.why_jobtrendsindia') }}</h2>
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h3 class="mb-30">{{ trans('label.holistic_connections') }}</h3>
                    <p class="d-flex mb-30">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none" class="mr-15 flex-shrink-0 mt-1">
                            <g clip-path="url(#clip0_1411_1430)">
                              <path d="M18.3333 9.23843V10.0051C18.3323 11.8021 17.7504 13.5507 16.6744 14.99C15.5985 16.4292 14.0861 17.4822 12.3628 17.9917C10.6395 18.5012 8.79772 18.44 7.11206 17.8172C5.4264 17.1945 3.98721 16.0435 3.00914 14.536C2.03106 13.0285 1.56649 11.2451 1.68473 9.45202C1.80297 7.6589 2.49767 5.95203 3.66523 4.58599C4.8328 3.21994 6.41066 2.26791 8.16349 1.87188C9.91633 1.47585 11.7502 1.65704 13.3917 2.38843M18.3333 3.33366L10 11.6753L7.5 9.17533" stroke="#357DE8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </g>
                            <defs>
                              <clipPath id="clip0_1411_1430">
                                <rect width="20" height="20" fill="white"/>
                              </clipPath>
                            </defs>
                        </svg>
                        We go beyond the traditional hiring process, focusing on meaningful connections that benefit both employers and jobseekers.
                    </p>
                    <p class="d-flex mb-60">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none" class="mr-15 flex-shrink-0 mt-1">
                            <g clip-path="url(#clip0_1411_1430)">
                              <path d="M18.3333 9.23843V10.0051C18.3323 11.8021 17.7504 13.5507 16.6744 14.99C15.5985 16.4292 14.0861 17.4822 12.3628 17.9917C10.6395 18.5012 8.79772 18.44 7.11206 17.8172C5.4264 17.1945 3.98721 16.0435 3.00914 14.536C2.03106 13.0285 1.56649 11.2451 1.68473 9.45202C1.80297 7.6589 2.49767 5.95203 3.66523 4.58599C4.8328 3.21994 6.41066 2.26791 8.16349 1.87188C9.91633 1.47585 11.7502 1.65704 13.3917 2.38843M18.3333 3.33366L10 11.6753L7.5 9.17533" stroke="#357DE8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </g>
                            <defs>
                              <clipPath id="clip0_1411_1430">
                                <rect width="20" height="20" fill="white"/>
                              </clipPath>
                            </defs>
                        </svg>
                        Work-Life Balance: Our commitment to work-life balance ensures that every career move aligns with personal aspirations.
                        
                    </p>
                    <h3 class="mb-30">{{ trans('label.support_for_hr_professionals') }}</h3>
                    <p class="d-flex mb-30">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none" class="mr-15 flex-shrink-0 mt-1">
                            <g clip-path="url(#clip0_1411_1430)">
                              <path d="M18.3333 9.23843V10.0051C18.3323 11.8021 17.7504 13.5507 16.6744 14.99C15.5985 16.4292 14.0861 17.4822 12.3628 17.9917C10.6395 18.5012 8.79772 18.44 7.11206 17.8172C5.4264 17.1945 3.98721 16.0435 3.00914 14.536C2.03106 13.0285 1.56649 11.2451 1.68473 9.45202C1.80297 7.6589 2.49767 5.95203 3.66523 4.58599C4.8328 3.21994 6.41066 2.26791 8.16349 1.87188C9.91633 1.47585 11.7502 1.65704 13.3917 2.38843M18.3333 3.33366L10 11.6753L7.5 9.17533" stroke="#357DE8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </g>
                            <defs>
                              <clipPath id="clip0_1411_1430">
                                <rect width="20" height="20" fill="white"/>
                              </clipPath>
                            </defs>
                        </svg>
                        We provide real-time employee analytics and combat the 'window shopping' trend, making the recruitment process more efficient and cost-effective.
                    </p>
                    <p class="d-flex mb-30">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none" class="mr-15 flex-shrink-0 mt-1">
                            <g clip-path="url(#clip0_1411_1430)">
                              <path d="M18.3333 9.23843V10.0051C18.3323 11.8021 17.7504 13.5507 16.6744 14.99C15.5985 16.4292 14.0861 17.4822 12.3628 17.9917C10.6395 18.5012 8.79772 18.44 7.11206 17.8172C5.4264 17.1945 3.98721 16.0435 3.00914 14.536C2.03106 13.0285 1.56649 11.2451 1.68473 9.45202C1.80297 7.6589 2.49767 5.95203 3.66523 4.58599C4.8328 3.21994 6.41066 2.26791 8.16349 1.87188C9.91633 1.47585 11.7502 1.65704 13.3917 2.38843M18.3333 3.33366L10 11.6753L7.5 9.17533" stroke="#357DE8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </g>
                            <defs>
                              <clipPath id="clip0_1411_1430">
                                <rect width="20" height="20" fill="white"/>
                              </clipPath>
                            </defs>
                        </svg>
                        Join us at JobTrendsIndia in reshaping the future of recruitment, where careers flourish, and lives thrive. 
                    </p>
                    <p class="d-flex mb-30">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none" class="mr-15 flex-shrink-0 mt-1">
                            <g clip-path="url(#clip0_1411_1430)">
                              <path d="M18.3333 9.23843V10.0051C18.3323 11.8021 17.7504 13.5507 16.6744 14.99C15.5985 16.4292 14.0861 17.4822 12.3628 17.9917C10.6395 18.5012 8.79772 18.44 7.11206 17.8172C5.4264 17.1945 3.98721 16.0435 3.00914 14.536C2.03106 13.0285 1.56649 11.2451 1.68473 9.45202C1.80297 7.6589 2.49767 5.95203 3.66523 4.58599C4.8328 3.21994 6.41066 2.26791 8.16349 1.87188C9.91633 1.47585 11.7502 1.65704 13.3917 2.38843M18.3333 3.33366L10 11.6753L7.5 9.17533" stroke="#357DE8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </g>
                            <defs>
                              <clipPath id="clip0_1411_1430">
                                <rect width="20" height="20" fill="white"/>
                              </clipPath>
                            </defs>
                        </svg>
                        We believe in more than just filling positions; we believe in building successful and fulfilling professional journeys.
                    </p>
                </div>
                <div class="col-md-6">
                    <img src="{{ asset('images/why-job-trends.jpg') }}" alt="fea_img" width="100%" class="jobtrend_img">
                </div>
            </div>
        </div>
    </div>
</div>
    
    
    

    

    

    

    {{-- <div class="bg_pattern" style="background: url({{ asset('images/bg_pattern.png') }}) no-repeat;">
    <div class="container">
        <div class="text-center associate_section my-0">
            <p class="title_tag font-weight-bold">{{__('label.home_page_label.category_section_main_title')}}</p>
            <h2 class="main_title">{{__('label.home_page_label.category_section_title')}}</h2>
            <div class="row category_main_wraper">
                @foreach ($categories as $category)
                    @include('components.jobs.category-job')
                @endforeach
            </div>
        </div>
    </div>
</div> --}}


    {{-- <div class="work_step_wraper">
        <div class="container">
            <div class="work_step_content_wraper">
                <h2 class="main_title mb-3 mb-md-40">Contact Us</h2>
            </div>
            <div class="row">
                <div class="col-md-6 col-lg-4 mb-4 mb-lg-0">
                    <div class="inner_wraper">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" width="74" height="74" viewBox="0 0 74 74"
                                fill="none">
                                <circle opacity="0.05" cx="37" cy="37" r="37" fill="#1934BD" />
                                <path
                                    d="M37 38.5C39.4853 38.5 41.5 36.4853 41.5 34C41.5 31.5147 39.4853 29.5 37 29.5C34.5147 29.5 32.5 31.5147 32.5 34C32.5 36.4853 34.5147 38.5 37 38.5Z"
                                    stroke="#357de8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                <path
                                    d="M37 52C43 46 49 40.6274 49 34C49 27.3726 43.6274 22 37 22C30.3726 22 25 27.3726 25 34C25 40.6274 31 46 37 52Z"
                                    stroke="#357de8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>
                        <h3>Location</h3>
                        <p>JobTrends India<br />
                            2-4 National Heroes Circle <br />
                            Kingston 4</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 mb-4 mb-lg-0">
                    <div class="inner_wraper">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" width="74" height="74" viewBox="0 0 74 74"
                                fill="none">
                                <circle opacity="0.05" cx="37" cy="37" r="37" fill="#1934BD" />
                                <path
                                    d="M22 29.5L34.2474 38.0732C35.2391 38.7674 35.735 39.1145 36.2744 39.249C36.7508 39.3677 37.2492 39.3677 37.7256 39.249C38.265 39.1145 38.7609 38.7674 39.7526 38.0732L52 29.5M29.2 49H44.8C47.3202 49 48.5804 49 49.543 48.5095C50.3897 48.0781 51.0781 47.3897 51.5095 46.543C52 45.5804 52 44.3202 52 41.8V32.2C52 29.6798 52 28.4196 51.5095 27.457C51.0781 26.6103 50.3897 25.9219 49.543 25.4905C48.5804 25 47.3202 25 44.8 25H29.2C26.6798 25 25.4196 25 24.457 25.4905C23.6103 25.9219 22.9219 26.6103 22.4905 27.457C22 28.4196 22 29.6798 22 32.2V41.8C22 44.3202 22 45.5804 22.4905 46.543C22.9219 47.3897 23.6103 48.0781 24.457 48.5095C25.4196 49 26.6798 49 29.2 49Z"
                                    stroke="#357de8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>
                        <h3>E-mail</h3>
                        <a href="mailto:communications@moey.gov.jm" class="">communications@moey.gov.jm</a>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 mb-4 mb-lg-0">
                    <div class="inner_wraper">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" width="74" height="74" viewBox="0 0 74 74"
                                fill="none">
                                <circle opacity="0.05" cx="37" cy="37" r="37" fill="#1934BD" />
                                <path
                                    d="M31.4186 32.1487C32.4916 34.3835 33.9543 36.4781 35.8068 38.3305C37.6592 40.1829 39.7538 41.6457 41.9886 42.7187C42.1808 42.8109 42.2769 42.8571 42.3986 42.8926C42.8308 43.0185 43.3615 42.928 43.7275 42.6659C43.8305 42.5922 43.9187 42.5041 44.0949 42.3278C44.6339 41.7889 44.9034 41.5194 45.1744 41.3432C46.1963 40.6787 47.5138 40.6787 48.5357 41.3432C48.8067 41.5194 49.0762 41.7889 49.6152 42.3278L49.9156 42.6283C50.7349 43.4476 51.1446 43.8572 51.3671 44.2972C51.8097 45.1722 51.8097 46.2055 51.3671 47.0805C51.1446 47.5205 50.7349 47.9301 49.9156 48.7494L49.6726 48.9924C48.8561 49.8089 48.4478 50.2172 47.8928 50.529C47.2769 50.875 46.3203 51.1237 45.6139 51.1216C44.9773 51.1197 44.5422 50.9962 43.672 50.7493C38.9955 49.4219 34.5827 46.9175 30.9012 43.2361C27.2197 39.5546 24.7153 35.1418 23.388 30.4653C23.141 29.5951 23.0175 29.16 23.0156 28.5234C23.0135 27.817 23.2623 26.8604 23.6083 26.2445C23.9201 25.6894 24.3283 25.2812 25.1448 24.4647L25.3879 24.2216C26.2072 23.4023 26.6168 22.9927 27.0568 22.7702C27.9318 22.3276 28.9651 22.3276 29.8401 22.7702C30.28 22.9927 30.6897 23.4023 31.509 24.2216L31.8094 24.5221C32.3484 25.061 32.6179 25.3305 32.7941 25.6015C33.4585 26.6235 33.4585 27.941 32.7941 28.9629C32.6179 29.2339 32.3484 29.5034 31.8094 30.0424C31.6332 30.2186 31.5451 30.3067 31.4713 30.4097C31.2092 30.7758 31.1187 31.3065 31.2447 31.7387C31.2802 31.8603 31.3263 31.9564 31.4186 32.1487Z"
                                    stroke="#357de8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>
                        <h3>Phone</h3>
                        <a href="tel:tel:876 612-5700" class="">tel:876 612-5700</a>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}


    {{-- <div class="team_raper">
    <div class="container">
        <p class="title_tag font-weight-bold">Team</p>
        <h2 class="main_title mb-3 mb-md-5">Meet Our Management Team</h2>
        <div class="inner_wraper row mb-5">
            <div class="col-md-3 col-6">
                <div class="single_box position-relative">
                    <img src="{{ asset('images/team_1.png') }}" alt="fea_img">
                    <div class="content">
                        <h3>Cameron Williamson</h3>
                        <p class="mb-0">Head of Technology Operation</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="single_box position-relative">
                    <img src="{{ asset('images/team_2.png') }}" alt="fea_img">
                    <div class="content">
                        <h3>Kathryn Murphy</h3>
                        <p class="mb-0">Head of Technology Operation</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="single_box position-relative">
                    <img src="{{ asset('images/team_4.png') }}" alt="fea_img">
                    <div class="content">
                        <h3>Devon Lane</h3>
                        <p class="mb-0">Head of Technology Operation</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="single_box position-relative">
                    <img src="{{ asset('images/team_3.png') }}" alt="fea_img">
                    <div class="content">
                        <h3>Eleanor Pena</h3>
                        <p class="mb-0">Head of Technology Operation</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> --}}
@endsection
