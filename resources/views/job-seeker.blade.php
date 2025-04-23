@extends('layouts.front')
@section('content')
<div class="container my-5">
    <div class="job_top_banner bg_frame position-relative">
        <img src="{{ asset('images/inner_banner.png') }}" alt="fea_img" width="100%" class="inner_banner">
        <h1 class="my-3 text-center position-relative text-secondary">{{trans('label.jobseeker')}}</h1>
    </div>
</div>
<div class="container py-lg-2 cms_pages teachers_main_wraper">
    <div class="quality_wraper">
        <p class="text-left">The education system caters to approximately 23,000 teachers across the infant, primary and secondary levels. Teachers need to have at least a first degree to teach in the education system and will soon be required to pursue licensure in order to continue teaching in the public education system.  Teachers are considered nation builders as they play a crucial role in shaping the future of the country by enabling the gains in knowledge, skills and attitudes of our students. Teachers are dedicated professionals, role models and social entrepreneurs of whom we are immensely proud. </p>
    </div>
    <div class="premium_wraper my-5 pt-lg-5 d-none">
        <div class="row mb-5">
            <div class="col-md-6">
                <h2>Accelerate your job search with Premium Services</h2>
            </div>
            <div class="col-md-6">
                <p class="mb-0 mt-lg-3">Opportunities are out there... but competition is steep. Our badge system encourages our jobseekers to create an outstanding profile to stay competitive amongst others. Fear not, our verification.</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 mb-4 mb-md-0">
                <div class="inner_wraper h-100">
                    <img src="{{ asset('images/resume.png') }}" alt="fea_img">
                    <h3 class="mb-3">Resume Writing</h3>
                    <p class="mb-0">Lorem ipsum dolor sit amet consectetur. Vel sed posuere feugiat vitae dis odio urna tellus. Vitae gravida aliquam mauris mauris. Fusce et fringilla eget mauris augue auctor. Diam penatibus consequat tempor tristique.</p>
                </div>
            </div>
            <div class="col-md-4 mb-4 mb-md-0">
                <div class="inner_wraper h-100">
                    <img src="{{ asset('images/get_access.png') }}" alt="fea_img">
                    <h3 class="mb-3">Get Assessed</h3>
                    <p class="mb-0"> Tincidunt in dui ac libero eu. Augue commodo quis arcu urna. Tempor nibh vulputate ultrices massa tempus. Faucibus condimentum integer ut morbi.</p>
                </div>
            </div>
            <div class="col-md-4 mb-4 mb-md-0">
                <div class="inner_wraper h-100">
                    <img src="{{ asset('images/get_featured.png') }}" alt="fea_img">
                    <h3 class="mb-3">Get Featured</h3>
                    <p class="mb-0">Lorem ipsum dolor sit amet consectetur. Aenean enim nisl auctor mi mi iaculis convallis nec. Massa nunc magnis netus tortor.  Gravida eget bibendum sollicitudin tellus. </p>
                </div>
            </div>
        </div>
    </div>
    <div class="feature_wraper row py-lg-5 align-items-center d-none">
        <div class="col-md-5 order-2 order-md-1">
            <img src="{{ asset('images/feature_emp.png') }}" alt="fea_img" width="100%">
        </div>
        <div class="col-md-7 order-1 order-md-2 pl-xl-5">
            <h2>Other Perks & Behind the Scenes </h2>
            <p class="mb-5">Yes, we are a recruitment platform and we all know what a recruitment platform does - Digital job matching and connecting the right employee with the right School. However, we are putting these behind the scene processes and perks to make sure they are our there and recognised by new visitors!</p>
            <div class="d-flex mb-4">
                <span class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none">
                        <g clip-path="url(#clip0_315_226)">
                        <path d="M13.333 6.66667C13.333 5.95942 13.614 5.28115 14.1141 4.78105C14.6142 4.28095 15.2924 4 15.9997 4C16.7069 4 17.3852 4.28095 17.8853 4.78105C18.3854 5.28115 18.6663 5.95942 18.6663 6.66667C20.1976 7.3907 21.5029 8.51777 22.4424 9.92707C23.3819 11.3364 23.9203 12.9748 23.9997 14.6667V18.6667C24.1 19.4956 24.3936 20.2894 24.8568 20.9842C25.3199 21.6789 25.9398 22.2552 26.6663 22.6667H5.33301C6.05959 22.2552 6.67942 21.6789 7.14259 20.9842C7.60576 20.2894 7.89933 19.4956 7.99967 18.6667V14.6667C8.07909 12.9748 8.61741 11.3364 9.55694 9.92707C10.4965 8.51777 11.8018 7.3907 13.333 6.66667" stroke="#FF9F0E" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M12 22.6667V24C12 25.0609 12.4214 26.0783 13.1716 26.8284C13.9217 27.5786 14.9391 28 16 28C17.0609 28 18.0783 27.5786 18.8284 26.8284C19.5786 26.0783 20 25.0609 20 24V22.6667" stroke="#FF9F0E" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M27.9988 8.96933C27.1242 7.067 25.8542 5.37293 24.2734 4" stroke="#FF9F0E" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M4 8.96933C4.8738 7.06725 6.14287 5.3732 7.72267 4" stroke="#FF9F0E" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
                        </g>
                        <defs>
                        <clipPath id="clip0_315_226">
                        <rect width="32" height="32" fill="white"/>
                        </clipPath>
                        </defs>
                    </svg>
                </span>
                <div class="ml-3">
                    <h4 class="text-secondary mb-3">Stay Up to Date</h4>
                    <p>Get a notification via SMS whenever we have suitable vacancies for you. Get a notification via SMS whenever we have suitable vacancies for you.</p>
                </div>
            </div>
            <div class="d-flex mb-4">
                <span class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none">
                        <g clip-path="url(#clip0_315_236)">
                        <path d="M5.33301 16V8C5.33301 7.29275 5.61396 6.61448 6.11406 6.11438C6.61415 5.61428 7.29243 5.33333 7.99967 5.33333H23.9997C24.7069 5.33333 25.3852 5.61428 25.8853 6.11438C26.3854 6.61448 26.6663 7.29275 26.6663 8V16" stroke="#FF9F0E" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M13.3333 24H4" stroke="#FF9F0E" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M28.0003 24H18.667" stroke="#FF9F0E" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M8 20L4 24L8 28" stroke="#FF9F0E" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M24 20L28 24L24 28" stroke="#FF9F0E" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
                        </g>
                        <defs>
                        <clipPath id="clip0_315_236">
                        <rect width="32" height="32" fill="white"/>
                        </clipPath>
                        </defs>
                    </svg>
                </span>
                <div class="ml-3">
                    <h4 class="text-secondary mb-3">Forget Rejection Letters</h4>
                    <p>Visit your employee dashboard and view your application status real-time. Any responses are also sent via SMS. </p>
                </div>
            </div>
            <div class="d-flex mb-4">
                <span class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none">
                        <g clip-path="url(#clip0_315_247)">
                        <path d="M15.9997 9.33333C17.4724 9.33333 18.6663 8.13943 18.6663 6.66667C18.6663 5.19391 17.4724 4 15.9997 4C14.5269 4 13.333 5.19391 13.333 6.66667C13.333 8.13943 14.5269 9.33333 15.9997 9.33333Z" stroke="#FF9F0E" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M6.66667 28C8.13943 28 9.33333 26.8061 9.33333 25.3333C9.33333 23.8606 8.13943 22.6667 6.66667 22.6667C5.19391 22.6667 4 23.8606 4 25.3333C4 26.8061 5.19391 28 6.66667 28Z" stroke="#FF9F0E" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M25.3337 28C26.8064 28 28.0003 26.8061 28.0003 25.3333C28.0003 23.8606 26.8064 22.6667 25.3337 22.6667C23.8609 22.6667 22.667 23.8606 22.667 25.3333C22.667 26.8061 23.8609 28 25.3337 28Z" stroke="#FF9F0E" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M8.66699 23.3333L16.0003 17.3333L23.3337 23.3333" stroke="#FF9F0E" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M16 9.33333V17.3333" stroke="#FF9F0E" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
                        </g>
                        <defs>
                        <clipPath id="clip0_315_247">
                        <rect width="32" height="32" fill="white"/>
                        </clipPath>
                        </defs>
                    </svg>
                </span>
                <div class="ml-3">
                    <h4 class="text-secondary mb-3">Growing Network of Clients</h4>
                    <p>With a dedicated marketing team, we strive to acquire as much hiring clients as possible by providing efficient and accelerated recruitment services. </p>
                </div>
            </div>
        </div>
    </div>

</div>
<section class="testimonial_wraper teacher_school bg_pattern mt-lg-5" style="background: url({{ asset('images/bg_pattern.png') }}) no-repeat;">
    <div class="text-center mb-5">
        <p class="title_tag font-weight-bold">Testimonials</p>
        <h2 class="main_title mb-0">Our Stories</h2>
    </div>
    <div class="inner_wraper position-relative">
        {{-- <img src="{{ asset('images/qotes.svg') }}" alt="quote_img" class="quote_img top_quote"> --}}
        <div class="slider">
            @foreach($testimonials as $testimonial)
            @include('components.testimonial')
            @endforeach
        </div>
        {{-- <img src="{{ asset('images/qotes_red.svg') }}" alt="quote_img" class="quote_img last_quote"> --}}
    </div>
</section>
@endsection
