@extends('layouts.front')
@section('content')
<div class="event_main_wraper milatry_wraper">
    <div class="job_top_banner bg_frame position-relative py-30 py-lg-70 mb-60">
        <img src="{{ asset('images/Frame_blue.png') }}" alt="fea_img" width="100%" class="inner_banner">
        <div class="position-relative">
            <h1 class="mb-4 text-center position-relative text-white">{{ trans('label.military_service') }}</h1>
            <p class="text-white text-center">{{ trans('message.military_text') }}</p>
        </div>
    </div>
    <div class="container">
        <div class="row content_box align-items-center mb-50 mb-lg-100">
            <div class="col-md-6 mb-30 mb-md-0">
                <h2 class="heading_title mb-40">{{ trans('label.military_service2') }}</h2>
                <div class="description">{{ trans('message.military_text2') }}</div>
            </div>
            <div class="col-md-6">
                <img src="{{ asset('images/why-job-trends.jpg') }}" alt="fea_img" width="100%" class="content_img">
            </div>
        </div>
    </div>
    <div class="leap_full_section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-4">
                    <div class="plan_package_main_wraper detail_page">
                        @foreach ($items as $item)
                            <div class="plan-box p-20 detail_box p-lg-30 h-100 bg-white">
                                <h2 class="mb-10 font-weight-bold">{{$item->title??null}}</h2>
                                <p class="pb-25 mb-25 border-bottom price">₹ {{$item->price??null}}</p>
                                <div class="description mb-40">{{$item->description??null}}</div>
                                <a href="{{ route('add-item-to-cart', $item->id) }}" class="btn btn-primary w-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" class="mr-15">
                                        <path d="M4 4H5.05079C5.2487 4 5.34766 4 5.4273 4.03619C5.49748 4.06809 5.55695 4.11938 5.59863 4.18396C5.64592 4.25723 5.65992 4.35466 5.6879 4.54949L6.06867 7.2M6.06867 7.2L6.9149 13.3851C7.02229 14.17 7.07598 14.5625 7.26467 14.8579C7.43094 15.1182 7.66931 15.3252 7.9511 15.4539C8.27089 15.6 8.66917 15.6 9.46574 15.6H16.3504C17.1087 15.6 17.4878 15.6 17.7977 15.4643C18.0708 15.3447 18.3052 15.1519 18.4745 14.9074C18.6665 14.6301 18.7374 14.2597 18.8793 13.519L19.9441 7.95975C19.9941 7.69905 20.019 7.56869 19.9829 7.4668C19.9511 7.37742 19.8885 7.30215 19.8061 7.25441C19.7122 7.2 19.5788 7.2 19.3119 7.2H6.06867ZM10.4359 19.2C10.4359 19.6418 10.0757 20 9.63138 20C9.18708 20 8.8269 19.6418 8.8269 19.2C8.8269 18.7582 9.18708 18.4 9.63138 18.4C10.0757 18.4 10.4359 18.7582 10.4359 19.2ZM16.8717 19.2C16.8717 19.6418 16.5115 20 16.0672 20C15.6229 20 15.2628 19.6418 15.2628 19.2C15.2628 18.7582 15.6229 18.4 16.0672 18.4C16.5115 18.4 16.8717 18.7582 16.8717 19.2Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    {{ trans('label.add_to_cart') }}</a>
                                {{-- @include('components.payment.entity', ['package_id' => $item->id, 'amount' => $item->price??0, 'type' => 'plan', 'button' => trans('label.btn_select'), 'btnClass' => 'btn-primary rounded-pill px-5']) --}}
                                {{-- @include('subscriptions.form',['package_id' => $item->id, 'text' => trans('label.btn_select'),'class' => 'px-5']) --}}
                            </div>
                            
                        @endforeach
                    
                    </div>
                </div>
                <div class="col-md-8">
                    <h3 class="m-0 py-50 py-lg-100">{{ trans('message.military_text4') }}</h3>
                </div>
            </div>
            
        </div>
    </div>
    <div class="container my-50 my-lg-100">
        <div class="row content_box align-items-center">
            <div class="col-md-6 mb-30 mb-md-0">
                <img src="{{ asset('images/resume_writing.jpg') }}" alt="fea_img" width="100%" class="content_img">
                
            </div>
            <div class="col-md-6">
                <h2 class="heading_title mb-40">{{ trans('label.military_service3') }}</h2>
                <div class="description">{{ trans('message.military_text3') }}</div>
            </div>
        </div>
    </div>
</div>
    
@endsection
