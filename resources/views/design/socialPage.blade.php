@extends('layouts.front')


@section('content')
<div class="social_page_main_wraper">
    <div class="container">
        <div class="cover_photo position-relative">
            <img src="{{ asset('images/social_cover_image.jpg') }}" alt="cover_image" width="100%">
        </div>
        <div class="user_profile_wraper text-center">
            <div class="profile_photo position-relative">
                <img src="{{ asset('images/social_profile_image.png') }}" alt="profile_image" width="100%">
            </div>
            <h3 class="title">Leslie Alexander</h3>
            <p class="cname">CEO of XYX Company</p>
            <ul class="social_icons m-0 p-0 mb-40 d-flex align-items-center justify-content-center">
                <li>
                    <a href="#" target="_blank">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 40" fill="none">
                            <circle cx="20" cy="20" r="17.5" fill="url(#paint0_linear_1093_4521)"/>
                            <path d="M26.5171 25.3519L27.2945 20.4126H22.4315V17.2087C22.4315 15.8571 23.1096 14.5388 25.2877 14.5388H27.5V10.3337C27.5 10.3337 25.4931 10 23.5753 10C19.5685 10 16.9521 12.3662 16.9521 16.6481V20.4126H12.5V25.3519H16.9521V37.2931C17.8459 37.4299 18.7603 37.5 19.6918 37.5C20.6233 37.5 21.5377 37.4299 22.4315 37.2931V25.3519H26.5171Z" fill="white"/>
                            <defs>
                              <linearGradient id="paint0_linear_1093_4521" x1="20" y1="2.5" x2="20" y2="37.3962" gradientUnits="userSpaceOnUse">
                                <stop stop-color="#18ACFE"/>
                                <stop offset="1" stop-color="#0163E0"/>
                              </linearGradient>
                            </defs>
                        </svg>
                    </a>
                </li>
                <li>
                    <a href="#" target="_blank">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 40" fill="none">
                            <rect x="3" y="3" width="34" height="34" rx="17" fill="#1275B1" stroke="white"/>
                            <path d="M15.7732 12.1152C15.7732 13.2834 14.7606 14.2304 13.5116 14.2304C12.2626 14.2304 11.25 13.2834 11.25 12.1152C11.25 10.947 12.2626 10 13.5116 10C14.7606 10 15.7732 10.947 15.7732 12.1152Z" fill="white"/>
                            <path d="M11.5593 15.7851H15.4253V27.5H11.5593V15.7851Z" fill="white"/>
                            <path d="M21.6495 15.7851H17.7835V27.5H21.6495C21.6495 27.5 21.6495 23.812 21.6495 21.5061C21.6495 20.122 22.1221 18.7319 24.0077 18.7319C26.1388 18.7319 26.1259 20.5432 26.116 21.9464C26.103 23.7806 26.134 25.6523 26.134 27.5H30V21.3171C29.9673 17.3692 28.9385 15.5501 25.5541 15.5501C23.5442 15.5501 22.2984 16.4626 21.6495 17.2881V15.7851Z" fill="white"/>
                        </svg>
                    </a>
                </li>
                <li>
                    <a href="#" target="_blank">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 40" fill="none">
                            <rect x="2.5" y="2.5" width="35" height="35" rx="17.5" fill="url(#paint0_radial_1093_4533)"/>
                            <rect x="2.5" y="2.5" width="35" height="35" rx="17.5" fill="url(#paint1_radial_1093_4533)"/>
                            <rect x="2.5" y="2.5" width="35" height="35" rx="17.5" fill="url(#paint2_radial_1093_4533)"/>
                            <path d="M27.7 13.95C27.7 14.8613 26.9613 15.6 26.05 15.6C25.1387 15.6 24.4 14.8613 24.4 13.95C24.4 13.0387 25.1387 12.3 26.05 12.3C26.9613 12.3 27.7 13.0387 27.7 13.95Z" fill="white"/>
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M20 25.5C23.0376 25.5 25.5 23.0376 25.5 20C25.5 16.9624 23.0376 14.5 20 14.5C16.9624 14.5 14.5 16.9624 14.5 20C14.5 23.0376 16.9624 25.5 20 25.5ZM20 23.3C21.8225 23.3 23.3 21.8225 23.3 20C23.3 18.1775 21.8225 16.7 20 16.7C18.1775 16.7 16.7 18.1775 16.7 20C16.7 21.8225 18.1775 23.3 20 23.3Z" fill="white"/>
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M9 19.56C9 15.8637 9 14.0155 9.71936 12.6037C10.3521 11.3618 11.3618 10.3521 12.6037 9.71936C14.0155 9 15.8637 9 19.56 9H20.44C24.1363 9 25.9845 9 27.3963 9.71936C28.6382 10.3521 29.6479 11.3618 30.2806 12.6037C31 14.0155 31 15.8637 31 19.56V20.44C31 24.1363 31 25.9845 30.2806 27.3963C29.6479 28.6382 28.6382 29.6479 27.3963 30.2806C25.9845 31 24.1363 31 20.44 31H19.56C15.8637 31 14.0155 31 12.6037 30.2806C11.3618 29.6479 10.3521 28.6382 9.71936 27.3963C9 25.9845 9 24.1363 9 20.44V19.56ZM19.56 11.2H20.44C22.3245 11.2 23.6055 11.2017 24.5957 11.2826C25.5602 11.3614 26.0535 11.5043 26.3976 11.6796C27.2255 12.1014 27.8986 12.7745 28.3204 13.6024C28.4957 13.9465 28.6386 14.4398 28.7174 15.4043C28.7983 16.3945 28.8 17.6755 28.8 19.56V20.44C28.8 22.3245 28.7983 23.6055 28.7174 24.5957C28.6386 25.5602 28.4957 26.0535 28.3204 26.3976C27.8986 27.2255 27.2255 27.8986 26.3976 28.3204C26.0535 28.4957 25.5602 28.6386 24.5957 28.7174C23.6055 28.7983 22.3245 28.8 20.44 28.8H19.56C17.6755 28.8 16.3945 28.7983 15.4043 28.7174C14.4398 28.6386 13.9465 28.4957 13.6024 28.3204C12.7745 27.8986 12.1014 27.2255 11.6796 26.3976C11.5043 26.0535 11.3614 25.5602 11.2826 24.5957C11.2017 23.6055 11.2 22.3245 11.2 20.44V19.56C11.2 17.6755 11.2017 16.3945 11.2826 15.4043C11.3614 14.4398 11.5043 13.9465 11.6796 13.6024C12.1014 12.7745 12.7745 12.1014 13.6024 11.6796C13.9465 11.5043 14.4398 11.3614 15.4043 11.2826C16.3945 11.2017 17.6755 11.2 19.56 11.2Z" fill="white"/>
                            <defs>
                              <radialGradient id="paint0_radial_1093_4533" cx="0" cy="0" r="1" gradientUnits="userSpaceOnUse" gradientTransform="translate(15 28.75) rotate(-55.3758) scale(31.8995)">
                                <stop stop-color="#B13589"/>
                                <stop offset="0.79309" stop-color="#C62F94"/>
                                <stop offset="1" stop-color="#8A3AC8"/>
                              </radialGradient>
                              <radialGradient id="paint1_radial_1093_4533" cx="0" cy="0" r="1" gradientUnits="userSpaceOnUse" gradientTransform="translate(13.75 38.75) rotate(-65.1363) scale(28.2428)">
                                <stop stop-color="#E0E8B7"/>
                                <stop offset="0.444662" stop-color="#FB8A2E"/>
                                <stop offset="0.71474" stop-color="#E2425C"/>
                                <stop offset="1" stop-color="#E2425C" stop-opacity="0"/>
                              </radialGradient>
                              <radialGradient id="paint2_radial_1093_4533" cx="0" cy="0" r="1" gradientUnits="userSpaceOnUse" gradientTransform="translate(0.625002 3.75) rotate(-8.1301) scale(48.6136 10.3979)">
                                <stop offset="0.156701" stop-color="#406ADC"/>
                                <stop offset="0.467799" stop-color="#6A45BE"/>
                                <stop offset="1" stop-color="#6A45BE" stop-opacity="0"/>
                              </radialGradient>
                            </defs>
                        </svg>
                    </a>
                </li>
                <li>
                    <a href="#" target="_blank">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 40" fill="none">
                            <path d="M6.71041 30.1231L6.7925 29.8784L6.64057 29.6698C4.66301 26.954 3.5 23.6097 3.5 20C3.5 10.9005 10.8986 3.5 19.9958 3.5H20.0042C29.1013 3.5 36.5 10.9026 36.5 20C36.5 29.0974 29.1013 36.5 20.0042 36.5C16.6479 36.5 13.5369 35.502 10.9283 33.7739L10.7283 33.6415L10.4999 33.7145L4.90573 35.5028L6.71041 30.1231Z" fill="#4CAF50" stroke="white"/>
                            <path d="M29.6425 27.4532C29.2351 28.6272 27.6181 29.6008 26.3283 29.8852C25.4459 30.0769 24.2933 30.2298 20.4134 28.5884C15.4505 26.4903 12.2545 21.3441 12.0054 21.0102C11.7669 20.6763 10 18.2852 10 15.8123C10 13.3394 11.2307 12.1352 11.7268 11.6182C12.1342 11.1939 12.8076 11 13.4535 11C13.6625 11 13.8504 11.0108 14.0193 11.0194C14.5154 11.0409 14.7644 11.0711 15.0916 11.8703C15.4991 12.8719 16.4912 15.3449 16.6094 15.599C16.7298 15.8532 16.8501 16.1979 16.6812 16.5318C16.5229 16.8764 16.3836 17.0294 16.1345 17.3223C15.8854 17.6153 15.6489 17.8393 15.3998 18.1538C15.1719 18.4274 14.9143 18.7204 15.2014 19.2266C15.4885 19.722 16.4807 21.3742 17.9414 22.7012C19.8265 24.4137 21.3549 24.9609 21.9016 25.1935C22.309 25.3658 22.7945 25.3249 23.0922 25.0018C23.4701 24.586 23.9366 23.8967 24.4115 23.2182C24.7493 22.7313 25.1757 22.671 25.6232 22.8434C26.0792 23.0049 28.492 24.222 28.9881 24.474C29.4842 24.7282 29.8114 24.8488 29.9317 25.0621C30.0499 25.2754 30.0499 26.277 29.6425 27.4532Z" fill="#FAFAFA"/>
                        </svg>
                    </a>
                </li>
            </ul>
        </div>
        <div class="content border-top py-40">
            <h3 class="mb-24">{{ trans('label.about_me') }}</h3>
            <p class="mb-20">{{ trans('message.social_page_description1') }}</p>

            <p>{{ trans('message.social_page_description2') }}</p>
        </div>
    </div>
</div>

@endsection
