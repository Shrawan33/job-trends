@extends('layouts.front')


@section('content')

<div class="container">
    <div class="row my-5">
        <div class="col-12">
            <h1 class="h2 font-weight-bold">Select Your Package</h1>
        </div>
    </div>
    <div class="row mb-5 align-items-center">
        <div class="col-md-6 col-xl-3 mb-3">
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
        <div class="col-md-6 col-xl-3 mb-3">
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
        <div class="col-md-6 col-xl-3 mb-3">
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
        <div class="col-md-6 col-xl-3 mb-3">
            <div class="plan-box border px-3 text-center">
               
                <h2 class="text-primary sub-h2 font-weight-bold mb-0">Enterprise Plan</h2>
                <p class="my-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas varius tortor nibh,</p>
                <button class="btn btn-primary">Contact Sales</button>
            </div>
        </div>
    </div>
</div>


@endsection