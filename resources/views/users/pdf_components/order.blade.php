<div class="container order_detail_main_wraper">
    <h2 class="title_heading mb-30" style="color: #357de8; font-size: 20px; font-weight: 700;">{{ trans('label.customer_details') }}</h2>
    <table width="100%">
        <tr>
            <td width="70%">
                <table width="100%">
                    <tr style="height: 40px;">
                        <th style="text-align: left; color: #838383; font-weight:400;">
                            {{ trans('label.customer_name') }}:</th>
                        <td style="font-weight: 700;">{{ $input->user_info['first_name'] }}
                            {{ $input->user_info['last_name'] }} </td>
                    </tr>
                    <tr style="height: 40px;">
                        <th style="text-align: left; color: #838383; font-weight:400;">{{ trans('label.email') }}:</th>
                        <td>{{ $input->user_info['email'] }}</td>
                    </tr>
                    <tr style="height: 40px;">
                        <th style="text-align: left; color: #838383; font-weight:400;">
                            {{ trans('label.phone_number') }}:</th>
                        <td>{{ $input->user_info['phone_number'] }}</td>
                    </tr>
                    <tr style="height: 40px;">
                        <th style="text-align: left; color: #838383; font-weight:400;">{{ trans('label.location') }}:
                        </th>
                        <td>{{ $input->short_address }}</td>
                    </tr>
                </table>
            </td>
            <td width="30%" style="vertical-align: bottom;">
                <table width="100%">
                    <tr style="height: 50px">
                        <th width="60%" style="text-align: left; color: #838383; font-weight:400; vertical-align: top;">
                            {{ trans('label.order_number') }}:</th>
                        <td style="font-weight: bold;" width="40%">{{ $input->order_number }}</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    {{-- <div class="customer_details_wraper row align-items-end mb-25 pb-lg-3">
        <div class="col-lg-8">
            <div class="row">
                <div class="col-lg-2 col-md-4 pr-0">
                    <p class="title mb-10 mb-lg-24">{{trans('label.customer_name')}}:</p>
                </div>
                <div class="col-lg-4 col-md-8">
                    <p class="info mb-24"><b>{{ $input->user_info['first_name'] }} {{ $input->user_info['last_name'] }} </b></p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-2 col-md-4 pr-0">
                    <p class="title mb-10 mb-lg-24">{{trans('label.email')}}:</p>
                </div>
                <div class="col-lg-4 col-md-8">
                    <p class="info mb-24">{{ $input->user_info['email'] }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-2 col-md-4 pr-0">
                    <p class="title mb-10 mb-lg-24">{{trans('label.phone_number')}}:</p>
                </div>
                <div class="col-lg-4 col-md-8">
                    <p class="info mb-24">{{ $input->user_info['phone_number'] }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-2 col-md-4 pr-0">
                    <p class="title mb-10 mb-lg-24">{{trans('label.location')}}:</p>
                </div>
                <div class="col-lg-4 col-md-8">
                    <p class="info mb-24">{{ $input->short_address }}</p>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="row">
                <div class="col-md-4 col-lg-8 text-lg-right">
                    <p class="title mb-10 mb-lg-24">{{trans('label.order_number')}}:</p>
                </div>
                <div class="col-md-4 text-lg-right">
                    <p class="info mb-24"><b>{{ $input->order_number }}</b></p>
                </div>
            </div>
        </div>
    </div> --}}
    <h2 class="title_heading mb-30" style="color: #357de8; font-size: 20px; font-weight: 700;">{{ trans('label.package_details') }}</h2>
    <div class="table-responsive package_detail_table_wraper">
        <table class="package_detail_table" width="100%">
            <thead>
                <tr>
                    <th width="30%" style="text-align: left;">{{ trans('label.name') }}</th>
                    <th>{{ trans('label.unit_price') }}</th>
                    <th>{{ trans('label.quantity') }}</th>
                    <th align="right" class="text-right">{{ trans('label.total') }}</th>
                </tr>
            </thead>
            <tbody>

                @if ($input)
                    @foreach ($input->item_info as $item)
                        <tr>
                            <td width="30%">{{ $item['title'] ?? '' }}</td>
                            <td class="text-center" style="text-align: center;">₹ {{ $item['price'] ?? '' }}</td>
                            <td class="text-center" style="text-align: center;">{{ $item['quantity'] ?? '' }}</td>
                            <td class="text-secondary text-right" style="text-align: right">₹
                                {{ $item['price'] * $item['quantity'] }}</td>
                        </tr>
                    @endforeach
                @endif

                <tr>
                    <td colspan="4" align="right" class="p-0">
                        <table width="20%">
                            <tr>
                                <td align="right" class="pb-0">{!! trans('label.discount') !!}:</td>
                                <td align="right" class="pb-0 text-secondary">0%</td>
                            </tr>
                            <tr>
                                <td align="right">{!! trans('label.total_price') !!}:</td>
                                <td align="right" class="text-secondary">₹ {{ $input->total_amount }}</td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <h2 class="title_heading mb-30" style="color: #357de8; font-size: 20px; font-weight: 700;">{!! trans('label.additional_information') !!}</h2>
    <div class="pdf_box_wraper position-relative mb-50">




        {{-- <a href="#" class="download_btn">
            <svg xmlns="http://www.w3.org/2000/svg" width="74" height="74" viewBox="0 0 74 74" fill="none">
                <g filter="url(#filter0_d_1018_1129)">
                <circle cx="37" cy="33" r="17" fill="white"/>
                </g>
                <path d="M43.75 39.75H30.25M41.5 32.25L37 36.75M37 36.75L32.5 32.25M37 36.75V26.25" stroke="#838383" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                <defs>
                <filter id="filter0_d_1018_1129" x="0" y="0" width="74" height="74" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                <feFlood flood-opacity="0" result="BackgroundImageFix"/>
                <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha"/>
                <feOffset dy="4"/>
                <feGaussianBlur stdDeviation="10"/>
                <feComposite in2="hardAlpha" operator="out"/>
                <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.15 0"/>
                <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_1018_1129"/>
                <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_1018_1129" result="shape"/>
                </filter>
                </defs>
            </svg>
        </a> --}}
        {{-- <div class="img_box">
            <svg xmlns="http://www.w3.org/2000/svg" width="56" height="56" viewBox="0 0 56 56" fill="none">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M14.3499 0H33.0725L48.9406 16.5397V48.7097C48.9406 52.7396 45.6802 56 41.6642 56H14.3499C10.3199 56 7.05957 52.7396 7.05957 48.7097V7.29033C7.0595 3.26036 10.3199 0 14.3499 0Z" fill="#E5252A"/>
                <path opacity="0.302" fill-rule="evenodd" clip-rule="evenodd" d="M33.0586 0V16.4138H48.9407L33.0586 0Z" fill="white"/>
                <path d="M15.1611 41.7836V31.5547H19.513C20.5904 31.5547 21.444 31.8485 22.0877 32.4502C22.7314 33.0379 23.0532 33.8356 23.0532 34.8291C23.0532 35.8225 22.7314 36.6202 22.0877 37.2079C21.444 37.8096 20.5904 38.1034 19.513 38.1034H17.7778V41.7836H15.1611ZM17.7778 35.8786H19.2191C19.6109 35.8786 19.9188 35.7946 20.1287 35.5987C20.3385 35.4168 20.4506 35.1649 20.4506 34.8291C20.4506 34.4933 20.3386 34.2414 20.1287 34.0595C19.9188 33.8636 19.611 33.7797 19.2191 33.7797H17.7778V35.8786ZM24.1306 41.7836V31.5547H27.7548C28.4685 31.5547 29.1402 31.6526 29.7698 31.8625C30.3995 32.0724 30.9732 32.3663 31.4769 32.7721C31.9807 33.1639 32.3865 33.6956 32.6803 34.3673C32.9602 35.039 33.1142 35.8086 33.1142 36.6761C33.1142 37.5297 32.9603 38.2993 32.6803 38.971C32.3865 39.6426 31.9807 40.1744 31.4769 40.5661C30.9732 40.9719 30.3995 41.2658 29.7698 41.4757C29.1402 41.6856 28.4685 41.7836 27.7548 41.7836H24.1306ZM26.6914 39.5587H27.447C27.8527 39.5587 28.2306 39.5168 28.5804 39.4188C28.9162 39.3208 29.2381 39.1669 29.5459 38.957C29.8398 38.7472 30.0777 38.4532 30.2456 38.0615C30.4135 37.6697 30.4975 37.2079 30.4975 36.6761C30.4975 36.1304 30.4135 35.6686 30.2456 35.2769C30.0777 34.8851 29.8398 34.5912 29.5459 34.3813C29.2381 34.1714 28.9163 34.0175 28.5804 33.9196C28.2306 33.8216 27.8527 33.7796 27.447 33.7796H26.6914V39.5587ZM34.4295 41.7836V31.5547H41.7059V33.7796H37.0462V35.4168H40.7683V37.6277H37.0462V41.7836H34.4295Z" fill="white"/>
            </svg>
        </div> --}}
        @include('order_history.attachments', [
            'order' => $input,
            'width' => '100%',
            'height' => '100%',
        ])
        {{-- <p class="mb-0">Certificate.pdf</p> --}}
    </div>
    <h2 class="title_heading mb-50" style="color: #357de8; font-size: 20px; font-weight: 700; margin-top: 30px;">Comments</h2>
    <p class="comments d-flex mb-30">
        <span style="line-height: normal;">{{ $input->user_info['comment'] }}</span>
    </p>
</div>
