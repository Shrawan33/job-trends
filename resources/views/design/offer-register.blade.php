@extends('layouts.front')
@section('content')
<div class="offer_register_wraper">
    <div class="container">
       <div class="inner_wraper bg-white p-15 p-lg-30">
            <h2 class="text-left mb-3">Register with us
            <button class="icon_btn edit" data-html="true" data-toggle="popover" id="showPopover" data-original-title="" title="" aria-describedby="popover580619">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M9.8175 9.75C9.99383 9.24875 10.3419 8.82608 10.8 8.55685C11.2581 8.28762 11.7967 8.1892 12.3204 8.27903C12.8441 8.36886 13.3191 8.64114 13.6613 9.04765C14.0035 9.45415 14.1908 9.96864 14.19 10.5C14.19 12 11.94 12.75 11.94 12.75M12 15.75H12.0075M19.5 12C19.5 16.1421 16.1421 19.5 12 19.5C7.85786 19.5 4.5 16.1421 4.5 12C4.5 7.85786 7.85786 4.5 12 4.5C16.1421 4.5 19.5 7.85786 19.5 12Z" stroke="#989899" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    <path d="M9.8175 9.75C9.99383 9.24875 10.3419 8.82608 10.8 8.55685C11.2581 8.28762 11.7967 8.1892 12.3204 8.27903C12.8441 8.36886 13.3191 8.64114 13.6613 9.04765C14.0035 9.45415 14.1908 9.96864 14.19 10.5C14.19 12 11.94 12.75 11.94 12.75M12 15.75H12.0075M19.5 12C19.5 16.1421 16.1421 19.5 12 19.5C7.85786 19.5 4.5 16.1421 4.5 12C4.5 7.85786 7.85786 4.5 12 4.5C16.1421 4.5 19.5 7.85786 19.5 12Z" stroke="black" stroke-opacity="0.2" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    <path d="M9.8175 9.75C9.99383 9.24875 10.3419 8.82608 10.8 8.55685C11.2581 8.28762 11.7967 8.1892 12.3204 8.27903C12.8441 8.36886 13.3191 8.64114 13.6613 9.04765C14.0035 9.45415 14.1908 9.96864 14.19 10.5C14.19 12 11.94 12.75 11.94 12.75M12 15.75H12.0075M19.5 12C19.5 16.1421 16.1421 19.5 12 19.5C7.85786 19.5 4.5 16.1421 4.5 12C4.5 7.85786 7.85786 4.5 12 4.5C16.1421 4.5 19.5 7.85786 19.5 12Z" stroke="black" stroke-opacity="0.2" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
            </button>
        </h2>
            <p class="mb-30">Create Your Free Account. It only takes a couple of minutes to get started</p>
            <form method="post" action="{{ route('front.register.store') }}">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-30">
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
                        <div class="form-group mb-30">
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
                    <div class="form-group col-md-6 mb-30 email_field">
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
                    <div class="form-group col-md-6 mb-30">
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
                    <div class="form-group mb-3">
                        <div id="captcha_element">

                        </div>
                        @error('g-recaptcha-response')
                            <div class="text-danger">
                                <span class="error small">{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary w-100">
                            @lang('label.sing_up')
                        </button>
                    </div>

                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary rounded-pill">Register Now</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
