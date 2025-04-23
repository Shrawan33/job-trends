<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>TM</title>
    <!-- Theme App css -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">


    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.theme.default.min.css') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>


</head>

<body>
    @section('class', 'bg-gray')
    @include('layouts.front.header')
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner home-banner">
            <div class="carousel-item active">
                <img class="d-block w-100 carousel-img" src="{{ asset('img/banner.png') }}" alt="First slide">

                <div class="carousel-caption">
                    <div class="container">
                        <h1 class="font-weight-bold display-4 ">Find your dream jobs
                            <br class="d-none d-sm-block" />
                            with us easily
                        </h1>

                    </div>
                </div>
            </div>


        </div>



    </div>
    @include('components.search.quick_search')
    <section class="py-3 py-sm-5">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="font-weight-bold pb-4 pb-sm-5 mt-3 mb-0">Explore Categories </h2>
                </div>
            </div>
            <div class="row">
                @include('design.jobs.category-job')
                @include('design.jobs.category-job')
                @include('design.jobs.category-job')
                @include('design.jobs.category-job')
                @include('design.jobs.category-job')
                @include('design.jobs.category-job')
                @include('design.jobs.category-job')
                @include('design.jobs.category-job')

            </div>
            <div class="row">
                <div class="col-12 text-center mt-3">
                    <a href="" class="btn btn-link text-body">View All</a>
                </div>
            </div>
        </div>
    </section>
    <section class="bg-gray py-3 py-sm-5">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="font-weight-bold pb-4 pb-sm-5 mt-3 mb-0">Featured Jobs</h2>
                </div>
            </div>
            <div class="row">
                @include('design.jobs.feature-job')
                @include('design.jobs.feature-job')
                @include('design.jobs.feature-job')
                @include('design.jobs.feature-job')
                @include('design.jobs.feature-job')
                @include('design.jobs.feature-job')

            </div>
        </div>
    </section>
    <section class="py-3 py-sm-5">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="font-weight-bold pb-4 pb-sm-5 mt-3 mb-0">Latest Jobs</h2>
                </div>
            </div>
            <div class="row">
                @include('design.jobs.latest-job')
                @include('design.jobs.latest-job')
                @include('design.jobs.latest-job')
                @include('design.jobs.latest-job')
                @include('design.jobs.latest-job')
                @include('design.jobs.latest-job')
            </div>
        </div>
    </section>
    <section class="py-3 py-sm-5 bg-gray ">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="font-weight-bold pb-4 pb-sm-5 mt-3 mb-0">Testimonials</h2>
                </div>
            </div>
            <div class="slider2">
            <div class="col-md-6 col-xl-3 ">
            <div class="plan-box border px-3 text-center">
                <h2 class="h3 mb-3">Trial Plan</h2>
                <h2 class="text-primary sub-h1 font-weight-bold">₹ 00.00</h2>
                <ul class="list-unstyled py-4 text-black">
                    <li class="mb-3">15 days</li>
                    <li class="mb-3"> 5 Profile Unlock</li>
                    <li class="mb-3"> 5 Job Posting</li>
                    <li class="mb-0"> 10 Text Message</li>
                </ul>
                <button class="btn btn-primary">Select</button>
            </div>
        </div>
        <div class="col-md-6 col-xl-3 ">
            <div class="plan-box border px-3 text-center best-plan">
            <div class="ribbon"><span>Best Selling</span></div>
                <h2 class="h3 mb-3">Gold Plan <a href="#" data-toggle="tooltip" title="Hooray!"  class="h6"><i class="fi flaticon-info"></i></a></h2>
                <h2 class="text-primary sub-h1 font-weight-bold">₹ 2499.00</h2>
                <ul class="list-unstyled py-4 text-black">
                    <li class="mb-3">6 Months</li>
                    <li class="mb-3"> 1 Month Grace Period</li>
                    <li class="mb-3"> 50 Profile Unlock / per Month</li>
                    <li class="mb-3"> 5 Job Posting / per Month</li>
                    <li class="mb-0"> 100 Text Message / per Month</li>
                </ul>
                <button class="btn btn-primary">Select</button>
            </div>
        </div>
        <div class="col-md-6 col-xl-3 ">
            <div class="plan-box border px-3 text-center">
                <h2 class="h3 mb-3">Basic Plan</h2>
                <h2 class="text-primary sub-h1 font-weight-bold">₹ 1499.00</h2>
                <ul class="list-unstyled py-4 text-black">
                    <li class="mb-3">3 Months</li>
                    <li class="mb-3"> 15 Days Grace Period</li>
                    <li class="mb-3"> 25 Profile Unlock / per Month</li>
                    <li class="mb-3">50 Text Message / per Month</li>
                    <li class="mb-0"> 3 Job Posting / per Month</li>

                </ul>
                <button class="btn btn-primary">Select</button>
            </div>
        </div>
        <div class="col-md-6 col-xl-3 ">
            <div class="plan-box border px-3 text-center">

                <h2 class="text-primary sub-h2 font-weight-bold mb-0">Enterprise Plan</h2>
                <p class="my-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas varius tortor nibh,</p>
                <button class="btn btn-primary">Contact Sales</button>
            </div>
        </div>
        <div class="col-md-6 col-xl-3 ">
            <div class="plan-box border px-3 text-center">

                <h2 class="text-primary sub-h2 font-weight-bold mb-0">Enterprise Plan</h2>
                <p class="my-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas varius tortor nibh,</p>
                <button class="btn btn-primary">Contact Sales</button>
            </div>
        </div>
            </div>
        </div>

    </section>
    <section class="py-3 py-sm-5 ">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="font-weight-bold pb-4 pb-sm-5 mt-3 mb-0">Blogs</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                   <div class="blog-item p-2">
                   <img src="{{ asset('img/school.png') }} " alt="" class="img-fluid mb-4">
                    <h3 class="font-weight-bold mb-3">Motivational Sayings Ten Great Ones</h3>
                    <p>By Edward Lindgren  <span class="mx-3">| </span>    07 Aug 2021</p>
                   </div>
                </div>
                <div class="col-md-4">
                   <div class="blog-item p-2">
                   <img src="{{ asset('img/school.png') }} " alt="" class="img-fluid mb-4">
                    <h3 class="font-weight-bold mb-3">Motivational Sayings Ten Great Ones</h3>
                    <p>By Edward Lindgren  <span class="mx-3">| </span>    07 Aug 2021</p>
                   </div>
                </div>
                <div class="col-md-4">
                   <div class="blog-item p-2">
                   <img src="{{ asset('img/school.png') }} " alt="" class="img-fluid mb-4">
                    <h3 class="font-weight-bold mb-3">Motivational Sayings Ten Great Ones</h3>
                    <p>By Edward Lindgren  <span class="mx-3">| </span>    07 Aug 2021</p>
                   </div>
                </div>
            </div>
        </div>
    </section>
    @include('layouts.front.footer')
    <script src="{{ asset('vendor/jquery-validation/jquery.validate.min.js') }}"></script>
    {{-- <script src="{{ asset('vendor/jquery-validation/additional-methods.min.js') }}"></script> --}}
    <script src="{{ asset('vendor/toastr/toastr.min.js') }}"></script>
    {{-- <script src="{{ asset('vendor/moment/moment.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('vendor/date-time-picker/js/date-time-picker.min.js') }}"></script> --}}
    <script src="{{ asset('vendor/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('js/slick.min.js') }} "></script>
    <script src="{{ asset('js/common/layout.js') }}"></script>
    <script src="{{ asset('js/common/general.js') }}"></script>
    <script src="{{ asset('js/common/front.js') }}"></script>
</body>

</html>
