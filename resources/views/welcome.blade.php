@extends('layouts.front')
@section('content')
    <div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-ride="carousel" data-interval="3000">
        @include('components.banner')
    </div>
    <div class="banner_top_wraper position-relative">
        <div class="home_main_baneer">
            <img src="{{ asset('images/banner_img.png') }}" class="main_banner_img d-none d-lg-block" alt="banner_img"
                width="80%">
            <svg xmlns="http://www.w3.org/2000/svg" width="263" height="345" viewBox="0 0 263 345" fill="none"
                class="main_banner_img d-lg-none">
                <path
                    d="M194.163 312.773C128.261 294.019 50.1885 287.4 18.8852 226.468C-15.1849 160.151 2.22115 78.614 41.2289 15.0887C79.5058 -47.2462 144.614 -88.6929 217.345 -96.7296C287.699 -104.504 361.317 -80.0357 406.097 -25.2289C446.012 23.6235 427.516 91.0616 422.123 153.899C416.719 216.863 427.633 291.895 375.778 328.035C323.353 364.572 255.639 330.269 194.163 312.773Z"
                    fill="#EFEFEF" />
            </svg>

            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-xl-8 pl-lg-0">
                        <img src="{{ asset('images/Frame 33531.png') }}" alt="banner_img" width="100%" class="d-none">
                        <div class="main_box_wraper">
                            <div class="d-flex align-items-center justify-content-between box_header p-20 p-lg-25">
                                <h2 class="m-0">{{ trans('label.feed') }}</h2>

                                @if (!empty($reviewed_users->count() > 0))
                                    <a
                                        href="{{ route('userReviews.feed') }}">{{ trans('label.home_page_label.view_all_btn') }}</a>
                                @endif
                            </div>
                            <div class="row mx-0">

                                @if ($reviewed_users->count() > 0)
                                    <div class="col-md-5 col-lg-4 border-right left_side px-0">
                                        @include('components.review_to_user_list', [
                                            'reviewed_users' => $reviewed_users,
                                        ])
                                    </div>
                                    @if (!empty($reviewed_users->count() > 0))
                                        <div class="col-md-7 col-lg-8 right_side p-20">
                                            <div class="d-md-none d-flex align-items-center mb-30 go_back_btn">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                                                    viewBox="0 0 30 30" fill="none" class="mr-10">
                                                    <path d="M14.2968 23.4375L5.85945 15L14.2968 6.5625" stroke="#357DE8"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                                    <path d="M7.03065 15L24.1406 15" stroke="#357DE8" stroke-width="2"
                                                        stroke-linecap="round" stroke-linejoin="round" />
                                                </svg> {{ trans('label.back') }}
                                            </div>
                                            <div id="user-review-list">
                                                @foreach ($reviewed_users as $user)
                                                    @if ($loop->first)
                                                        @if ($user->review)
                                                            @include('components.user_basic_reviews', [
                                                                'reviews' => $user->review,
                                                            ])
                                                        @endif
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif
                                @else
                                    <div class="col-md-5 col-lg-4 border-right left_side px-0 d-none d-md-block">
                                        <img src="{{ asset('images/feed_placeholder.png') }}" alt="placeholder_img"
                                            class="feed_placeholder_img">
                                    </div>
                                    <div class="col-md-7 col-lg-8 p-20" id="user-review-list">
                                        <div class="d-flex align-items-center justify-content-center flex-column h-100">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="155" height="140"
                                                viewBox="0 0 155 140" fill="none">
                                                <path
                                                    d="M70.6213 140C109.61 140 141.243 108.646 141.243 70C141.243 31.3542 109.61 0 70.6213 0C31.6325 0 0 31.3542 0 70C0 108.646 31.6325 140 70.6213 140Z"
                                                    fill="url(#paint0_linear_648_1104)" />
                                                <path
                                                    d="M44.1383 20.1542H98.605C103.784 20.1542 108.021 24.325 108.021 29.4875V101.267C108.021 106.4 103.784 110.6 98.605 110.6H44.1383C38.93 110.6 34.7221 106.4 34.7221 101.267V29.4875C34.7221 24.325 38.93 20.1542 44.1383 20.1542Z"
                                                    fill="url(#paint1_linear_648_1104)" />
                                                <path
                                                    d="M44.0794 31.8208H67.7376C69.3266 31.8208 70.6213 33.1042 70.6213 34.6792C70.6213 36.2542 69.3266 37.5375 67.7376 37.5375H44.0794C42.4905 37.5375 41.1957 36.2542 41.1957 34.6792C41.1957 33.1042 42.4905 31.8208 44.0794 31.8208Z"
                                                    fill="black" />
                                                <path
                                                    d="M44.0794 48.0375H97.1631C98.7521 48.0375 100.047 49.3208 100.047 50.8958C100.047 52.4708 98.7521 53.7542 97.1631 53.7542H44.0794C42.4905 53.7542 41.1957 52.4708 41.1957 50.8958C41.1957 49.3208 42.4905 48.0375 44.0794 48.0375Z"
                                                    fill="#D5D5D5" />
                                                <path
                                                    d="M44.0794 64.2542H97.1631C98.7521 64.2542 100.047 65.5375 100.047 67.1125C100.047 68.6875 98.7521 69.9708 97.1631 69.9708H44.0794C42.4905 69.9708 41.1957 68.6875 41.1957 67.1125C41.1957 65.5375 42.4905 64.2542 44.0794 64.2542Z"
                                                    fill="#D5D5D5" />
                                                <path
                                                    d="M44.0794 80.4708H97.1631C98.7521 80.4708 100.047 81.7542 100.047 83.3292C100.047 84.9042 98.7521 86.1875 97.1631 86.1875H44.0794C42.4905 86.1875 41.1957 84.9042 41.1957 83.3292C41.1957 81.7542 42.4905 80.4708 44.0794 80.4708Z"
                                                    fill="#D5D5D5" />
                                                <path
                                                    d="M44.0794 96.6875H97.1631C98.7521 96.6875 100.047 97.9708 100.047 99.5458C100.047 101.121 98.7521 102.404 97.1631 102.404H44.0794C42.4905 102.404 41.1957 101.121 41.1957 99.5458C41.1957 97.9708 42.4905 96.6875 44.0794 96.6875Z"
                                                    fill="#D5D5D5" />
                                                <path
                                                    d="M151.924 10.15H116.555C114.907 10.15 113.583 11.55 113.583 13.2708V30.625C113.583 32.3167 114.907 33.7167 116.555 33.7167H151.924C153.572 33.7167 154.896 32.3167 154.896 30.625V13.2708C154.896 11.55 153.572 10.15 151.924 10.15Z"
                                                    fill="white" />
                                                <path
                                                    d="M122.41 25.6667C124.352 25.6667 125.941 24.0917 125.941 22.1667C125.941 20.2417 124.352 18.6667 122.41 18.6667C120.468 18.6667 118.879 20.2417 118.879 22.1667C118.879 24.0917 120.468 25.6667 122.41 25.6667Z"
                                                    fill="#CCC6D9" />
                                                <path
                                                    d="M134.18 18.6667H145.951C147.893 18.6667 149.482 20.2417 149.482 22.1667C149.482 24.0917 147.893 25.6667 145.951 25.6667H134.18C132.238 25.6667 130.649 24.0917 130.649 22.1667C130.649 20.2417 132.238 18.6667 134.18 18.6667Z"
                                                    fill="#D5D5D5" />
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M54.4961 78.1958C54.4961 58.0708 70.9744 41.7375 91.278 41.7375C111.611 41.7375 128.06 58.0708 128.06 78.1958C128.06 86.0708 125.559 93.3333 121.292 99.3125L144.391 121.158L135.711 131.162L111.758 108.5C105.903 112.379 98.8698 114.654 91.278 114.654C70.9744 114.654 54.4961 98.35 54.4961 78.1958ZM91.5134 47.3375C74.3289 47.3375 60.3812 61.1625 60.3812 78.1958C60.3812 95.2583 74.3289 109.083 91.5134 109.083C108.727 109.083 122.646 95.2583 122.646 78.1958C122.646 61.1625 108.727 47.3375 91.5134 47.3375Z"
                                                    fill="#357DE8" />
                                                <path opacity="0.3"
                                                    d="M91.5134 109.667C109.228 109.667 123.587 95.55 123.587 78.1667C123.587 60.7833 109.228 46.6667 91.5134 46.6667C73.7992 46.6667 59.4396 60.7833 59.4396 78.1667C59.4396 95.55 73.7992 109.667 91.5134 109.667Z"
                                                    fill="white" />
                                                <path
                                                    d="M97.0454 78.1667L104.814 70.4958C105.549 69.7375 105.932 68.7458 105.932 67.6958C105.902 66.6458 105.491 65.6542 104.755 64.925C103.99 64.1667 102.989 63.7583 101.93 63.7583C100.871 63.7292 99.8408 64.1083 99.0757 64.8375L91.278 72.5083L83.5391 64.8375C83.1565 64.4583 82.7151 64.1375 82.2149 63.9333C81.7147 63.7 81.185 63.5833 80.6259 63.5833C80.0963 63.5833 79.5372 63.6708 79.0369 63.875C78.5367 64.0792 78.0953 64.3708 77.6834 64.75C77.3008 65.1292 77.0066 65.5958 76.8006 66.0917C76.5946 66.5875 76.5063 67.1125 76.5063 67.6375C76.5063 68.1917 76.6241 68.7167 76.8595 69.2125C77.0654 69.6792 77.3891 70.1458 77.7716 70.4958L85.5694 78.1667L77.7716 85.8375C77.3891 86.1875 77.0654 86.6542 76.8595 87.1208C76.6241 87.6167 76.5063 88.1417 76.5063 88.6958C76.5063 89.2208 76.5946 89.7458 76.8006 90.2417C77.0066 90.7375 77.3008 91.2042 77.6834 91.5833C78.0953 91.9625 78.5367 92.2542 79.0369 92.4583C79.5372 92.6625 80.0963 92.75 80.6259 92.75C81.185 92.75 81.7147 92.6333 82.2149 92.4C82.7151 92.1958 83.1565 91.875 83.5391 91.4958L91.3074 83.825L99.0757 91.4958C99.8702 92.1667 100.871 92.5167 101.901 92.4875C102.93 92.4583 103.931 92.05 104.667 91.3208C105.402 90.5917 105.814 89.6292 105.844 88.6083C105.873 87.5875 105.52 86.5958 104.814 85.8375L97.0454 78.1667Z"
                                                    fill="black" />
                                                <path
                                                    d="M135.711 131.162L144.391 121.158L145.715 122.412C146.981 123.608 147.746 125.271 147.804 127.079C147.893 128.858 147.304 130.608 146.157 131.921C145.009 133.262 143.391 134.05 141.684 134.137C139.977 134.225 138.3 133.583 137.035 132.387L135.711 131.162Z"
                                                    fill="#357DE8" />
                                                <path
                                                    d="M150.07 86.9167C152.012 86.9167 153.601 88.4917 153.601 90.4167C153.601 92.3417 152.012 93.9167 150.07 93.9167C148.128 93.9167 146.539 92.3417 146.539 90.4167C146.539 88.4917 148.128 86.9167 150.07 86.9167Z"
                                                    fill="#E3E3E3" />
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M16.7137 114.567C17.3316 114.333 18.0084 114.013 18.5086 113.575C19.1266 113.021 19.362 112.35 19.5385 111.621C19.7445 110.688 19.8328 109.696 20.0976 108.763C20.1859 108.413 20.3625 108.267 20.4507 108.208C20.6567 108.063 20.8333 108.033 21.0392 108.063C21.2452 108.063 21.5689 108.15 21.7749 108.558C21.8043 108.617 21.8337 108.704 21.8631 108.821C21.8926 108.908 21.8926 109.171 21.922 109.288C21.9612 109.56 22.0005 109.832 22.0397 110.104C22.1574 111.008 22.2457 111.796 22.6576 112.642C23.1873 113.779 23.7464 114.479 24.482 114.771C25.2177 115.092 26.071 115.033 27.1597 114.8C27.2774 114.761 27.3853 114.732 27.4834 114.712C27.9542 114.625 28.425 114.975 28.5133 115.471C28.631 115.967 28.3073 116.463 27.8365 116.579C27.7385 116.599 27.6404 116.618 27.5423 116.638C26.0416 117.017 24.3349 118.388 23.3344 119.583C23.0107 119.963 22.5694 120.983 22.0986 121.654C21.7749 122.15 21.3923 122.471 21.0687 122.587C20.8627 122.646 20.6567 122.646 20.5096 122.587C20.2938 122.549 20.1172 122.432 19.9799 122.237C19.9211 122.121 19.8328 121.975 19.8034 121.8C19.8034 121.712 19.7739 121.479 19.7739 121.392C19.6857 121.042 19.568 120.721 19.5091 120.371C19.3031 119.554 18.8912 119.058 18.4498 118.388C18.0084 117.746 17.5376 117.338 16.8608 117.017C16.7725 117.017 16.0369 116.813 15.8015 116.725C15.419 116.55 15.2424 116.287 15.1836 116.171C15.0659 115.937 15.0659 115.704 15.0659 115.558C15.1051 115.286 15.2228 115.063 15.419 114.888C15.5367 114.8 15.7132 114.683 15.9486 114.625C16.1546 114.596 16.6254 114.567 16.7137 114.567ZM19.6857 115.004C19.3326 115.325 18.9206 115.587 18.5086 115.821C19.0383 116.2 19.4797 116.667 19.9211 117.279C20.4802 118.096 20.9215 118.738 21.1864 119.642C21.4806 119.117 21.7455 118.592 21.9514 118.358C22.4517 117.746 23.1285 117.104 23.8641 116.55L23.8052 116.521C22.7165 116.083 21.8337 115.15 21.0392 113.487C21 113.41 20.9608 113.332 20.9215 113.254C20.6567 113.896 20.2742 114.479 19.6857 115.004Z"
                                                    fill="#CCC6D9" />
                                                <defs>
                                                    <linearGradient id="paint0_linear_648_1104" x1="-0.971045"
                                                        y1="-22.925" x2="0.474459" y2="224.35"
                                                        gradientUnits="userSpaceOnUse">
                                                        <stop stop-color="#F2F2F2" />
                                                        <stop offset="1" stop-color="#EFEFEF" />
                                                    </linearGradient>
                                                    <linearGradient id="paint1_linear_648_1104" x1="14.595"
                                                        y1="20.1542" x2="14.595" y2="110.6"
                                                        gradientUnits="userSpaceOnUse">
                                                        <stop stop-color="white" />
                                                        <stop offset="0.719" stop-color="#FAFAFA" />
                                                    </linearGradient>
                                                </defs>
                                            </svg>
                                            <p class="mb-0 mt-20 text-black font-weight-bold no_found_text">
                                                {{ trans('label.no_review_available') }}</p>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @guest
        <div class="mb-30 mb-lg-60 mt-lg-100 mt-30 text-center" id="explore_job_section">
            <h2 class="explore_job font-weight-bold f-30 text-primary m-0 d-flex align-items-center justify-content-center">
                {{ __('label.home_page_label.explore_job_trends') }}
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" fill="none"
                    class="ml-20">
                    <rect width="30" height="30" rx="10" fill="#357DE8" />
                    <path d="M10 18L15 13L20 18" stroke="white" stroke-width="1.5" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
            </h2>
        </div>
    @endguest
    @role('jobseeker')
        <div class="mb-30 mb-lg-60 mt-lg-100 mt-30 text-center" id="explore_job_section">
            <h2 class="explore_job font-weight-bold f-30 text-primary m-0 d-flex align-items-center justify-content-center">
                {{ __('label.home_page_label.explore_job_trends') }}
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" fill="none"
                    class="ml-20">
                    <rect width="30" height="30" rx="10" fill="#357DE8" />
                    <path d="M10 18L15 13L20 18" stroke="white" stroke-width="1.5" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
            </h2>
        </div>
    @endrole
    <div class="page_content_main_wraper">
        <div class="container p-0">
            <div class="looking_job_section position-relative p-30 p-lg-80 mb-lg-100 mb-40">
                <img src="{{ asset('images/looking_job.png') }}" class="inner_img" width="100%">
                <div class="row">
                    <div class="col-md-8">
                        <h2 class="text-white font-weight-bold mb-10 mb-md-20">{{ trans('label.find_your_perfect_job') }}
                            {{ trans('label.waiting_here') }}
                        </h2>
                        <p class="text-white mb-40">{{ trans('label.finding_the_right_job') }}</p>
                        @unlessrole('employer')
                            @include('components.search.quick_search')
                        @else
                            @include('components.search.candidate_quick_search')
                        @endunlessrole
                    </div>
                    @unlessrole('employer')
                        <div class="col-md-4 text-right d-none d-lg-block position-relative">
                            <img src="{{ asset('images/job_user.png') }}" class="user_img">
                        </div>
                    @else
                        <div class="col-md-4 text-right d-none d-lg-block position-relative after_login">
                            <img src="{{ asset('images/job_user.png') }}" class="user_img">
                        </div>
                    @endunlessrole
                </div>
            </div>
        </div>

        <div class="container">
            <div class="explore_cat_wraper">
                <div
                    class="d-flex align-items-center justify-content-md-between mb-30 mb-lg-60 title_wraper flex-wrap text-center text-md-left">
                    <h2 class="main_title mb-3 mb-md-0">{{ __('label.home_page_label.category_section_title') }}</h2>
                    <p class="mb-0 text-left">{{ trans('label.home_page_label.category_section_main_title') }}<br
                            class="d-none d-lg-block"> {{ trans('label.home_page_label.career_fast_with_others') }}</p>
                </div>
                {{-- @dD($events) --}}
                <div class="row category_main_wraper mb-30 mb-lg-70">
                    @foreach ($categories as $category)
                        <div class="col-6 col-md-4 col-lg-3 mb-lg-30 mb-15">
                            <div class="inner_wraper position-relative">
                                @if ($category->slug != null)
                                    <a href="{{ route('search-jobs.category.search', ['slug' => $category->slug]) }}">
                                    @else
                                        <a href="#">
                                @endif
                                <div class="img_wraper">
                                    {{-- @dd($category) --}}
                                    @include('vendor.image_upload.display', [
                                        'wrapper_class' => 'img-fluid user-90',
                                        'document_type' => config('constants.document_type.image', 0),
                                        'imageModel' => $category,
                                    ])
                                </div>
                                <h3 class="title">{{ $category->title ?? null }}</h3>
                                {{-- @dd($category->total_jobs_count) --}}
                                {{-- @dd($category) --}}
                                <p class="m-0">
                                    @if ($category->jobs->count() == 0 || $category->jobs->count() == 1)
                                        {{ $category->jobs->count() }} {{ trans('label.opening') }}
                                    @else
                                        {{ $category->jobs->count() }} {{ trans('label.openings') }}
                                    @endif
                                </p>
                                <svg xmlns="http://www.w3.org/2000/svg" width="8" height="12" viewBox="0 0 8 12"
                                    fill="none" class="icon">
                                    <path d="M1 1L6 6L1 11" stroke="#838383" stroke-width="1.5" />
                                </svg>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="container">
            <div class="smart_builder_wraper mb-30 mb-lg-100 position-relative">
                <img src="{{ asset('images/bluebg.png') }}" alt="blue_bg" class="blue_bg">
                <div class="row align-items-center">
                    <div class="col-md-4 text-center order-2 order-md-1">
                        <img src="{{ asset('images/laptopimg.png') }}" alt="blue_bg" class="w-100 pt-md-50">
                    </div>
                    <div class="col-md-8 order-1 order-md-2 text-center text-md-left px-40 py-40 pr-xl-50">
                        <h2 class="text-white main_title mb-20">{{ __('label.get_your_resume_with_smart_builder') }}</h2>
                        <p class="text-white mb-30">{{ trans('label.did_you_know') }}</p>
                        <a href="{{ route('subscription.chatgpt-service-plan') }}"
                            class="btn btn-secondary mx-auto ml-md-0">{{ __('label.get_started') }}
                            <svg xmlns="http://www.w3.org/2000/svg" width="8" height="12" viewBox="0 0 8 12"
                                fill="none" class="mr-0 ml-15">
                                <path d="M1.5 1L6.5 6L1.5 11" stroke="white" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                        </a>
                        {{-- <a href="javascript:void(0)" onclick="showContentModal('', '<div class=\'alert alert-info\' role=\'alert\'>We will bring this feature soon</div>')" class="btn btn-secondary mx-auto ml-md-0" > {{ __('label.get_started') }}
                            <svg xmlns="http://www.w3.org/2000/svg" width="8" height="12" viewBox="0 0 8 12"
                                fill="none" class="mr-0 ml-15">
                                <path d="M1.5 1L6.5 6L1.5 11" stroke="white" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                        </a> --}}



                    </div>
                </div>
            </div>
        </div>

        <div class="feature_job_wraper pt-40 pb-10 py-lg-70 pt-lg-100">
            <div class="container">
                <div
                    class="d-flex align-items-center justify-content-md-between mb-30 mb-lg-60 title_wraper flex-wrap text-center text-md-left">
                    <div>
                        <h2 class="main_title mb-10">{{ __('label.home_page_label.featured_job') }}</h2>
                        <p class="mb-lg-0 mb-22">{{ trans('label.home_page_label.featured_job_popular_companies') }} <span
                                class="font-weight-bold">{{ trans('label.home_page_label.start_applying_now') }}</span>
                        </p>
                    </div>
                    <a href="{{ route('search-jobs.index') }}"
                        class="btn btn-primary mx-auto mr-md-0">{{ trans('label.view_all_jobs') }}</a>
                </div>
                <div class="row related_job_wraper">
                    @foreach ($featured as $job)
                        @include('components.jobs.urgent')
                    @endforeach
                </div>
            </div>
        </div>

        <div class="expert_leader_wraper py-40 pt-lg-100 pb-lg-70 container">
            <h2 class="main_title mb-30 mb-lg-60 text-center">
                {{ trans('label.home_page_label.need_help_from_experts_leaders') }}</h2>
            <div class="row">
                <div class="col-md-6 col-lg-4">
                    <div class="inner_wraper p-15 pb-25 text-center mb-30">
                        <div class="img_wraper mb-25">
                            <img src="{{ asset('images/Rectangle 609.png') }}" alt="banner_img" width="100%">
                        </div>
                        <a href="{{ route('subscription.interview-plan') }}" class="title mb-15 px-xl-30">Quick Real Time
                            Interviews<br class="d-none d-lg-block"> with Industry Experts</a>
                        <p class="mb-0 px-xl-30">{{ trans('message.interview_text') }} </p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="inner_wraper p-15 pb-25 text-center mb-30">
                        <div class="img_wraper mb-25">
                            <img src="{{ asset('images/Rectangle 609 (1).png') }}" alt="your_image" width="100%">
                        </div>
                        <a href="{{ route('career-service') }}"
                            class="title mb-15 px-lg-30">{{ trans('label.career_service') }} </a>
                        <p class="mb-0 px-lg-30">{{ trans('label.unleash_your_full_potential') }}</p>

                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="inner_wraper p-15 pb-25 text-center mb-lg-30">
                        <div class="img_wraper mb-25">
                            <img src="{{ asset('images/Rectangle 609 (2).png') }}" alt="your_image" width="100%">
                        </div>
                        <a href="{{ route('subscription.service') }}"
                            class="title mb-15 px-lg-30">{{ trans('label.career_guidance') }}</a>
                        <p class="mb-0 px-lg-30">{{ trans('label.your_guidebook_to_career_brilliance') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="container mb-50 px-0 px-lg-15">
            <div class="top_recruiters_wraper py-40 py-lg-80 text-center">
                <p class="title text-secondary mb-2">{{ trans('label.home_page_label.all_time_hires') }}</p>
                <h2 class="main_title mb-30 mb-lg-60">{{ trans('label.home_page_label.top_recruiters') }}</h2>
                <div class="row mx-0 logo_wraper px-lg-80 justify-content-center">
                    @foreach ($featured_employers as $user)
                        @include('components.users.featured_employers')
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @if (!Auth::check())
        <div class="offer_min_box">
            <div class="inner_box">
                <div class="text-center">
                    <button type="button" class="border-0 w-100" data-toggle="modal" data-target="#offer_modal">
                        Get Offer Today!
                    </button>
                </div>
            </div>
        </div>
    @endif

    <!-- home page offer modal -->
    <div class="modal home-modal fade" id="offer_modal" tabindex="-1" role="dialog" aria-labelledby="home-modal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25" fill="none">
                        <path d="M12 2.2146C6.49 2.2146 2 6.7849 2 12.3934C2 18.002 6.49 22.5723 12 22.5723C17.51 22.5723 22 18.002 22 12.3934C22 6.7849 17.51 2.2146 12 2.2146ZM15.36 14.7346C15.65 15.0298 15.65 15.5183 15.36 15.8135C15.21 15.9662 15.02 16.0375 14.83 16.0375C14.64 16.0375 14.45 15.9662 14.3 15.8135L12 13.4724L9.7 15.8135C9.55 15.9662 9.36 16.0375 9.17 16.0375C8.98 16.0375 8.79 15.9662 8.64 15.8135C8.35 15.5183 8.35 15.0298 8.64 14.7346L10.94 12.3934L8.64 10.0523C8.35 9.75712 8.35 9.26853 8.64 8.97335C8.93 8.67816 9.41 8.67816 9.7 8.97335L12 11.3145L14.3 8.97335C14.59 8.67816 15.07 8.67816 15.36 8.97335C15.65 9.26853 15.65 9.75712 15.36 10.0523L13.06 12.3934L15.36 14.7346Z" fill="white"/>
                    </svg>
                </button>
                <div class="modal-body">
                    <div class="row mx-0">
                        <div class="col-md-5 mb-30 mb-md-0">
                            <div class="inner_wraper">
                                <div class="heading">
                                    <h2>GET ABSOLUTELY FREE <br class="d-lg-none" />SERVICES WORTH <br class="d-none d-lg-block" /><span>₹3,100!</span></h2>
                                </div>
                                <div class="img_Wraper overflow-hidden mb-30">
                                    <img src="{{ asset('images/offer_img.jpg') }}" alt="your_image" width="100%" class="offer_img">
                                </div>
                                <a href="{{ route('offer-register') }}" class="btn btn-green w-100 text-center rounded-pill text-white text-uppercase">Get Offer Today! </a>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <h4>increase your chances of getting </h4>
                            <h4 class="mb-30">selected by recruiters with:</h4>
                            <div class="d-flex list_items mb-30">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25" fill="none" class="mr-10 flex-shrink-0 mt-5">
                                    <path d="M12 21C17.5 21 22 16.5 22 11C22 5.5 17.5 1 12 1C6.5 1 2 5.5 2 11C2 16.5 6.5 21 12 21Z" stroke="#EF8944" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M7.75 10.9999L10.58 13.8299L16.25 8.16992" stroke="#EF8944" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                <div>
                                    <h5>Free Professional resume writing</h5>
                                    <p>ATS optimized to significantly enhance your appeal to recruiters</p>
                                </div>
                            </div>
                            <div class="d-flex list_items mb-30">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25" fill="none" class="mr-10 flex-shrink-0 mt-5">
                                    <path d="M12 21C17.5 21 22 16.5 22 11C22 5.5 17.5 1 12 1C6.5 1 2 5.5 2 11C2 16.5 6.5 21 12 21Z" stroke="#EF8944" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M7.75 10.9999L10.58 13.8299L16.25 8.16992" stroke="#EF8944" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                <div>
                                    <h5>Free cover letter</h5>
                                    <p>Crafted to capture attention and highlight your passion</p>
                                </div>
                            </div>
                            <div class="d-flex list_items mb-20">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25" fill="none" class="mr-10 flex-shrink-0 mt-5">
                                    <path d="M12 21C17.5 21 22 16.5 22 11C22 5.5 17.5 1 12 1C6.5 1 2 5.5 2 11C2 16.5 6.5 21 12 21Z" stroke="#EF8944" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M7.75 10.9999L10.58 13.8299L16.25 8.16992" stroke="#EF8944" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                <div>
                                    <h5>Free linkedin profile optimization</h5>
                                    <p>Optimize your profile to attract your dream company’s attention</p>
                                </div>
                            </div>
                            <p class="bottom_line text-uppercase">take the first step towards your dream job. register today @299/- on our platform and leverage these free tools, <span>worth ₹3,100!</span></p>
                            <span class="limited_offer">Limited time offer: Act now!</span>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    @if (!Auth::check())
        <script>
            $(document).ready(function(){
                setTimeout(function(){
                    $('#offer_modal').modal('show');
                }, 3000); // 3000 milliseconds = 3 seconds
            });
        </script>
    @endif


@endsection
