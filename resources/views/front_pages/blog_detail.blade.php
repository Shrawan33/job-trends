@extends('layouts.front')
@if (request()->ajax() == false)
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
@endif
@section('content')
<div class="evenet_detail_wraper">
    <div class="job_top_banner bg_frame position-relative py-30 py-lg-60 pb-100 pb-lg-100 mb-0">
        <img src="{{ asset('images/detail_frame_blue.jpg') }}" alt="fea_img" width="100%" class="inner_banner">
            <div class="position-relative text-center container">
                <div class="date text-white d-flex align-items-center justify-content-center mb-25">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                        <path d="M17.5 8.33366H2.5M13.3333 1.66699V5.00033M6.66667 1.66699V5.00033M6.5 18.3337H13.5C14.9001 18.3337 15.6002 18.3337 16.135 18.0612C16.6054 17.8215 16.9878 17.439 17.2275 16.9686C17.5 16.4339 17.5 15.7338 17.5 14.3337V7.33366C17.5 5.93353 17.5 5.23346 17.2275 4.69868C16.9878 4.22828 16.6054 3.84583 16.135 3.60614C15.6002 3.33366 14.9001 3.33366 13.5 3.33366H6.5C5.09987 3.33366 4.3998 3.33366 3.86502 3.60614C3.39462 3.84583 3.01217 4.22828 2.77248 4.69868C2.5 5.23346 2.5 5.93353 2.5 7.33366V14.3337C2.5 15.7338 2.5 16.4339 2.77248 16.9686C3.01217 17.439 3.39462 17.8215 3.86502 18.0612C4.3998 18.3337 5.09987 18.3337 6.5 18.3337Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                      </svg>
                      {{date('d M Y',strtotime($blog->createdDate))??''}}
                </div>
                <h1 class="mb-4 text-white">{{ $blog->title }}</h1>
                <p class="text-white mb-50">{!! $blog->small_description !!}</p>
            </div>
    </div>
        <div class="content_details_wraper mb-40">
            <div class="container">
                <div class="img_wraper banner_top_img mb-60">
                    @if(!empty($blog->image))
                                <img src="{{ $blog->image->presigned_url }} " alt="" class="img-fluid mb-4">
                            @else
                                {{-- <img src="{{ asset('img/main-logo.svg') }}" alt="" class="img-fluid mb-4"> --}}
                            @endif
                </div>
                <div class="content_detail_box">
                    <div class="desc">
                        {!! $blog->description !!}
                    </div>
                </div>
            </div>
        </div>

</div>
@endsection



