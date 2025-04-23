@extends('layouts.front')

@section('content')
    <div class="login-page register_main_wraper">
        <div class="container-fluid p-0">
            <div class="row mx-0">
                <div class="col-md-7 col-12 mb-md-0 mb-5 p-0 img_wraper">
                    {{-- <img src="{{ asset('images/register_img.png') }}" alt="register-banner" width="100%" class="login-bg"> --}}
                    <img src="{{ asset('images/login-banner.jpg') }}" alt="register-banner" width="100%" class="login-bg">
                </div>
                <div class="col-md-5 col-12 p-4 p-lg-5 right_side_wraper">
                    <div class="mkj-logo mb-25 d-flex align-items-center justify-content-between">
                        <a class="navbar-brand" href="{{ route('home.verfied') }}">
                            <img src="{{ asset('images/Logo.png') }}" alt="logo" class="" height="40px">
                        </a>
                        <div class="back-home-page-btn">
                            <a href="{{ route('home.verfied') }}" class="btn btn-link px-0">{{ trans('label.back_to_home') }}</a>
                        </div>
                    </div>
                    <div class="login-form">
                        <div class="mkj-form-text">
                            <h2 class="text-left mb-3">{{ trans('label.register_with_us') }}</h2>
                            <p class="mb-30">{{ trans('label.create_your_account_free') }}</p>
                        </div>
                        <div class="tab-register">
                            <ul class="nav nav-line-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link register_tab font-weight-bold {{ old('user_type') == 'Jobseeker' || $type == 'jobseeker' ? 'active' : '' }}"
                                        id="job-seeker-tab" data-toggle="tab" href="#job-seeker" role="tab"
                                        aria-controls="job-seeker" aria-selected="false">
                                        <label class="form-check-label" for="exampleRadios3">
                                            {{ trans('label.register_page.teacher') }}
                                            <svg xmlns="http://www.w3.org/2000/svg" width="10" height="7"
                                                viewBox="0 0 10 7" fill="none" class="selected_arrow">
                                                <path d="M1.5 4L3.5 6L8.5 1" stroke="white" stroke-width="1.5"
                                                    stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </label>
                                        {{-- @lang('label.job_Seeker') --}}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link register_tab font-weight-bold {{ old('user_type') == 'Employer' || $type == 'employer' ? 'active' : '' }}"
                                        id="employer-tab" data-toggle="tab" href="#employer" role="tab"
                                        aria-controls="employer" aria-selected="true">
                                        <label class="form-check-label" for="exampleRadios2">
                                            {{ trans('label.register_page.institute') }}
                                            <svg xmlns="http://www.w3.org/2000/svg" width="10" height="7"
                                                viewBox="0 0 10 7" fill="none" class="selected_arrow">
                                                <path d="M1.5 4L3.5 6L8.5 1" stroke="white" stroke-width="1.5"
                                                    stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </label>
                                        {{-- @lang('label.employer') --}}
                                    </a>
                                </li>


                            </ul>

                            <form method="post" action="{{ route('front.register.store') }}">
                                @csrf
                                <input type="hidden" name="user_type" id="user_type"
                                    value="{{ old('user_type', $type == 'employer' ? 'Employer' : 'Jobseeker') }}">
                                <div class="tab-content pt-4" id="myTabContent">
                                    <div class="tab-pane fade {{ old('user_type') == 'Employer' || $type == 'employer' ? 'active show' : '' }}"
                                        id="employer" role="tabpanel" aria-labelledby="employer-tab">
                                        <div class="row">
                                            <div class="form-group mb-3 col-md-12">
                                                <label for="">{{ trans('label.institute_name') }}<span
                                                        class="text-danger">*</span></label>
                                                <input type="text" name="company_name"
                                                    class="form-control @error('company_name') is-invalid @enderror"
                                                    value="{{ old('company_name', null) }}"
                                                    placeholder="{{ trans('label.institute_name') }}">

                                                @error('company_name')
                                                    <span class="error invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>
                                    <div class="tab-pane fade {{ old('user_type') == 'Jobseeker' || $type == 'jobseeker' ? 'active show' : '' }}"
                                        id="job-seeker" role="tabpanel" aria-labelledby="job-seeker-tab">

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group mb-3">
                                                    <label for="">{{ trans('label.first_name') }}<span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" name="first_name"
                                                        class="form-control @error('first_name') is-invalid @enderror"
                                                        value="{{ old('first_name', null) }}"
                                                        placeholder="{{ trans('label.first_name') }}">

                                                    @error('first_name')
                                                        <span class="error invalid-feedback">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group mb-3">
                                                    <label for="">{{ trans('label.last_name') }}<span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" name="last_name"
                                                        class="form-control @error('last_name') is-invalid @enderror"
                                                        value="{{ old('last_name', null) }}"
                                                        placeholder="{{ trans('label.last_name') }}">

                                                    @error('last_name')
                                                        <span class="error invalid-feedback">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-12 mb-3 email_field">
                                        @if (old('provider', null) != null)
                                            <label for="" class="form-control text-lowercase"
                                                readonly>{{ old('email', null) }}</label>
                                            <input type="hidden" name="email" value="{{ old('email', null) }}">
                                        @else
                                            <label for="">{{ trans('label.company_email') }}<span
                                                    class="text-danger">*</span></label>
                                            <input type="email" name="email" value="{{ old('email', null) }}"
                                                class="form-control @error('email') is-invalid @enderror"
                                                placeholder="{{ trans('label.company_email') }}">

                                            @error('email')
                                                <span class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        @endif
                                    </div>
                                    @if (old('provider', null) != null)
                                        <input type="hidden" name="provider_id" value="{{ old('provider_id', null) }}">
                                        <input type="hidden" name="provider" value="{{ old('provider', null) }}">
                                    @else
                                        <div class="form-group col-md-6 mb-3" id="popover-password">
                                            <label for="">{{ trans('label.password') }}<span class="text-danger">*</span></label>
                                            <input id="password" type="password" name="password" placeholder="" class="form-control input-md @error('password') is-invalid @enderror" data-placement="bottom" data-toggle="popover" data-container="body" type="button" data-html="true">
                                            <div class="progress">
                                                <div id="password-strength" class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:0%">
                                                </div>
                                            </div>
                                            <div class="mt-1">
                                                <p class="mb-2">{{ trans('label.password_strength') }} <span id="result"> </span></p>
                                                <ul class="pl-3 m-0">
                                                    <li class="">{{ trans('label.1lowercase') }} &amp; {{ trans('label.1upercase') }}</li>
                                                    <li class="">{{ trans('label.special_character') }}</li>
                                                    <li class="">{{ trans('label.atleast_8_character') }}</li>
                                                </ul>
                                            </div>
                                            @error('password')
                                                <span class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6 mb-3">
                                            <label for="">{{ trans('label.confirm_password') }}<span
                                                    class="text-danger">*</span></label>
                                            <input type="password" name="password_confirmation" class="form-control"
                                                placeholder="{{ trans('label.confirm_password') }}">
                                        </div>
                                    @endif
                                    <div class="form-group col-md-12 mb-3">
                                        <label for="">{{ trans('label.phone_number') }}<span
                                                class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <input type="text" name="phone_number"
                                                class="form-control @error('phone_number') is-invalid @enderror"
                                                value="{{ Str::removePhonePrefix(old('phone_number', null)) }}"
                                                placeholder="{{ trans('label.phone_number') }}">
                                            @error('phone_number')
                                                <span class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group my-10 term_condition">
                                    <input type="checkbox" name="tc_checkbox" id="tc_checkbox" value="1"
                                        class="@error('tc_checkbox') is-invalid @enderror" placeholder="tc_checkbox">
                                    <label for="tc_checkbox">
                                        {{ trans('label.agree_to_the') }} <a class="open-form" href="javascript:void(0)" data-mode="show"
                                            data-modal-size="modal-lg" data-model="employerJobs"
                                            data-url="{!! route('terms-conditions') !!}" title="">
                                            {{ trans('label.term_condition') }}</a>
                                    </label>
                                    @error('tc_checkbox')
                                        <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <div id="captcha_element">

                                    </div>
                                    @error('g-recaptcha-response')
                                        <div class="text-danger">
                                            <span class="error small">{{ $message }}</span>
                                        </div>
                                    @enderror
                                </div>
                                <div class="row">

                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary w-100">
                                            @lang('label.sing_up')
                                        </button>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 Sign-up-here-div text-center mt-3">
                                        <p class="mb-0 d-flex align-items-center justify-content-center text-black">
                                            @lang('label.already_account') <a href="{{ route('login') }}" class="ml-1">
                                                @lang('label.login')</a>
                                        </p>
                                    </div>
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
                let target = $(e.target).attr("href"); // activated tab
                if (target == '#employer') {
                    $('#user_type').val('Employer');
                    window.history.pushState("jobseeker", "", 'employer');
                } else {
                    $('#user_type').val('Jobseeker');
                    window.history.pushState("employer", "", 'jobseeker');
                }
            });

            $('input').on('input', function() {
                $(this).removeClass('is-invalid');
                $(this).siblings('.invalid-feedback').text('');
            });

            $('select').on('change', function() {
                $(this).removeClass('is-invalid');
                $(this).siblings('.invalid-feedback').text('');
            });

            $('textarea').on('input', function() {
                $(this).removeClass('is-invalid');
                $(this).siblings('.invalid-feedback').text('');
            });
        });
    </script>
    @include('auth.verification.captcha_script')
@endpush





<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {

    $('#password').keyup(function() {
        var password = $('#password').val();
        if (checkStrength(password) == false) {
            $('#sign-up').attr('disabled', true);
        }
    });






    function checkStrength(password) {
        var strength = 0;


        //If password contains both lower and uppercase characters, increase strength value.
        if (password.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/)) {
            strength += 1;
            $('.low-upper-case').addClass('text-success');
            $('.low-upper-case i').removeClass('fa-file-text').addClass('fa-check');
            $('#popover-password-top').addClass('hide');


        } else {
            $('.low-upper-case').removeClass('text-success');
            $('.low-upper-case i').addClass('fa-file-text').removeClass('fa-check');
            $('#popover-password-top').removeClass('hide');
        }

        //If it has numbers and characters, increase strength value.
        if (password.match(/([a-zA-Z])/) && password.match(/([0-9])/)) {
            strength += 1;
            $('.one-number').addClass('text-success');
            $('.one-number i').removeClass('fa-file-text').addClass('fa-check');
            $('#popover-password-top').addClass('hide');

        } else {
            $('.one-number').removeClass('text-success');
            $('.one-number i').addClass('fa-file-text').removeClass('fa-check');
            $('#popover-password-top').removeClass('hide');
        }

        //If it has one special character, increase strength value.
        if (password.match(/([!,%,&,@,#,$,^,*,?,_,~])/)) {
            strength += 1;
            $('.one-special-char').addClass('text-success');
            $('.one-special-char i').removeClass('fa-file-text').addClass('fa-check');
            $('#popover-password-top').addClass('hide');

        } else {
            $('.one-special-char').removeClass('text-success');
            $('.one-special-char i').addClass('fa-file-text').removeClass('fa-check');
            $('#popover-password-top').removeClass('hide');
        }

        if (password.length > 7) {
            strength += 1;
            $('.eight-character').addClass('text-success');
            $('.eight-character i').removeClass('fa-file-text').addClass('fa-check');
            $('#popover-password-top').addClass('hide');

        } else {
            $('.eight-character').removeClass('text-success');
            $('.eight-character i').addClass('fa-file-text').removeClass('fa-check');
            $('#popover-password-top').removeClass('hide');
        }




        // If value is less than 2

        if (strength < 2) {
            $('#result').removeClass()
            $('#password-strength').addClass('progress-bar-danger');

            $('#result').addClass('text-danger').text('Very Week');
            $('#password-strength').css('width', '10%');
        } else if (strength == 2) {
            $('#result').addClass('good');
            $('#password-strength').removeClass('progress-bar-danger');
            $('#password-strength').addClass('progress-bar-warning');
            $('#result').addClass('text-warning').text('Week')
            $('#password-strength').css('width', '60%');
            return 'Week'
        } else if (strength == 4) {
            $('#result').removeClass()
            $('#result').addClass('strong');
            $('#password-strength').removeClass('progress-bar-warning');
            $('#password-strength').addClass('progress-bar-success');
            $('#result').addClass('text-success').text('Strength');
            $('#password-strength').css('width', '100%');

            return 'Strong'
        }

    }

});
</script>


