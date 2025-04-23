@extends('layouts.front')

@section('third_party_stylesheets')
    @include('vendor.richtexteditor.style')

    @include('vendor.image_upload.style')
    @include('vendor.dropzone.style')
@endsection

@section('content')
<div class="offer_register_wraper mb-50">
    <div class="container">
       <div class="inner_wraper bg-white p-15 p-lg-30">
            <h2 class="text-left mb-3" id="showPopover_container">
                Register with us
                <button class="icon_btn edit" data-html="true" data-toggle="popover" id="showPopover">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none">
                        <path
                            d="M9.8175 9.75C9.99383 9.24875 10.3419 8.82608 10.8 8.55685C11.2581 8.28762 11.7967 8.1892 12.3204 8.27903C12.8441 8.36886 13.3191 8.64114 13.6613 9.04765C14.0035 9.45415 14.1908 9.96864 14.19 10.5C14.19 12 11.94 12.75 11.94 12.75M12 15.75H12.0075M19.5 12C19.5 16.1421 16.1421 19.5 12 19.5C7.85786 19.5 4.5 16.1421 4.5 12C4.5 7.85786 7.85786 4.5 12 4.5C16.1421 4.5 19.5 7.85786 19.5 12Z"
                            stroke="#989899" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path
                            d="M9.8175 9.75C9.99383 9.24875 10.3419 8.82608 10.8 8.55685C11.2581 8.28762 11.7967 8.1892 12.3204 8.27903C12.8441 8.36886 13.3191 8.64114 13.6613 9.04765C14.0035 9.45415 14.1908 9.96864 14.19 10.5C14.19 12 11.94 12.75 11.94 12.75M12 15.75H12.0075M19.5 12C19.5 16.1421 16.1421 19.5 12 19.5C7.85786 19.5 4.5 16.1421 4.5 12C4.5 7.85786 7.85786 4.5 12 4.5C16.1421 4.5 19.5 7.85786 19.5 12Z"
                            stroke="black" stroke-opacity="0.2" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path
                            d="M9.8175 9.75C9.99383 9.24875 10.3419 8.82608 10.8 8.55685C11.2581 8.28762 11.7967 8.1892 12.3204 8.27903C12.8441 8.36886 13.3191 8.64114 13.6613 9.04765C14.0035 9.45415 14.1908 9.96864 14.19 10.5C14.19 12 11.94 12.75 11.94 12.75M12 15.75H12.0075M19.5 12C19.5 16.1421 16.1421 19.5 12 19.5C7.85786 19.5 4.5 16.1421 4.5 12C4.5 7.85786 7.85786 4.5 12 4.5C16.1421 4.5 19.5 7.85786 19.5 12Z"
                            stroke="black" stroke-opacity="0.2" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </button>
                <div id="popup-content" class="d-none popup_content">
                    <div class="popup_heading d-flex align-items-center justify-content-between">
                        <h3></h3>
                        <span class="close"></path>
                           </svg>
                        </span>
                    </div>
                    <p>Are you ready to accelerate your job hunt and stand out in the competitive job market? Look no further!</p>
                    <p>Special Offer Alert from JobTrendsIndia.com!</p>
                    <p>Welcome to JobTrendsIndia.com, where we bring you an exclusive offer to accelerate your job search and enhance your professional profile—all for a one-time fee of just ₹299!</p>
                    <p>What’s Included in this Offer?</p>
                    <p>ATS-Optimized Resume: Get a professional resume tailored to your targeted role, ensuring you pass through automated screening systems effortlessly.
                        LinkedIn Profile Optimization: Boost your online presence and attract top recruiters with a strategically optimized LinkedIn profile.
                        Standard Cover Letter: Make a lasting impression with a customized cover letter that highlights your unique strengths and qualifications.
                        Why Choose JobTrendsIndia.com?</p>
                        <p>                        All-in-One Solution: Save time and money by getting all essential job application tools under one roof. No need to pay hefty charges to different professional writers.
                            Personalized Support: We understand your unique career needs and provide personalized assistance to help you stand out in the competitive job market.
                            Build Your Personal Brand: Our expert services will help you build a personal brand that will not go unnoticed by potential employers.
                            How to Avail the Offer?</p>
                            <p>Register as a Jobseeker: Sign up on JobTrendsIndia.com and create your job seeker profile.
                                Pay the One-Time Fee: Complete the payment of ₹299 to unlock access to your professional resume, LinkedIn profile optimization, and cover letter services.
                                Get Started: Our team will get to work, delivering high-quality, tailored documents to boost your job search.
                                Don’t miss out on this incredible offer!</p>
                        <p>Empower your career journey with JobTrendsIndia.com. Register now and take the first step towards landing your dream job.</p>
                </div>
            </h2>
            <p class="mb-30">Create Your Free Account. It only takes a couple of minutes to get started</p>
            <form method="post" action="{{ route('front.offer-register.store') }}">
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
                        <div class="">
                            <input type="text" name="phone_number"
                                class="form-control @error('phone_number') is-invalid @enderror"
                                value="{{ Str::removePhonePrefix(old('phone_number', null)) }}"
                                placeholder="{{ trans('label.phone_number') }}">
                            @error('phone_number')
                                <span class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group col-md-6 mb-3" id="popover-password">
                        <label for="">{{ trans('label.password') }}<span class="text-danger">*</span></label>
                        <div class="position-relative">
                            <input id="password" type="password" name="password" placeholder="" class="form-control input-md @error('password') is-invalid @enderror" data-placement="bottom" data-toggle="popover" data-container="body" type="button" data-html="true">
                            <button type="button" id="togglePassword" class="password-icon">
                                <svg id="svg1" xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" viewBox="0 0 24 24"
                                    fill="none">
                                    <path
                                        d="M2.42012 12.7132C2.28394 12.4975 2.21584 12.3897 2.17772 12.2234C2.14909 12.0985 2.14909 11.9015 2.17772 11.7766C2.21584 11.6103 2.28394 11.5025 2.42012 11.2868C3.54553 9.50484 6.8954 5 12.0004 5C17.1054 5 20.4553 9.50484 21.5807 11.2868C21.7169 11.5025 21.785 11.6103 21.8231 11.7766C21.8517 11.9015 21.8517 12.0985 21.8231 12.2234C21.785 12.3897 21.7169 12.4975 21.5807 12.7132C20.4553 14.4952 17.1054 19 12.0004 19C6.8954 19 3.54553 14.4952 2.42012 12.7132Z"
                                        stroke="black" stroke-width="1.5"
                                        stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path
                                        d="M12.0004 15C13.6573 15 15.0004 13.6569 15.0004 12C15.0004 10.3431 13.6573 9 12.0004 9C10.3435 9 9.0004 10.3431 9.0004 12C9.0004 13.6569 10.3435 15 12.0004 15Z"
                                        stroke="black" stroke-width="1.5"
                                        stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                                <svg id="svg2" xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" style="display:none">
                                    <path
                                        d="M10.7429 5.09232C11.1494 5.03223 11.5686 5 12.0004 5C17.1054 5 20.4553 9.50484 21.5807 11.2868C21.7169 11.5025 21.785 11.6103 21.8231 11.7767C21.8518 11.9016 21.8517 12.0987 21.8231 12.2236C21.7849 12.3899 21.7164 12.4985 21.5792 12.7156C21.2793 13.1901 20.8222 13.8571 20.2165 14.5805M6.72432 6.71504C4.56225 8.1817 3.09445 10.2194 2.42111 11.2853C2.28428 11.5019 2.21587 11.6102 2.17774 11.7765C2.1491 11.9014 2.14909 12.0984 2.17771 12.2234C2.21583 12.3897 2.28393 12.4975 2.42013 12.7132C3.54554 14.4952 6.89541 19 12.0004 19C14.0588 19 15.8319 18.2676 17.2888 17.2766M3.00042 3L21.0004 21M9.8791 9.87868C9.3362 10.4216 9.00042 11.1716 9.00042 12C9.00042 13.6569 10.3436 15 12.0004 15C12.8288 15 13.5788 14.6642 14.1217 14.1213"
                                        stroke="black" stroke-width="1.5"
                                        stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                            </button>
                        </div>
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
                        <label for="">{{ trans('label.confirm_password') }}<span class="text-danger">*</span></label>
                        <div class="position-relative">
                        <input id="confirmPassword" type="password" name="password_confirmation" class="form-control" placeholder="{{ trans('label.confirm_password') }}">
                            <button type="button" id="togglePassword" class="password-icon">
                                <svg id="showConfirmPasswordIcon" xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" onclick="togglePassword('confirmPassword', 'showConfirmPasswordIcon', 'hideConfirmPasswordIcon')">
                                    <path
                                        d="M2.42012 12.7132C2.28394 12.4975 2.21584 12.3897 2.17772 12.2234C2.14909 12.0985 2.14909 11.9015 2.17772 11.7766C2.21584 11.6103 2.28394 11.5025 2.42012 11.2868C3.54553 9.50484 6.8954 5 12.0004 5C17.1054 5 20.4553 9.50484 21.5807 11.2868C21.7169 11.5025 21.785 11.6103 21.8231 11.7766C21.8517 11.9015 21.8517 12.0985 21.8231 12.2234C21.785 12.3897 21.7169 12.4975 21.5807 12.7132C20.4553 14.4952 17.1054 19 12.0004 19C6.8954 19 3.54553 14.4952 2.42012 12.7132Z"
                                        stroke="black" stroke-width="1.5"
                                        stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path
                                        d="M12.0004 15C13.6573 15 15.0004 13.6569 15.0004 12C15.0004 10.3431 13.6573 9 12.0004 9C10.3435 9 9.0004 10.3431 9.0004 12C9.0004 13.6569 10.3435 15 12.0004 15Z"
                                        stroke="black" stroke-width="1.5"
                                        stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                                <svg id="hideConfirmPasswordIcon" xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" onclick="togglePassword('confirmPassword', 'showConfirmPasswordIcon', 'hideConfirmPasswordIcon')" style="display:none">
                                    <path
                                        d="M10.7429 5.09232C11.1494 5.03223 11.5686 5 12.0004 5C17.1054 5 20.4553 9.50484 21.5807 11.2868C21.7169 11.5025 21.785 11.6103 21.8231 11.7767C21.8518 11.9016 21.8517 12.0987 21.8231 12.2236C21.7849 12.3899 21.7164 12.4985 21.5792 12.7156C21.2793 13.1901 20.8222 13.8571 20.2165 14.5805M6.72432 6.71504C4.56225 8.1817 3.09445 10.2194 2.42111 11.2853C2.28428 11.5019 2.21587 11.6102 2.17774 11.7765C2.1491 11.9014 2.14909 12.0984 2.17771 12.2234C2.21583 12.3897 2.28393 12.4975 2.42013 12.7132C3.54554 14.4952 6.89541 19 12.0004 19C14.0588 19 15.8319 18.2676 17.2888 17.2766M3.00042 3L21.0004 21M9.8791 9.87868C9.3362 10.4216 9.00042 11.1716 9.00042 12C9.00042 13.6569 10.3436 15 12.0004 15C12.8288 15 13.5788 14.6642 14.1217 14.1213"
                                        stroke="black" stroke-width="1.5"
                                        stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div class="form-group col-12 mb-30">
                        <label for="">{{ trans('label.instruction_cv_writing') }}<span class="text-danger">*</span></label>
                        {{-- {!! Form::label('description', trans('label.description') . '<span class="text-danger">*</span>') !!} --}}
                        {!! Form::textarea('instruction_cv_writing', $seekerDetail->instruction_cv_writing ?? null, [
                            'id' => 'instruction_cv_writing',
                            'class' => 'form-control ' . ($errors->has('instruction_cv_writing') ? 'is-invalid' : ''),
                            'placeholder' => trans('message.instruction_cv_writing'),
                            'rows' => 5
                        ]) !!}
                        @error('instruction_cv_writing')
                            <div class="error invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12">
                        <div class="form-group mb-0">
                            <label class="mb-0" for="">{{ trans('label.resume_attchments') }}</label>
                            @include('vendor.dropzone.upload', [
                                'form_id' => 'frm_jobseeker',
                                'dropzone_id' => 'resume-document-dropzone',
                                'disk' => $entity['disk'],
                                'name' => 'document',
                                'documents' => old(
                                    'document',
                                    isset($seekerDetail) && $seekerDetail->documents
                                        ? $seekerDetail->documents->toArray()
                                        : []),
                                'maxFiles' => 1,
                                'acceptedFileType' => 'documents',
                                'link_text' => 'Upload Resume  (file size 1 MB only)&nbsp;<small class="red">*</small>',
                            ])
                            @error('document')
                                <div class="error invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group col-12 mb-0 mt-2">
                        <div class="form-group mb-3">
                            <div id="captcha_element">

                            </div>
                            @error('g-recaptcha-response')
                                <div class="text-danger">
                                    <span class="error small">{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
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
@section('third_party_scripts')
    @include('vendor.richtexteditor.script')
    @include('vendor.image_upload.script')
    @include('vendor.dropzone.script')
@endsection
@push('page_scripts')
    @include('auth.verification.captcha_script')

@endpush
@push('page_scripts')
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
@endpush
