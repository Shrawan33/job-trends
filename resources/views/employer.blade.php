@extends('layouts.front')
@section('content')
<div class="container my-5">
    <div class="job_top_banner bg_frame position-relative">
        <img src="{{ asset('images/about_banner.png') }}" alt="fea_img" width="100%" class="inner_banner">
        <h1 class="my-3 text-center position-relative text-secondary">{{trans('label.employer')}}</h1>
    </div>
</div>
<div class="container py-lg-2 cms_pages school_main_wraper">
    <h2 class="text-black text-center mb-4">Schools in Jamaica</h2>
    
    <div class="service_wraper row text-center pt-lg-3 pb-lg-5">
        <div class="col-md-4 mb-5 mb-md-0">
            <p class="mb-5">Jamaica has 1010 public schools at the infant, primary, and secondary levels. At the infant level, there are 63 early childhood institutions, also known as infant schools and 427 infant departments that are attached to primary schools. These schools cater to children between the ages of 3 to 6 years, providing early education and preparation for primary school.</p>
            <div class="img_wraper">
                <img src="{{ asset('images/school_1.png') }}" alt="fea_img" width="100%">
            </div>
            <h3>Infant School</h3>
        </div>
        <div class="col-md-4 mb-5 mb-md-0">
            <p class="mb-5">At the primary level, Jamaica has 767 primary schools that offer education to students from Grades 1 to 6 (ages 6-12 years). Primary education is compulsory and forms a critical part of the foundation of a child's academic journey. These schools focus on imparting basic literacy, numeracy, and essential life skills guided by the National Standards Curriculum.</p>
            <div class="img_wraper">
                <img src="{{ asset('images/school_2.png') }}" alt="fea_img" width="100%">
            </div>
            <h3>Primary School</h3>
        </div>
        <div class="col-md-4 mb-5 mb-md-0">
            <p class="mb-5">At the secondary level, Jamaica has 180 public secondary schools, including technical high schools. Secondary education covers Grades 7 to 13 (12-18 years) guided by a pathway policy. Secondary schools in Jamaica provide a broader curriculum, allowing students to specialize in various groups of subjects geared towards their career choices and higher education pursuits.</p>
            <div class="img_wraper">
                <img src="{{ asset('images/school_3.png') }}" alt="fea_img" width="100%">
            </div>
            <h3>Secondary School</h3>
        </div>
    </div>
    
    
    <div class="job_top_banner bg_frame position-relative hiring_wraper mt-5 d-none">
        <img src="{{ asset('images/hiring_banner.png') }}" alt="fea_img" width="100%" class="inner_banner">
        <img src="{{ asset('images/mobile_2_img.png') }}" alt="fea_img" width="100%" class="mobile_img">
        <div class="position-relative py-3 py-md-5 text-center text-md-left">
            <h2 class="mb-3">Have more needs?</h2>
            <p class="text-black mb-4">Consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et<br class="d-none d-lg-block"> dolore magna aliqua. </p>
            <a href="{{route('contact-us')}}" class="btn btn-primary mx-auto mx-md-0">Request a Free Demo</a>
        </div>
    </div>

</div>

@endsection
