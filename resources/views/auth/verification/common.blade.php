@extends('layouts.front')

@section('content')
    <form action="{{ !empty($route) ? $route : route('front.register.verification') }}" method="post">
        <input type="hidden" name="token" value="{{ $token }}">
        @csrf
        <div class="container my-50 my-lg-100">
            <div class="row justify-content-center">
                <div class="col-12 col-md-8 col-lg-6 ">
                    <div class="login-form p-4 rounded">
                        <h3 class="mt-2 pb-3 font-weight-bold">{{ $headingOne }}</h3>
                        <p class="mb-4">{{ $paragraphText }}</p>
                        <h6 class="mb-3">{{ $headingTwo }}</h6>

                        <input type="text" name="verification_code"
                            class="verification-code form-control only_numbers @error('verification_code') is-invalid @enderror"
                            id="verification_code"
                            data-maxDigits='{{ config('constants.verification_code.length.' . $verification) }}'
                            autocomplete="off" />
                        @error('verification_code')
                            <span class="error invalid-feedback">{{ $message }}</span>
                        @enderror

                        <input type="submit" value="{{ !empty($otp) ? trans('label.login') : trans('label.submit') }}"
                            name="submit"
                            class="mx-auto btn btn-primary mt-3">
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@push('page_scripts')
    <script>
        $(document).ready(function() {
            $('#verification_code').focus();
        });
    </script>
@endpush
