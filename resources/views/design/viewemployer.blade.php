@extends('layouts.front')


@section('content')


<div class="container position-relative">
    <div class="row pt-md-4 my-5 justify-content-center">
        <div class="report-btn"><a href="javascript:;"
                class="btn btn-circle rounded-circle btn-lg btn-outline-metal"><i class="fi flaticon-flag"></i></a></div>
        <div class="col-12 col-md-10 text-center">
            <img src="{{ asset('img/main-logo.svg') }}" class="mb-4 user-90 rounded-circle">
            <h1 class="font-weight-bold mb-4 text-primary">
                Boon Public School</h1>
            <p>Boon Public School is located at Patna, is one of the popular schools in India. This School is counted
                among the top-rated Schools in Bihar with an excellent academic track record. If you're looking for more
                details regarding examinations schedule, results, application forms, syllabus and admission procedure,
                kindly contact the relevant department of the school.</p>
        </div>
    </div>
</div>
<div class="container border-bottom">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-7">
            <ul class="nav nav-line-tabs nav-justified border-bottom-0" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="info-tab" data-toggle="tab" href="#info" role="tab"
                        aria-controls="info" aria-selected="true">Info</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="gallery-tab" data-toggle="tab" href="#gallery" role="tab"
                        aria-controls="gallery" aria-selected="false">Gallery</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="job-tab" data-toggle="tab" href="#job" role="tab" aria-controls="job"
                        aria-selected="false">Jobs</a>
                </li>

            </ul>

        </div>
    </div>
</div>
<div class="container">
    <div class="tab-content pt-4" id="myTabContent">
        <div class="tab-pane fade show active" id="info" role="tabpanel" aria-labelledby="info-tab">
            <div class="row mt-4 mb-5">
                <div class="col-12 col-md-6">
                    <h5 class="mb-3">Location</h5>
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d12580.931745574242!2d145.04435456189435!3d-37.97169289154851!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6ad646b5d2ba4df7%3A0x4045675218ccd90!2sMelbourne%20VIC%2C%20Australia!5e0!3m2!1sen!2sin!4v1614838305745!5m2!1sen!2sin"
                        width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy"></iframe>

                </div>
                <div class="col-12 col-md-6">
                    <h5 class="mb-3">Video</h5>
                    <iframe width="100%" height="300" src="https://www.youtube.com/embed/yAoLSRbwxL8" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen></iframe>
                </div>
            </div>
        </div>
        <div class="tab-pane fade " id="gallery" role="tabpanel" aria-labelledby="gallery-tab">
            <ul class="list-unstyled row mt-4 mb-5">
                <li class="col-12 mb-4 col-md-6 col-lg-4">
                    <img src="{{ asset('img/school.png') }}" class=" img-fluid">
                </li>
                <li class="col-12 mb-4 col-md-6 col-lg-4">
                    <img src="{{ asset('img/school.png') }}" class=" img-fluid">
                </li>
                <li class="col-12 mb-4 col-md-6 col-lg-4">
                    <img src="{{ asset('img/school.png') }}" class=" img-fluid">
                </li>
                <li class="col-12 mb-4 col-md-6 col-lg-4">
                    <img src="{{ asset('img/school.png') }}" class=" img-fluid">
                </li>
                <li class="col-12 mb-4 col-md-6 col-lg-4">
                    <img src="{{ asset('img/school.png') }}" class=" img-fluid">
                </li>
            </ul>
        </div>
        <div class="tab-pane fade " id="job" role="tabpanel" aria-labelledby="job-tab">
            <div class="row mt-4 mb-5">
                @include('design.jobs.latest-job')
                @include('design.jobs.latest-job')
                @include('design.jobs.latest-job')
                @include('design.jobs.latest-job')
                @include('design.jobs.latest-job')
            </div>
        </div>
    </div>

</div>


@endsection