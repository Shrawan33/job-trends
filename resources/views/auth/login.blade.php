@extends('layouts.front')

@section('content')
    <div class="login-page single_login_wraper">
        <div class="container-fluid p-0">
            <div class="row mx-0">
                <div class="col-lg-7 col-md-6 col-12 p-0">
                    <img src="{{ asset('images/login-banner.jpg') }}" alt="login-banner" width="100%" class="login-bg">
                </div>
                <div class="col-lg-5 col-md-6 col-12 p-3 p-lg-5">
                    <div class="login-page-content login_max-width">
                        <div class="container p-0">
                            <div class="mkj-logo d-flex align-items-center justify-content-between mb-30">
                                <a class="navbar-brand" href="{{ route('home.verfied') }}">
                                    <img src="{{ asset('images/Logo.png') }}" alt="logo" class="white_logo"
                                        height="40px">
                                </a>
                                <div class="back-home-page-btn">
                                    <a href="{{ route('home.verfied') }}"
                                        class="btn btn-link px-0">{{ trans('label.back_to_home') }}</a>
                                </div>
                            </div>
                            @if ($sms_access)
                                <ul class="nav nav-line-tabs nav-justified" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link {{ empty(old('phone_number')) ? 'active' : '' }}" id="email-tab"
                                            data-toggle="tab" href="#email" role="tab" aria-controls="email"
                                            aria-selected="true">
                                            {{ trans('label.email') }}
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {{ !empty(old('phone_number')) ? 'active' : '' }}"
                                            id="mobile-tab" data-toggle="tab" href="#mobile" role="tab"
                                            aria-controls="mobile" aria-selected="false">
                                            {{ trans('label.mobile') }}
                                        </a>
                                    </li>
                                </ul>
                            @endif

                            <div class="login-form">
                                <div class="mkj-form-text">
                                    <h2 class="text-left mb-3">{{ trans('label.sign_in') }}</h2>
                                    <p class="mb-40">{{ trans('label.enter_your_credentials') }}</p>
                                    <div class="col-12 text-center p-lg-0">
                                        @include('components.social', [
                                            'socialTitle' => trans('label.login_with'),
                                        ])
                                    </div>
                                    <form method="post" action="{{ url('/login') }}">
                                        @csrf

                                        <div class="tab-content" id="myTabContent">
                                            <div class="tab-pane fade {{ empty(old('phone_number')) ? 'show active' : '' }}"
                                                id="email" role="tabpanel" aria-labelledby="email-tab">
                                                <div class="form-group mb-30 mt-30 email_field">
                                                    <label for="">Email address</label>
                                                    <input type="email" name="email" value="{{ old('email') }}"
                                                        placeholder="{{ trans('label.email_address') }}"
                                                        class="form-control @error('email') is-invalid @enderror">
                                                    @error('email')
                                                        <span class="error invalid-feedback">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group mb-20">
                                                    <div class="d-flex align-items-center justify-content-between mb-10">
                                                        <label for="password"
                                                            class="mb-0">{{ trans('label.password') }}</label>
                                                        <a href="{{ route('forgot_password') }}"
                                                            class="forget_pass">{{ trans('label.forgot_pass') }}</a>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <input type="password"
                                                                placeholder="{{ trans('label.password') }}"
                                                                class="form-control password" id="password" name="password"
                                                                required>
                                                                <button type="button" id="togglePassword" class="password-icon">
                                                                    <div>
                                                                        <svg id="svg1" xmlns="http://www.w3.org/2000/svg"
                                                                            width="24" height="24" viewBox="0 0 24 24"
                                                                            fill="none">
                                                                            <path
                                                                                d="M2.42012 12.7132C2.28394 12.4975 2.21584 12.3897 2.17772 12.2234C2.14909 12.0985 2.14909 11.9015 2.17772 11.7766C2.21584 11.6103 2.28394 11.5025 2.42012 11.2868C3.54553 9.50484 6.8954 5 12.0004 5C17.1054 5 20.4553 9.50484 21.5807 11.2868C21.7169 11.5025 21.785 11.6103 21.8231 11.7766C21.8517 11.9015 21.8517 12.0985 21.8231 12.2234C21.785 12.3897 21.7169 12.4975 21.5807 12.7132C20.4553 14.4952 17.1054 19 12.0004 19C6.8954 19 3.54553 14.4952 2.42012 12.7132Z"
                                                                                stroke="black" stroke-width="1.5"
                                                                                stroke-linecap="round" stroke-linejoin="round" />
                                                                            <path
                                                                                d="M12.0004 15C13.6573 15 15.0004 13.6569 15.0004 12C15.0004 10.3431 13.6573 9 12.0004 9C10.3435 9 9.0004 10.3431 9.0004 12C9.0004 13.6569 10.3435 15 12.0004 15Z"
                                                                                stroke="black" stroke-width="1.5"
                                                                                stroke-linecap="round" stroke-linejoin="round" />
                                                                        </svg>
                                                                        <svg id="svg2" xmlns="http://www.w3.org/2000/svg"
                                                                            width="24" height="24" viewBox="0 0 24 24"
                                                                            fill="none" style="display:none">
                                                                            <path
                                                                                d="M10.7429 5.09232C11.1494 5.03223 11.5686 5 12.0004 5C17.1054 5 20.4553 9.50484 21.5807 11.2868C21.7169 11.5025 21.785 11.6103 21.8231 11.7767C21.8518 11.9016 21.8517 12.0987 21.8231 12.2236C21.7849 12.3899 21.7164 12.4985 21.5792 12.7156C21.2793 13.1901 20.8222 13.8571 20.2165 14.5805M6.72432 6.71504C4.56225 8.1817 3.09445 10.2194 2.42111 11.2853C2.28428 11.5019 2.21587 11.6102 2.17774 11.7765C2.1491 11.9014 2.14909 12.0984 2.17771 12.2234C2.21583 12.3897 2.28393 12.4975 2.42013 12.7132C3.54554 14.4952 6.89541 19 12.0004 19C14.0588 19 15.8319 18.2676 17.2888 17.2766M3.00042 3L21.0004 21M9.8791 9.87868C9.3362 10.4216 9.00042 11.1716 9.00042 12C9.00042 13.6569 10.3436 15 12.0004 15C12.8288 15 13.5788 14.6642 14.1217 14.1213"
                                                                                stroke="black" stroke-width="1.5"
                                                                                stroke-linecap="round" stroke-linejoin="round" />
                                                                        </svg>
                                                                    </div>
                                                                </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="icheck-primary ">
                                                        <input type="checkbox" id="remember">
                                                        <label for="remember">{{ trans('label.remember_me') }}</label>
                                                    </div>
                                                </div>
                                                <div class="form-group mb-20">
                                                    <div id="captcha_element">

                                                    </div>
                                                    @error('g-recaptcha-response')
                                                        <div class="text-danger">
                                                            <span class="error small">{{ $message }}</span>
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="row align-items-center">
                                                    <div class="col">
                                                        <button type="submit" class="btn btn-primary w-100"
                                                            id="submit_otp_button">
                                                            {{ empty(old('phone_number')) ? trans('label.login_btn') : trans('label.get_otp') }}
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="Sign-up-here-div text-center mt-20">
                                                    <p class="text-black">{{ trans('label.not_a_member') }} <a
                                                            href="{{ route('front.register', ['type' => 'jobseeker']) }}"
                                                            class="">{{ trans('label.sign_up_here') }}</a></p>
                                                </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    @endsection

    @push('page_scripts')
        <script>
            $(document).ready(function() {
                $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
                    let target = $(e.target).attr("href") // activated tab

                    if (target == '#email') {
                        $('#submit_otp_button').text("{{ trans('label.login_btn') }}");
                    } else {
                        $('#submit_otp_button').text("{{ trans('label.get_otp') }}");
                    }

                    $(target).find(':input').each(function() {
                        $(this).val(null);
                    });
                });
            });
        </script>

        @include('auth.verification.captcha_script')
    @endpush
