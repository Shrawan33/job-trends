@extends('layouts.front')

@section('content')
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-6 ">
                <div class="login-form p-4 rounded">
                    <h2 class="mt-3 pb-4 font-weight-bold">{{ trans('label.change_email_phone') }}</h2>

                    {{-- <ul class="nav nav-line-tabs nav-justified" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link {{ empty(old('phone_number')) ? 'active' : '' }}" id="email-tab"
                                data-toggle="tab" href="#email" role="tab" aria-controls="email"
                                aria-selected="true">{{ trans('label.email') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ !empty(old('phone_number')) ? 'active' : '' }}" id="mobile-tab"
                                data-toggle="tab" href="#mobile" role="tab" aria-controls="mobile"
                                aria-selected="false">{{ trans('label.mobile') }}</a>
                        </li>

                    </ul> --}}
                    <form method="post" action="{{ route('change_email_phone.store') }}">
                        @csrf

                        <div class="tab-content pt-4" id="myTabContent">
                            <div class="tab-pane fade {{ empty(old('phone_number')) ? 'show active' : '' }}" id="email"
                                role="tabpanel" aria-labelledby="email-tab">

                                <div class="form-group mb-4">
                                    <input type="email" name="email" value="{{ old('email') }}"
                                        placeholder="{{ trans('label.email_address') }}"
                                        class="form-control @error('email') is-invalid @enderror">
                                    @error('email')
                                        <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            {{-- <div class="tab-pane fade {{ !empty(old('phone_number')) ? 'show active' : '' }}"
                                id="mobile" role="tabpanel" aria-labelledby="mobile-tab">
                                <div class="form-group mb-4">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span
                                                class="input-group-text bg-transparent">{{ config('constants.phone_prefix') }}</span>
                                        </div>
                                        <input type="Phone Number" name="phone_number"
                                            placeholder="{{ trans('label.phone_number') }}"
                                            class="form-control @error('phone_number') is-invalid @enderror"
                                            value="{{ Str::removePhonePrefix(old('phone_number')) }}">
                                        @error('phone_number')
                                            <span class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div> --}}

                        </div>
                        <div class="row align-items-center">
                            <div class="col">
                                <button type="submit"
                                    class="btn btn-secondary font-weight-bold rounded-pill px-5 text-white"
                                    id="submit_otp_button">{{ empty(old('phone_number'))
                                        ? trans('label.send_code')
                                        : 'Get OTP' }}</button>
                            </div>
                        </div>
                    </form>

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
                    $('#submit_otp_button').text("{{ trans('label.send_code') }}");
                } else {
                    $('#submit_otp_button').text("{{ trans('label.get_otp') }}");
                }

                $(target).find(':input').each(function() {
                    $(this).val(null);
                });
            });
        });
    </script>
@endpush
