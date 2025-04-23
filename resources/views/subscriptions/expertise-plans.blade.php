@extends('layouts.front')
@section('content')
<div class="plan_package_main_wraper detail_page vc_writing_wraper">
    <div class="job_top_banner bg_frame position-relative mb-0">
        <img src="{{ asset('images/feed_page_banner.png') }}" alt="fea_img" width="100%" class="inner_banner">
        <div class="container">
            <div class="text-center position-relative py-lg-30">
                <h1 class="text-white m-0"> {{ trans('label.professional_cv_writing') }}</h1>
            </div>
        </div>
    </div>
    <div class="container">
        {{-- <div class="package_heading_wraper pt-20 text-center">
            <h1 class="title mb-30">{{ trans('label.career_support_service') }}</h1>
            <div class="description mb-60">{{ trans('message.expertise_page_text') }}</div>
        </div> --}}
        <div class="pt-60 mb-60 border-bottom our_process_main_wraper">
            <h3 class="title">Our Process:</h3>
            <div class="row">
                <div class="col-md-6">
                    <div class="inner_box d-flex mb-50">
                        <div class="icon flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path d="M22 11.0857V12.0057C21.9988 14.1621 21.3005 16.2604 20.0093 17.9875C18.7182 19.7147 16.9033 20.9782 14.8354 21.5896C12.7674 22.201 10.5573 22.1276 8.53447 21.3803C6.51168 20.633 4.78465 19.2518 3.61096 17.4428C2.43727 15.6338 1.87979 13.4938 2.02168 11.342C2.16356 9.19029 2.99721 7.14205 4.39828 5.5028C5.79935 3.86354 7.69279 2.72111 9.79619 2.24587C11.8996 1.77063 14.1003 1.98806 16.07 2.86572M22 4L12 14.01L9 11.01" stroke="#FF7D57" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <div class="content">
                            <h4>Select Your Experience Level and Place Order</h4>
                            <p class="mb-0">Kickstart your professional CV writing journey by selecting your experience level and placing an order. Choose from our range of services tailored to meet your unique career needs.</p>
                        </div>
                    </div>
                    <div class="inner_box d-flex mb-50">
                        <div class="icon flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path d="M22 11.0857V12.0057C21.9988 14.1621 21.3005 16.2604 20.0093 17.9875C18.7182 19.7147 16.9033 20.9782 14.8354 21.5896C12.7674 22.201 10.5573 22.1276 8.53447 21.3803C6.51168 20.633 4.78465 19.2518 3.61096 17.4428C2.43727 15.6338 1.87979 13.4938 2.02168 11.342C2.16356 9.19029 2.99721 7.14205 4.39828 5.5028C5.79935 3.86354 7.69279 2.72111 9.79619 2.24587C11.8996 1.77063 14.1003 1.98806 16.07 2.86572M22 4L12 14.01L9 11.01" stroke="#FF7D57" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <div class="content">
                            <h4>Well-Researched and ATS-Optimized Keywords</h4>
                            <p class="mb-0">Stay ahead of the game with a CV designed for modern recruitment systems. Benefit from thorough research and ATS-optimized keywords to enhance visibility.</p>
                        </div>
                    </div>
                    <div class="inner_box d-flex mb-50">
                        <div class="icon flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path d="M22 11.0857V12.0057C21.9988 14.1621 21.3005 16.2604 20.0093 17.9875C18.7182 19.7147 16.9033 20.9782 14.8354 21.5896C12.7674 22.201 10.5573 22.1276 8.53447 21.3803C6.51168 20.633 4.78465 19.2518 3.61096 17.4428C2.43727 15.6338 1.87979 13.4938 2.02168 11.342C2.16356 9.19029 2.99721 7.14205 4.39828 5.5028C5.79935 3.86354 7.69279 2.72111 9.79619 2.24587C11.8996 1.77063 14.1003 1.98806 16.07 2.86572M22 4L12 14.01L9 11.01" stroke="#FF7D57" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <div class="content">
                            <h4>Multiple Revisions Until You're Fully Satisfied</h4>
                            <p class="mb-0">Your satisfaction is our priority. Enjoy the flexibility of multiple revisions until your CV reflects your unique professional story, precisely the way you envision it.</p>
                        </div>
                    </div>
                    <div class="inner_box d-flex mb-50">
                        <div class="icon flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path d="M22 11.0857V12.0057C21.9988 14.1621 21.3005 16.2604 20.0093 17.9875C18.7182 19.7147 16.9033 20.9782 14.8354 21.5896C12.7674 22.201 10.5573 22.1276 8.53447 21.3803C6.51168 20.633 4.78465 19.2518 3.61096 17.4428C2.43727 15.6338 1.87979 13.4938 2.02168 11.342C2.16356 9.19029 2.99721 7.14205 4.39828 5.5028C5.79935 3.86354 7.69279 2.72111 9.79619 2.24587C11.8996 1.77063 14.1003 1.98806 16.07 2.86572M22 4L12 14.01L9 11.01" stroke="#FF7D57" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <div class="content">
                            <h4>Extended Job Application Support and Strategic Job Hunt Advice</h4>
                            <p class="mb-0">It's not just about the CV. Gain a competitive edge with extended job application support and strategic advice to guide you through a successful job hunt.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="inner_box d-flex mb-50">
                        <div class="icon flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path d="M22 11.0857V12.0057C21.9988 14.1621 21.3005 16.2604 20.0093 17.9875C18.7182 19.7147 16.9033 20.9782 14.8354 21.5896C12.7674 22.201 10.5573 22.1276 8.53447 21.3803C6.51168 20.633 4.78465 19.2518 3.61096 17.4428C2.43727 15.6338 1.87979 13.4938 2.02168 11.342C2.16356 9.19029 2.99721 7.14205 4.39828 5.5028C5.79935 3.86354 7.69279 2.72111 9.79619 2.24587C11.8996 1.77063 14.1003 1.98806 16.07 2.86572M22 4L12 14.01L9 11.01" stroke="#FF7D57" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <div class="content">
                            <h4>Globally Accepted Resume Layout or CV Template</h4>
                            <p class="mb-0">Present yourself professionally with a globally accepted resume layout or CV template. We ensure your document meets international standards.</p>
                        </div>
                    </div>
                    <div class="inner_box d-flex mb-50">
                        <div class="icon flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path d="M22 11.0857V12.0057C21.9988 14.1621 21.3005 16.2604 20.0093 17.9875C18.7182 19.7147 16.9033 20.9782 14.8354 21.5896C12.7674 22.201 10.5573 22.1276 8.53447 21.3803C6.51168 20.633 4.78465 19.2518 3.61096 17.4428C2.43727 15.6338 1.87979 13.4938 2.02168 11.342C2.16356 9.19029 2.99721 7.14205 4.39828 5.5028C5.79935 3.86354 7.69279 2.72111 9.79619 2.24587C11.8996 1.77063 14.1003 1.98806 16.07 2.86572M22 4L12 14.01L9 11.01" stroke="#FF7D57" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <div class="content">
                            <h4>Our Experts Will Get in Touch to Discuss Your Details</h4>
                            <p class="mb-3">Expect a call from our expert team who will reach out to you promptly. We value your individuality, and this detailed phone discussion ensures a personalized touch to your CV.First Draft in 2-3 Days (Express Option Available)</p>
                            <p class="mb-0">Your journey to an impressive CV starts promptly. Receive the first draft within 2-3 days, or choose our express option at checkout for even quicker service.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="cv_services">
            <h3 class="title">CV Writing Service</h3>
            <div class="row mb-40">
                @foreach ($items as $item)
                    {{ Form::open(['route' => "add-to-cart", 'method' => 'post', 'class' => 'col-md-6 col-lg-3 mb-40', 'id' => 'addonForm_'.$item->id]) }}
                        <input type="hidden" name="main_item_price" value={{$item->price}} class="main_item_price">
                        <input type="hidden" name="addOn[]" value={{$item->id}}>
                        <div class="">
                            <div class="plan_inner_box detail_box h-100">
                                <div class="heading">
                                    <h2 class="m-0 text-center">{{$item->title??null}}</h2>
                                </div>
                                <div class="inner_body">
                                    <p class="pb-25 mb-25 border-bottom price">₹ {{$item->price??null}}</p>
                                    <div class="description mb-10">{{$item->description??null}}</div>
                                    @if ($item->addOns)
                                        @foreach ($item->addOns as $addOnOption)
                                            <div class="form-check pl-0 d-flex">
                                                {{ Form::checkbox('addOn[]', $addOnOption['id'], in_array($addOnOption['id'], $selectedAddOns ??[]), ['class' => 'form-check-input addon-checkbox', 'data-price' => $addOnOption['price'], 'id' => 'addon_' . $addOnOption['id']]) }}
                                                <div class="">
                                                    {{ Form::label($addOnOption['title'], $addOnOption['title'], ['class' => 'form-check-label']) }}
                                                    <span class="price d-block">₹ {{ $addOnOption['price'] }}</span>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                                <div class="inner_footer d-flex align-items-center row">
                                    <div class="col-4 text-center">
                                        <span class="price totalPrice">₹ {{$item->price??null}}</span>
                                    </div>
                                    <div class="col-8">
                                        {{-- <a href="{{ route('add-to-cart', $item->id) }}" class="btn btn-primary w-100">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" class="mr-15">
                                            <path d="M4 4H5.05079C5.2487 4 5.34766 4 5.4273 4.03619C5.49748 4.06809 5.55695 4.11938 5.59863 4.18396C5.64592 4.25723 5.65992 4.35466 5.6879 4.54949L6.06867 7.2M6.06867 7.2L6.9149 13.3851C7.02229 14.17 7.07598 14.5625 7.26467 14.8579C7.43094 15.1182 7.66931 15.3252 7.9511 15.4539C8.27089 15.6 8.66917 15.6 9.46574 15.6H16.3504C17.1087 15.6 17.4878 15.6 17.7977 15.4643C18.0708 15.3447 18.3052 15.1519 18.4745 14.9074C18.6665 14.6301 18.7374 14.2597 18.8793 13.519L19.9441 7.95975C19.9941 7.69905 20.019 7.56869 19.9829 7.4668C19.9511 7.37742 19.8885 7.30215 19.8061 7.25441C19.7122 7.2 19.5788 7.2 19.3119 7.2H6.06867ZM10.4359 19.2C10.4359 19.6418 10.0757 20 9.63138 20C9.18708 20 8.8269 19.6418 8.8269 19.2C8.8269 18.7582 9.18708 18.4 9.63138 18.4C10.0757 18.4 10.4359 18.7582 10.4359 19.2ZM16.8717 19.2C16.8717 19.6418 16.5115 20 16.0672 20C15.6229 20 15.2628 19.6418 15.2628 19.2C15.2628 18.7582 15.6229 18.4 16.0672 18.4C16.5115 18.4 16.8717 18.7582 16.8717 19.2Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                        {{ trans('label.add_to_cart') }}</a> --}}
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
@push('page_scripts')
<script>
    $(document).ready(function () {
        $('[id^="addonForm_"]').each(function () {
            var form = $(this);
            var checkboxes = form.find('.addon-checkbox');
            var totalPriceElement = form.find('.totalPrice');
            var mainItemPrice = form.find('.main_item_price').val();

            checkboxes.on('change', function () {
                updateTotalPrice(form);
            });

            function updateTotalPrice() {

                var total = parseFloat(mainItemPrice);;
                checkboxes.each(function () {
                    if ($(this).prop('checked')) {
                        total += parseFloat($(this).data('price'));
                    }
                });

                totalPriceElement.text(total.toFixed(2));
            }
        });
    });
</script>
@endpush

