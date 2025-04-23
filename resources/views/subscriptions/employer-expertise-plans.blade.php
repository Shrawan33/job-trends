@extends('layouts.front')
@section('content')
<div class="plan_package_main_wraper detail_page vc_writing_wraper">
    <div class="job_top_banner bg_frame position-relative mb-0">
        <img src="{{ asset('images/feed_page_banner.png') }}" alt="fea_img" width="100%" class="inner_banner">
        <div class="container">
            <div class="text-center position-relative py-lg-30">
                <h1 class="text-white m-0"> {{ trans('label.package') }}</h1>
            </div>
        </div>
    </div>
    <div class="container">
        <div></div><br>
        <div class="cv_services">
            <h2 class="mb-30 mt-30">{{ trans('label.job_posting_packages') }}</h2>
            <div class="row mb-40 border-bottom pb-10">
                @foreach ($job_posting_packages as $item)

                    {{ Form::open(['route' => "add-to-cart", 'method' => 'post', 'class' => 'col-md-6 col-lg-3 mb-40', 'id' => 'addonForm_'.$item->id]) }}
                        <input type="hidden" name="main_item_price" value={{$item->price}} class="main_item_price">
                        <input type="hidden" name="addOn[]" value={{$item->id}}>
                        <div class="h-100">
                            <div class="plan_inner_box detail_box h-100 d-flex flex-column">
                                <div class="heading">
                                    <h2 class="m-0 text-center">{{$item->title??null}}</h2>
                                </div>
                                <div class="inner_body">
                                    {{-- <p class="pb-25 mb-25 border-bottom price">₹ {{$item->price??null}}</p> --}}
                                    <div class="description mb-10"><span class="font-weight-bold text-black">Profile Views:</span> <span class="font-weight-normal text-black">{{$item->credit_info['credits']['profile'] ?? 0}}</span></div>
                                    <div class="description mb-10"><span class="font-weight-bold text-black">Job Postings:</span> <span class="font-weight-normal text-black">{{$item->credit_info['credits']['job_posts'] ?? 0}}</span></div>
                                    <div class="description mb-10 font-weight-normal text-black">{{$item->description??null}}</div>
                                </div>
                                <div class="inner_footer d-flex align-items-center row mx-0 mt-auto">
                                    <div class="col-4 text-center">
                                        <span class="price totalPrice">₹ {{$item->price??null}}</span>
                                    </div>
                                    <div class="col-8">
                                        {{ Form::submit(trans('label.add_to_cart'), ['class' => 'btn btn-primary w-100']) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    {{ Form::close() }}
                @endforeach
            </div>
            <h2 class="mb-30">{{ trans('label.profile_access_packages') }}</h2>
            <div class="row mb-40">
                @foreach ($profile_access_packages as $item)

                    {{ Form::open(['route' => "add-to-cart", 'method' => 'post', 'class' => 'col-md-6 col-lg-3 mb-40', 'id' => 'addonForm_'.$item->id]) }}
                        <input type="hidden" name="main_item_price" value={{$item->price}} class="main_item_price">
                        <input type="hidden" name="addOn[]" value={{$item->id}}>
                        <div class="h-100">
                            <div class="plan_inner_box detail_box h-100 d-flex flex-column">
                                <div class="heading">
                                    <h2 class="m-0 text-center">{{$item->title??null}}</h2>
                                </div>
                                <div class="inner_body">
                                    {{-- <p class="pb-25 mb-25 border-bottom price">₹ {{$item->price??null}}</p> --}}
                                    <div class="description mb-10"><span class="font-weight-bold text-black">Profile Views:</span> <span class="font-weight-normal text-black">{{$item->credit_info['credits']['profile'] ?? 0}}</span></div>
                                    {{-- <div class="description mb-10"><span class="font-weight-bold text-black">Job Postings:</span> <span class="font-weight-normal text-black">{{$item->credit_info['credits']['job_posts'] ?? 0}}</span></div> --}}
                                    <div class="description mb-10 font-weight-normal text-black">{{$item->description??null}}</div>
                                </div>
                                <div class="inner_footer d-flex align-items-center row mx-0 mt-auto">
                                    <div class="col-4 text-center">
                                        <span class="price totalPrice">₹ {{$item->price??null}}</span>
                                    </div>
                                    <div class="col-8">
                                        {{ Form::submit(trans('label.add_to_cart'), ['class' => 'btn btn-primary w-100']) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    {{ Form::close() }}
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection

