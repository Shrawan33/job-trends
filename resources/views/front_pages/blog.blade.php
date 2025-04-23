



@extends('layouts.front')

@if (request()->ajax() == false)
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
@endif

@section('content')
    <div class="container my-5 event_main_wraper">
        <div class="job_top_banner bg_frame position-relative py-30 py-lg-60">
            <img src="{{ asset('images/Frame_blue.png') }}" alt="fea_img" width="100%" class="inner_banner">
            <div class="position-relative">
                <h1 class="mb-4 text-center position-relative text-white">{{ trans('label.blog') }}</h1>
                {{-- <p class="text-white text-center">Lorem ipsum dolor sit amet consectetur. Ac tristique volutpat odio ipsum ullamcorper
                    in mauris est. Pulvinar nunc et eget venenatis scelerisque aliquet. Ut aliquam a ultrices praesent.
                    Facilisis non commodo enim integer sed sed pretium est.</p> --}}
            </div>
        </div>
        <div class="content_pages event_box_wraper">
            <div class="row">
            @foreach($blogs as $blog)
                <div class="col-md-6 col-lg-4 mb-40">
                    <div class="inner_wraper p-15 p-lg-20 h-100">
                        {{-- <div class="img_wraper mb-30">
                            @if(!empty($blog->image))
                                <img src="{{ $blog->image->presigned_url }} " alt="" class="img-fluid mb-4">
                            @else
                                <img src="{{ asset('img/main-logo.svg') }}" alt="" class="img-fluid mb-4">
                            @endif
                        </div> --}}
                        <a class="box_title d-flex align-items-center justify-content-between" href="{{route('blog.detail',$blog->id)}}">
                                {{ $blog->title ?? '' }}
                                <span class="flex-shrink-0"><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22" fill="none">
                                    <path d="M6 16L16 6M16 6H6M16 6V16" stroke="#FF7D57" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg></span>
                        </a>

                        {{-- <h3>{{ $event->event_title }}</h3> --}}
                        <div class="mb-30 box_desc">{!! $blog->small_description ?? '' !!}</div>
                        <div class="box_date d-flex align-items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                <g clip-path="url(#clip0_1455_4036)">
                                  <g filter="url(#filter0_d_1455_4036)">
                                    <path d="M17.5 8.33317H2.5M13.3333 1.6665V4.99984M6.66667 1.6665V4.99984M6.5 18.3332H13.5C14.9001 18.3332 15.6002 18.3332 16.135 18.0607C16.6054 17.821 16.9878 17.4386 17.2275 16.9681C17.5 16.4334 17.5 15.7333 17.5 14.3332V7.33317C17.5 5.93304 17.5 5.23297 17.2275 4.69819C16.9878 4.22779 16.6054 3.84534 16.135 3.60565C15.6002 3.33317 14.9001 3.33317 13.5 3.33317H6.5C5.09987 3.33317 4.3998 3.33317 3.86502 3.60565C3.39462 3.84534 3.01217 4.22779 2.77248 4.69819C2.5 5.23297 2.5 5.93304 2.5 7.33317V14.3332C2.5 15.7333 2.5 16.4334 2.77248 16.9681C3.01217 17.4386 3.39462 17.821 3.86502 18.0607C4.3998 18.3332 5.09987 18.3332 6.5 18.3332Z" stroke="#838383" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" shape-rendering="crispEdges"/>
                                  </g>
                                </g>
                                <defs>
                                  <filter id="filter0_d_1455_4036" x="-2.25" y="0.916504" width="24.5" height="26.1665" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                    <feFlood flood-opacity="0" result="BackgroundImageFix"/>
                                    <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha"/>
                                    <feOffset dy="4"/>
                                    <feGaussianBlur stdDeviation="2"/>
                                    <feComposite in2="hardAlpha" operator="out"/>
                                    <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0"/>
                                    <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_1455_4036"/>
                                    <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_1455_4036" result="shape"/>
                                  </filter>
                                  <clipPath id="clip0_1455_4036">
                                    <rect width="20" height="20" fill="white"/>
                                  </clipPath>
                                </defs>
                            </svg>
                            {{date('d M Y',strtotime($blog->createdDate))??''}}
                        </div>
                    </div>
                </div>


            @endforeach
        </div>
        </div>
    </div>
@endsection
