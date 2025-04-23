@extends('layouts.front')

@section('content')
<div class="login-page single_login_wraper">
    <div class="container-fluid p-0">
        <div class="row mx-0">
            <div class="col-lg-7 col-md-6 col-12 p-0">
                <img src="{{ asset('images/login-banner.jpg') }}" alt="login-banner" width="100%" class="login-bg">
            </div>
            <div class="col-lg-5 col-md-6 col-12 p-3 p-lg-5">
                <div class="login-page-content">
                    <div class="container p-0">
                        <div class="mkj-logo mb-30">
                            <a href="{{route('home.verfied')}}">
                                <img src="{{ asset('images/Logo.png') }}" alt="logo" class="white_logo" height="40px">

                              {{-- <img src="{{ asset('images/black_logo.svg') }}" alt="logo"> --}}
                            </a>
                        </div>
                        <div class="login-form">
                            <div class="mkj-form-text">
                                <h2 class="mb-3">{{trans('label.forgot_your')}}</h2>
                                <p class="mb-50">Enter your email address to receive the code</p>
                            </div>
                        </div>
                        <form method="post" class="login_max-width" action="{{ route('forgot_password.store') }}">
                            @csrf
                            <div class="form-group mb-4">
                                <input type="email" name="email" value="{{ old('email') }}" placeholder="{{trans('label.email_address')}}"
                                    class="form-control @error('email') is-invalid @enderror">
                                @error('email')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="row align-items-center">
                                <div class="col-12">
                                    <button type="submit"
                                        class="btn btn-primary w-100" id="submit_otp_button">{{ empty(old('phone_number')) ? 'Send Code' : 'Get OTP' }}</button>
                                        {{-- <p class="mb-0 d-flex align-items-center justify-content-center text-black Sign-up-here-div mt-3">
                                            @lang('label.already_account') <a href="{{ route('login') }}" class="ml-1"> @lang('label.login')</a>
                                        </p> --}}
                                </div>
                            </div>
                        </form>
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
            $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
                let target = $(e.target).attr("href") // activated tab

                if (target == '#email') {
                    $('#submit_otp_button').text('Send Code');
                } else {
                    $('#submit_otp_button').text('Get OTP');
                }

                $(target).find(':input').each(function() {
                    $(this).val(null);
                });
            });
        });
    </script>
@endpush
