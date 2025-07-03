@php
    $analytics = \App\Helpers\SeoHelper::getScript();
@endphp

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    {{-- <title>{{ config('app.name') }}</title> --}}
    <title>{{ $meta['meta_title'] ?? 'JobTrends' }}</title>
    <meta name="description" content="{{ $meta['meta_description'] ?? 'JobTrends' }}">
    <link rel="canonical" href="{{ url()->current() }}" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content= "{{ $meta['meta_title'] ?? 'JobTrends' }}" />
    <meta property="og:description" content="{{ $meta['meta_description'] ?? 'JobTrends' }}" />

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- Favicon icon -->
    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }} "
        type="image/x-icon">
    <link rel="icon" href="{{ asset('images/favicon.png') }} " type="image/x-icon">

    <!-- Theme App css -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('vendor/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/select2/css/select2-bootstrap4.min.css') }}">

    <link rel="stylesheet" href="{{ asset('vendor/date-time-picker/css/datetimepicker.min.css') }}">
    <link rel="preload" href="{{ asset('css/app.css') }}" as="style">
    <link rel="preload" href="{{ asset('js/app.js') }}" as="script">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/toastr/toastr.min.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="{{ asset('css/fonts.css') }}" as="style">
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pikaday/css/pikaday.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/pikaday/pikaday.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>




    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

    @yield('third_party_stylesheets')

    @stack('page_css')

    <!-- Google tag (gtag.js) --> <script async src="https://www.googletagmanager.com/gtag/js?id=G-48W4C2HX3T"> </script> <script> window.dataLayer = window.dataLayer || []; function gtag(){dataLayer.push(arguments);} gtag('js', new Date()); gtag('config', 'G-48W4C2HX3T'); </script>

    <!-- HEAD analytics -->
    {!! $analytics['google_analytics_head'] ?? '' !!}

</head>

<body class="@if (\Route::current()->getName() == 'socialPage') social_page @endif @if (\Route::current()->getName() == 'front.register' || \Route::current()->getName() == 'login' || \Route::current()->getName() == 'forgot_password') login_pages  @endif @if (\Route::current()->getName() == 'home.verfied')home @endif @if (\Route::current()->getName() == 'about-us' || \Route::current()->getName() == 'contact-us' || \Route::current()->getName() == 'subscription.service' || \Route::current()->getName() == 'employer.landing' || \Route::current()->getName() == 'jobseeker.landing') blue_footer  @endif">

    <!-- BODY analytics -->
    {!! $analytics['google_analytics_body'] ?? '' !!}

    @section('class', 'bg-gray')
    @if (\Route::current()->getName() != 'login' && \Route::current()->getName() != 'front.register'  && \Route::current()->getName() != 'forgot_password')
		@include('layouts.front.header')
	@endif
        <div class="clearfix"></div>
        {{-- <div class="container mt-5">@include('flash::message')</div> --}}
        <div class="clearfix"></div>
       <div class="site-content"> @yield('content')</div>
    @if (\Route::current()->getName() != 'login' && \Route::current()->getName() != 'front.register'   && \Route::current()->getName() != 'forgot_password')
		@include('layouts.front.footer')
	@endif
    @include('components.analytics')
    @include('components.instant_chat')
    <!-- Modal -->
    <div class="modal fade " id="globalModal" role="dialog" aria-labelledby="globalModalLabel" aria-hidden="true" tabindex='-1'>
        <div class="modal-dialog modal-lg modal-dialog-centered theme-modal" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title"></h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                            <path d="M16.5 1.5L1.5 16.5M1.5 1.5L16.5 16.5" stroke="#1B2432" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>
                </div>
                <div class="modal-body"></div>
                <div class="modal-footer border-top-0">

                    <!-- FOOTER analytics -->
                    {!! $analytics['google_analytics_footer'] ?? '' !!}

                    <div id="create_another_label" class="d-none flex-content">
                        {!! Form::checkbox('create_another', 1, old('create_another', 0), ['id' => 'create_another', 'label' => trans('label.create_another')]) !!}
                    </div>
                    <div class="d-flex">
                        <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('label.close') }}</button>
                        <button type="button" class="btn btn-primary ml-2" id="save_button">{{__('Save')}}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/slick.min.js') }} "></script>
    <script src="{{ asset('js/common/front.js') }}"></script>
    <script src="{{ asset('vendor/jquery-validation/jquery.validate.min.js') }}"></script>
    {{-- <script src="{{ asset('vendor/jquery-validation/additional-methods.min.js') }}"></script> --}}
    <script src="{{ asset('vendor/toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('vendor/moment/moment.min.js') }}"></script>

    <script src="{{ asset('vendor/date-time-picker/js/date-time-picker.min.js') }}"></script>

    <script src="{{ asset('vendor/select2/js/select2.full.min.js') }}"></script>

    <script src="{{ asset('js/common/layout.js') }}"></script>
    <script src="{{ asset('js/common/general.js') }}"></script>
    <script>
         $(function () {
            initDatePicker()
        });

        function initDatePicker()
        {
            $('.datepicker').datetimepicker({
                format: "{{ config('constants.format.moment_date') }}",
                useCurrent: true
            });

            $('.datetimepicker').datetimepicker({
                format: "{{ config('constants.format.moment_datetime') }}",
                useCurrent: true
            });
        }



    </script>
    @yield('third_party_scripts')

    @stack('page_scripts')
    @if(old('toast_error',false) == true ||  old('toast_success',false) == true)
    <script>
        $(document).ready(function(){
            @if(old('toast_error',false))
            toastr.error('{{old("toast_error")}}');
            @else
            toastr.success('{{old("toast_success")}}');
            @endif
        })
    </script>
    @endif

</body>

</html>
