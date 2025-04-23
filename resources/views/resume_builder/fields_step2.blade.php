
{!! Form::hidden('step', $step) !!}
<fieldset id="step2" class="job_steps_common">
    <h2>Profile Summary</h2>
    <div class="row mkj-form-text">
        <div class="col-md-6 mb-4">
            <label for="">{{ trans('label.i_am_a') }}
                <span style="color: red">*</span>
            </label>

            {!! Form::textarea('i_am_a', $seekerDetails->i_am_a ?? null, [
                'class' => 'form-control ' . (isset($errors) && $errors->has('i_am_a') ? 'is-invalid' : ''),
                'placeholder' => trans('message.i_am_a'),
                'rows' => 3,
            ]) !!}
            @error('who_are_you')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror

        </div>
        <div class="col-md-6 mb-4">
            <label for="">{{ trans('label.my_core_competencies') }}
                {{-- <span style="color: red">*</span> --}}
            </label>

            {!! Form::textarea('my_core_competencies', $seekerDetails->my_core_competencies ?? null, [
                'class' => 'form-control ' . (isset($errors) && $errors->has('my_core_competencies') ? 'is-invalid' : ''),
                'placeholder' => trans('message.my_core_competencies'),
                'rows' => 3,
            ]) !!}
            @error('my_core_competencies')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror

        </div>

        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <div>
                        <label for="">{{ trans('label.searching_for') }}
                            <span style="color: red">*</span>
                        </label>
                        @if ($seekerDetails->searching_for != '')
                            {!! Form::textarea('searching_for', $seekerDetails->searching_for ?? null, [
                                'class' => 'form-control ' . (isset($errors) && $errors->has('searching_for') ? 'is-invalid' : ''),
                                'placeholder' => trans('message.searching_for_text'),
                                'rows' => 3,
                                'id' => 'searching_for',
                                'readonly' => 'readonly'
                            ]) !!}
                        @else
                            {!! Form::textarea('searching_for', $seekerDetails->searching_for ?? null, [
                                'class' => 'form-control ' . (isset($errors) && $errors->has('searching_for') ? 'is-invalid' : ''),
                                'placeholder' => trans('message.searching_for_text'),
                                'rows' => 3,
                                'id' => 'searching_for'
                            ]) !!}
                        @endif

                    </div>
                    {{-- <div class="mt-4">
                        <a href="javascript:void(0)" id="ai_description" name="ai_description" class="ai_description next btn btn-primary">Click Here to See Your New Resume Profile Summary </a>
                    </div> --}}
                </div>
                <div class="col-md-6 mb-40 d-none pr-0" id="open-ai-wrapper">
                    <div class="ai_main_wraper mt-25 position-relative">
                        <img src="{{ asset('images/ai_bg.png') }}" class="ai_wraper_img d-none d-lg-block" alt="your_image"
                            width="100%">
                        <div class="header_wraper d-flex align-items-center mb-22">
                            <svg xmlns="http://www.w3.org/2000/svg" width="42" height="42" viewBox="0 0 42 42"
                                fill="none">
                                <g clip-path="url(#clip0_1232_1218)">
                                    <path
                                        d="M21.0177 1.14288e-05C13.7258 -0.0095042 7.7841 5.92423 7.78418 13.2161C7.78426 18.0636 10.3945 22.3009 14.2858 24.6006C14.9768 25.009 15.395 25.7574 15.395 26.5601V29.7792C15.5229 29.7257 15.6633 29.696 15.8105 29.696H26.1898C26.3371 29.696 26.4774 29.7257 26.6053 29.7792V26.56C26.6053 25.7479 27.0391 25.0017 27.7375 24.5871C31.6161 22.2841 34.216 18.0541 34.216 13.2161C34.2161 5.92283 28.3086 0.00952705 21.0177 1.14288e-05Z"
                                        fill="#FFE181" />
                                    <path
                                        d="M18.8879 26.5601C18.8879 25.7575 18.4697 25.009 17.7787 24.6006C13.8874 22.3008 11.2772 18.0636 11.2771 13.2161C11.277 6.52109 16.2861 0.971754 22.75 0.115347C22.183 0.0403708 21.605 0.000831741 21.0178 1.1429e-05C13.7259 -0.0095042 7.7841 5.92414 7.78418 13.2161C7.78426 18.0636 10.3945 22.3009 14.2858 24.6006C14.9768 25.009 15.395 25.7575 15.395 26.5601V29.7792C15.5229 29.7257 15.6633 29.696 15.8105 29.696H18.8879V26.5601Z"
                                        fill="#FEC458" />
                                    <path
                                        d="M22.6553 30.3297C22.3052 30.3297 22.0215 30.046 22.0215 29.696V24.0238C22.0215 23.4538 22.2134 22.8915 22.5618 22.4403L23.4688 21.2661C23.6467 21.0357 23.7447 20.7486 23.7447 20.4574V14.5381C23.7447 14.188 24.0285 13.9043 24.3785 13.9043C24.7285 13.9043 25.0123 14.188 25.0123 14.5381V20.4574C25.0123 21.0275 24.8203 21.5898 24.4719 22.041L23.565 23.2152C23.387 23.4456 23.289 23.7327 23.289 24.0238V29.696C23.289 30.046 23.0053 30.3297 22.6553 30.3297Z"
                                        fill="#FFB640" />
                                    <path
                                        d="M19.3444 30.3297C18.9944 30.3297 18.7106 30.046 18.7106 29.696V24.0238C18.7106 23.7328 18.6126 23.4456 18.4347 23.2152L17.5276 22.041C17.1793 21.5899 16.9873 21.0275 16.9873 20.4574V14.5381C16.9873 14.188 17.2711 13.9043 17.6211 13.9043C17.9711 13.9043 18.2549 14.188 18.2549 14.5381V20.4574C18.2549 20.7486 18.3529 21.0357 18.5308 21.266L19.4378 22.4402C19.7863 22.8914 19.9782 23.4538 19.9782 24.0238V29.6959C19.9782 30.046 19.6944 30.3297 19.3444 30.3297Z"
                                        fill="#FFB640" />
                                    <path
                                        d="M30.2195 10.6285C29.5337 8.07266 27.7716 5.93558 25.3852 4.7654C25.0709 4.61127 24.9411 4.23154 25.0951 3.91737C25.2492 3.6031 25.6291 3.47333 25.9431 3.6273C28.6581 4.95859 30.6631 7.39073 31.4438 10.3C31.5345 10.638 31.3339 10.9857 30.9959 11.0764C30.6581 11.1671 30.3102 10.9668 30.2195 10.6285Z"
                                        fill="#FFEAC8" />
                                    <path
                                        d="M18.4404 38.9766V39.4409C18.4404 40.8485 19.5921 42.0003 20.9998 42.0003C22.4075 42.0003 23.5592 40.8486 23.5592 39.4409V38.9766H18.4404Z"
                                        fill="#8479C2" />
                                    <path
                                        d="M20.7316 39.4409V38.9766H18.4404V39.4409C18.4404 40.8485 19.5921 42.0003 20.9998 42.0003C21.411 42.0003 21.8001 41.9015 22.1454 41.7272C21.309 41.3049 20.7316 40.4373 20.7316 39.4409Z"
                                        fill="#6E60B8" />
                                    <path
                                        d="M25.0115 15.875H16.9873C16.6373 15.875 16.3535 15.5912 16.3535 15.2412C16.3535 14.8912 16.6373 14.6074 16.9873 14.6074H25.0115C25.3615 14.6074 25.6453 14.8912 25.6453 15.2412C25.6453 15.5912 25.3615 15.875 25.0115 15.875Z"
                                        fill="#FEC458" />
                                    <path
                                        d="M4.70959 13.5117H2.52928C2.17925 13.5117 1.89551 13.2279 1.89551 12.8779C1.89551 12.5279 2.17925 12.2441 2.52928 12.2441H4.70959C5.05962 12.2441 5.34336 12.5279 5.34336 12.8779C5.34336 13.2279 5.05962 13.5117 4.70959 13.5117Z"
                                        fill="#FEC458" />
                                    <path
                                        d="M5.33133 9.48934L3.29286 8.7157C2.96564 8.59151 2.801 8.22548 2.92519 7.89826C3.04947 7.57104 3.41533 7.40656 3.74264 7.5306L5.78111 8.30423C6.10833 8.42843 6.27297 8.79445 6.14878 9.12167C6.02466 9.44865 5.65897 9.61345 5.33133 9.48934Z"
                                        fill="#FEC458" />
                                    <path
                                        d="M2.92519 17.8571C2.801 17.5299 2.96564 17.1639 3.29286 17.0397L5.33133 16.266C5.65839 16.1418 6.02458 16.3064 6.14878 16.6337C6.27297 16.9609 6.10833 17.3269 5.78111 17.4511L3.74264 18.2248C3.41533 18.349 3.04947 18.1844 2.92519 17.8571Z"
                                        fill="#FEC458" />
                                    <path
                                        d="M39.4703 13.5117H37.29C36.94 13.5117 36.6562 13.2279 36.6562 12.8779C36.6562 12.5279 36.94 12.2441 37.29 12.2441H39.4703C39.8204 12.2441 40.1041 12.5279 40.1041 12.8779C40.1041 13.2279 39.8204 13.5117 39.4703 13.5117Z"
                                        fill="#FEC458" />
                                    <path
                                        d="M35.85 9.12172C35.7258 8.79449 35.8904 8.42847 36.2177 8.30428L38.2561 7.53064C38.5832 7.40653 38.9494 7.571 39.0736 7.8983C39.1978 8.22553 39.0331 8.59155 38.7059 8.71574L36.6675 9.48946C36.3401 9.61358 35.9743 9.44902 35.85 9.12172Z"
                                        fill="#FEC458" />
                                    <path
                                        d="M38.2561 18.2248L36.2177 17.4511C35.8904 17.3269 35.7258 16.9609 35.85 16.6337C35.9743 16.3065 36.3401 16.1418 36.6674 16.266L38.7059 17.0397C39.0331 17.1638 39.1978 17.5299 39.0736 17.8571C38.9494 18.1841 38.5837 18.3489 38.2561 18.2248Z"
                                        fill="#FEC458" />
                                    <path
                                        d="M25.3445 35.8613H16.6545C16.048 35.8613 15.5547 36.3547 15.5547 36.961V37.8972C15.5547 38.5036 16.048 38.9969 16.6545 38.9969H25.3446C25.951 38.9969 26.4443 38.5036 26.4443 37.8972V36.961C26.4443 36.3547 25.951 35.8613 25.3445 35.8613Z"
                                        fill="#EFECEF" />
                                    <path
                                        d="M25.3445 37.4294H16.6545C16.1579 37.4294 15.7375 37.0983 15.6014 36.6455C15.5713 36.7457 15.5547 36.8516 15.5547 36.9613V37.8975C15.5547 38.5038 16.048 38.9972 16.6545 38.9972H25.3446C25.951 38.9972 26.4443 38.5038 26.4443 37.8975V36.9613C26.4443 36.8515 26.4277 36.7456 26.3976 36.6455C26.2615 37.0983 25.8412 37.4294 25.3445 37.4294Z"
                                        fill="#E2DFE2" />
                                    <path
                                        d="M26.189 32.7686H15.8097C15.2033 32.7686 14.71 33.2619 14.71 33.8683V34.8044C14.71 35.4109 15.2033 35.9042 15.8097 35.9042H26.189C26.7955 35.9042 27.2888 35.4109 27.2888 34.8044V33.8683C27.2888 33.2619 26.7955 32.7686 26.189 32.7686Z"
                                        fill="#EFECEF" />
                                    <path
                                        d="M26.1891 34.3357H15.8098C15.3131 34.3357 14.8928 34.0047 14.7567 33.5518C14.7266 33.6519 14.71 33.7578 14.71 33.8676V34.8037C14.71 35.4102 15.2033 35.9035 15.8097 35.9035H26.189C26.7955 35.9035 27.2888 35.4102 27.2888 34.8037V33.8676C27.2888 33.7577 27.2721 33.6519 27.242 33.5518C27.106 34.0047 26.6857 34.3357 26.1891 34.3357Z"
                                        fill="#E2DFE2" />
                                    <path
                                        d="M26.189 29.6748H15.8097C15.2033 29.6748 14.71 30.1681 14.71 30.7746V31.7107C14.71 32.3171 15.2033 32.8104 15.8097 32.8104H26.189C26.7955 32.8104 27.2888 32.3171 27.2888 31.7107V30.7746C27.2888 30.1681 26.7955 29.6748 26.189 29.6748Z"
                                        fill="#EFECEF" />
                                    <path
                                        d="M26.1891 31.2429H15.8098C15.3131 31.2429 14.8928 30.9118 14.7567 30.459C14.7266 30.5591 14.71 30.665 14.71 30.7748V31.7109C14.71 32.3173 15.2033 32.8107 15.8097 32.8107H26.189C26.7955 32.8107 27.2888 32.3173 27.2888 31.7109V30.7748C27.2888 30.665 27.2721 30.5591 27.242 30.459C27.106 30.9118 26.6857 31.2429 26.1891 31.2429Z"
                                        fill="#E2DFE2" />
                                </g>
                                <defs>
                                    <clipPath id="clip0_1232_1218">
                                        <rect width="42" height="42" fill="white" />
                                    </clipPath>
                                </defs>
                            </svg>
                            <div class="ml-3">
                                <h3 class="name m-0">Hi {{ $user->first_name }}</h3>
                                <p class="mb-0">Here is better alternative option for your description</p>
                            </div>
                        </div>
                        <div id="open-ai-content" class="open-ai-content">

                        </div>
                        <div class="footer_wraper d-flex align-items-center">
                            <button type="button" id="copy-description" class="use_this_btn btn w-100 py-lg-30">Use this
                                content</button>
                            <button type="button" id="regenerate-description"
                                class="ai_description btn regenerate_btn w-100 py-lg-30">Regenerate</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="col-md-6">
            <label for="">{{ trans('label.searching_for') }}
                <span style="color: red">*</span>
            </label>
            {!! Form::textarea('searching_for', $seekerDetails->searching_for ?? null, [
                'class' => 'form-control ' . (isset($errors) && $errors->has('searching_for') ? 'is-invalid' : ''),
                'placeholder' => trans('message.searching_for_text'),
                'rows' => 3,
            ]) !!}

        </div> --}}
    </div>

    <div class="experience-field-wrapper mt-40">
        <div class="d-flex align-items-center justify-content-between profile_box mb-35">
            <h3 class="mb-0">Experience</h3>
            <button type="button" class="exp-add-field edit_btn_link p-0 border-top-0 border-left-0 border-right-0">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16"
                    fill="none">
                    <path d="M7.99998 1.58331V14.4166M1.58331 7.99998H14.4166" stroke="#fff" stroke-width="1.5"
                        stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
                {{ trans('label.add_more') }}
            </button>
        </div>
        <div class="experience-fields">
            @if (!empty($experiencesData) && is_iterable($experiencesData))
                @foreach ($experiencesData as $key => $value)
                    <div class="row experience-field">
                        {!! Form::hidden("exp_id[$key]", old("exp_id.$key", $value->id ?? 0), ['class' => 'form-control']) !!}

                        <div class="d-flex align-items-center justify-content-end col-12">
                            <button type="button" id="remove-button"
                                class="edit_btn_link @if ($key == 0) d-none @endif exp-remove-field text-danger justify-content-end border-0 p-0">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="18"
                                    viewBox="0 0 18 20" fill="none">
                                    <path
                                        d="M12.5556 4.6V3.88C12.5556 2.87191 12.5556 2.36786 12.3618 1.98282C12.1913 1.64413 11.9194 1.36876 11.5849 1.19619C11.2046 1 10.7068 1 9.71111 1H8.28889C7.29324 1 6.79542 1 6.41513 1.19619C6.08062 1.36876 5.80865 1.64413 5.63821 1.98282C5.44444 2.36786 5.44444 2.87191 5.44444 3.88V4.6M7.22222 9.55V14.05M10.7778 9.55V14.05M1 4.6H17M15.2222 4.6V14.68C15.2222 16.1921 15.2222 16.9482 14.9316 17.5258C14.6759 18.0338 14.268 18.4469 13.7662 18.7057C13.1958 19 12.449 19 10.9556 19H7.04445C5.55097 19 4.80423 19 4.2338 18.7057C3.73204 18.4469 3.32409 18.0338 3.06843 17.5258C2.77778 16.9482 2.77778 16.1921 2.77778 14.68V4.6"
                                        stroke="#ff7d57" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round"></path>
                                </svg>{{ trans('label.delete') }}

                            </button>
                        </div>
                        <div class="row w-100 mx-0">
                            <div class="col-lg-7">
                                <div class="row">
                                    <div class="form-group col-md-6 mb-4">
                                        <label for="">{{ trans('label.company') }}</label>
                                        {!! Form::text(
                                            "company[$key]",
                                            old("company.$key", $value->company ?? null),
                                            [
                                                'class' => 'form-control',
                                                'placeholder' => trans('label.company'),
                                            ],
                                        ) !!}

                                    </div>
                                    <div class="form-group mb-4 col-md-6">
                                        <label for="">{{ trans('label.designation') }}</label>
                                        {!! Form::text("role[$key]", old("role.$key", $value->role ?? null), [
                                            'class' => 'form-control',
                                            'placeholder' => trans('label.designation'),
                                        ]) !!}

                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-5 form-group mb-4 col-md-6">
                                <label for="">{{ trans('label.employer_view.location') }}</label>
                                {!! Form::text("location[$key]", old("location.$key", $value->location ?? null), [
                                    'class' => 'form-control',
                                    'placeholder' => trans('label.employer_view.location'),
                                ]) !!}

                            </div>
                        </div>
                        <div class="col-12">
                            @include('auth.job_seeker.partials.joing_leaving_date', [
                                'key' => $key,
                                'value' => $value,
                            ])
                            <label for="" class="mb-3 ">
                                <input type="checkbox" id="currently_working" class="mr-1 currently_working"
                                    name="currently_working[{{$key}}]" value="1" {{($value->currently_working ?? 0) == 1 ?
                                "checked":''}} />{{trans('label.currently_working')}}
                            </label>
                        </div>

                        <div class="col-md-6 description-container">
                            <div>
                                <label for="">{{ trans('label.roles_achievements') }}</label>
                                {!! Form::textarea("description[$key]", old("description.$key", $value->description ?? null), [
                                    'rows' => 4,
                                    'class' => 'form-control',
                                    'placeholder' => trans('label.roles_achievements'),
                                    'richtexteditor' => true,
                                    'id' => 'description-'.$key,
                                ]) !!}
                            </div>
                            <div class="mt-4">
                                {{-- <input type="button" id="steptwo" name="next" class="next btn btn-primary" value="Click Here to See Your New Career Summary" /> --}}
                                {{-- <a href="javascript:void(0)"  class="next chatgpt-generate-button-expr btn btn-primary" data-id={{$key}} data-name="chatgpt-generate-button-expr">Click Here to See Your New Career Summary</a> --}}
                            </div>
                        </div>
                        <div class="col-md-6 mb-40  pr-0" id="open-ai-wrapper">
                            {{-- <div class="ai_main_wraper mt-25 position-relative">
                                <img src="{{ asset('images/ai_bg.png') }}" class="ai_wraper_img d-none d-lg-block" alt="your_image"
                                    width="100%">
                                <div class="header_wraper d-flex align-items-center mb-22">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="42" height="42" viewBox="0 0 42 42"
                                        fill="none">
                                        <g clip-path="url(#clip0_1232_1218)">
                                            <path
                                                d="M21.0177 1.14288e-05C13.7258 -0.0095042 7.7841 5.92423 7.78418 13.2161C7.78426 18.0636 10.3945 22.3009 14.2858 24.6006C14.9768 25.009 15.395 25.7574 15.395 26.5601V29.7792C15.5229 29.7257 15.6633 29.696 15.8105 29.696H26.1898C26.3371 29.696 26.4774 29.7257 26.6053 29.7792V26.56C26.6053 25.7479 27.0391 25.0017 27.7375 24.5871C31.6161 22.2841 34.216 18.0541 34.216 13.2161C34.2161 5.92283 28.3086 0.00952705 21.0177 1.14288e-05Z"
                                                fill="#FFE181" />
                                            <path
                                                d="M18.8879 26.5601C18.8879 25.7575 18.4697 25.009 17.7787 24.6006C13.8874 22.3008 11.2772 18.0636 11.2771 13.2161C11.277 6.52109 16.2861 0.971754 22.75 0.115347C22.183 0.0403708 21.605 0.000831741 21.0178 1.1429e-05C13.7259 -0.0095042 7.7841 5.92414 7.78418 13.2161C7.78426 18.0636 10.3945 22.3009 14.2858 24.6006C14.9768 25.009 15.395 25.7575 15.395 26.5601V29.7792C15.5229 29.7257 15.6633 29.696 15.8105 29.696H18.8879V26.5601Z"
                                                fill="#FEC458" />
                                            <path
                                                d="M22.6553 30.3297C22.3052 30.3297 22.0215 30.046 22.0215 29.696V24.0238C22.0215 23.4538 22.2134 22.8915 22.5618 22.4403L23.4688 21.2661C23.6467 21.0357 23.7447 20.7486 23.7447 20.4574V14.5381C23.7447 14.188 24.0285 13.9043 24.3785 13.9043C24.7285 13.9043 25.0123 14.188 25.0123 14.5381V20.4574C25.0123 21.0275 24.8203 21.5898 24.4719 22.041L23.565 23.2152C23.387 23.4456 23.289 23.7327 23.289 24.0238V29.696C23.289 30.046 23.0053 30.3297 22.6553 30.3297Z"
                                                fill="#FFB640" />
                                            <path
                                                d="M19.3444 30.3297C18.9944 30.3297 18.7106 30.046 18.7106 29.696V24.0238C18.7106 23.7328 18.6126 23.4456 18.4347 23.2152L17.5276 22.041C17.1793 21.5899 16.9873 21.0275 16.9873 20.4574V14.5381C16.9873 14.188 17.2711 13.9043 17.6211 13.9043C17.9711 13.9043 18.2549 14.188 18.2549 14.5381V20.4574C18.2549 20.7486 18.3529 21.0357 18.5308 21.266L19.4378 22.4402C19.7863 22.8914 19.9782 23.4538 19.9782 24.0238V29.6959C19.9782 30.046 19.6944 30.3297 19.3444 30.3297Z"
                                                fill="#FFB640" />
                                            <path
                                                d="M30.2195 10.6285C29.5337 8.07266 27.7716 5.93558 25.3852 4.7654C25.0709 4.61127 24.9411 4.23154 25.0951 3.91737C25.2492 3.6031 25.6291 3.47333 25.9431 3.6273C28.6581 4.95859 30.6631 7.39073 31.4438 10.3C31.5345 10.638 31.3339 10.9857 30.9959 11.0764C30.6581 11.1671 30.3102 10.9668 30.2195 10.6285Z"
                                                fill="#FFEAC8" />
                                            <path
                                                d="M18.4404 38.9766V39.4409C18.4404 40.8485 19.5921 42.0003 20.9998 42.0003C22.4075 42.0003 23.5592 40.8486 23.5592 39.4409V38.9766H18.4404Z"
                                                fill="#8479C2" />
                                            <path
                                                d="M20.7316 39.4409V38.9766H18.4404V39.4409C18.4404 40.8485 19.5921 42.0003 20.9998 42.0003C21.411 42.0003 21.8001 41.9015 22.1454 41.7272C21.309 41.3049 20.7316 40.4373 20.7316 39.4409Z"
                                                fill="#6E60B8" />
                                            <path
                                                d="M25.0115 15.875H16.9873C16.6373 15.875 16.3535 15.5912 16.3535 15.2412C16.3535 14.8912 16.6373 14.6074 16.9873 14.6074H25.0115C25.3615 14.6074 25.6453 14.8912 25.6453 15.2412C25.6453 15.5912 25.3615 15.875 25.0115 15.875Z"
                                                fill="#FEC458" />
                                            <path
                                                d="M4.70959 13.5117H2.52928C2.17925 13.5117 1.89551 13.2279 1.89551 12.8779C1.89551 12.5279 2.17925 12.2441 2.52928 12.2441H4.70959C5.05962 12.2441 5.34336 12.5279 5.34336 12.8779C5.34336 13.2279 5.05962 13.5117 4.70959 13.5117Z"
                                                fill="#FEC458" />
                                            <path
                                                d="M5.33133 9.48934L3.29286 8.7157C2.96564 8.59151 2.801 8.22548 2.92519 7.89826C3.04947 7.57104 3.41533 7.40656 3.74264 7.5306L5.78111 8.30423C6.10833 8.42843 6.27297 8.79445 6.14878 9.12167C6.02466 9.44865 5.65897 9.61345 5.33133 9.48934Z"
                                                fill="#FEC458" />
                                            <path
                                                d="M2.92519 17.8571C2.801 17.5299 2.96564 17.1639 3.29286 17.0397L5.33133 16.266C5.65839 16.1418 6.02458 16.3064 6.14878 16.6337C6.27297 16.9609 6.10833 17.3269 5.78111 17.4511L3.74264 18.2248C3.41533 18.349 3.04947 18.1844 2.92519 17.8571Z"
                                                fill="#FEC458" />
                                            <path
                                                d="M39.4703 13.5117H37.29C36.94 13.5117 36.6562 13.2279 36.6562 12.8779C36.6562 12.5279 36.94 12.2441 37.29 12.2441H39.4703C39.8204 12.2441 40.1041 12.5279 40.1041 12.8779C40.1041 13.2279 39.8204 13.5117 39.4703 13.5117Z"
                                                fill="#FEC458" />
                                            <path
                                                d="M35.85 9.12172C35.7258 8.79449 35.8904 8.42847 36.2177 8.30428L38.2561 7.53064C38.5832 7.40653 38.9494 7.571 39.0736 7.8983C39.1978 8.22553 39.0331 8.59155 38.7059 8.71574L36.6675 9.48946C36.3401 9.61358 35.9743 9.44902 35.85 9.12172Z"
                                                fill="#FEC458" />
                                            <path
                                                d="M38.2561 18.2248L36.2177 17.4511C35.8904 17.3269 35.7258 16.9609 35.85 16.6337C35.9743 16.3065 36.3401 16.1418 36.6674 16.266L38.7059 17.0397C39.0331 17.1638 39.1978 17.5299 39.0736 17.8571C38.9494 18.1841 38.5837 18.3489 38.2561 18.2248Z"
                                                fill="#FEC458" />
                                            <path
                                                d="M25.3445 35.8613H16.6545C16.048 35.8613 15.5547 36.3547 15.5547 36.961V37.8972C15.5547 38.5036 16.048 38.9969 16.6545 38.9969H25.3446C25.951 38.9969 26.4443 38.5036 26.4443 37.8972V36.961C26.4443 36.3547 25.951 35.8613 25.3445 35.8613Z"
                                                fill="#EFECEF" />
                                            <path
                                                d="M25.3445 37.4294H16.6545C16.1579 37.4294 15.7375 37.0983 15.6014 36.6455C15.5713 36.7457 15.5547 36.8516 15.5547 36.9613V37.8975C15.5547 38.5038 16.048 38.9972 16.6545 38.9972H25.3446C25.951 38.9972 26.4443 38.5038 26.4443 37.8975V36.9613C26.4443 36.8515 26.4277 36.7456 26.3976 36.6455C26.2615 37.0983 25.8412 37.4294 25.3445 37.4294Z"
                                                fill="#E2DFE2" />
                                            <path
                                                d="M26.189 32.7686H15.8097C15.2033 32.7686 14.71 33.2619 14.71 33.8683V34.8044C14.71 35.4109 15.2033 35.9042 15.8097 35.9042H26.189C26.7955 35.9042 27.2888 35.4109 27.2888 34.8044V33.8683C27.2888 33.2619 26.7955 32.7686 26.189 32.7686Z"
                                                fill="#EFECEF" />
                                            <path
                                                d="M26.1891 34.3357H15.8098C15.3131 34.3357 14.8928 34.0047 14.7567 33.5518C14.7266 33.6519 14.71 33.7578 14.71 33.8676V34.8037C14.71 35.4102 15.2033 35.9035 15.8097 35.9035H26.189C26.7955 35.9035 27.2888 35.4102 27.2888 34.8037V33.8676C27.2888 33.7577 27.2721 33.6519 27.242 33.5518C27.106 34.0047 26.6857 34.3357 26.1891 34.3357Z"
                                                fill="#E2DFE2" />
                                            <path
                                                d="M26.189 29.6748H15.8097C15.2033 29.6748 14.71 30.1681 14.71 30.7746V31.7107C14.71 32.3171 15.2033 32.8104 15.8097 32.8104H26.189C26.7955 32.8104 27.2888 32.3171 27.2888 31.7107V30.7746C27.2888 30.1681 26.7955 29.6748 26.189 29.6748Z"
                                                fill="#EFECEF" />
                                            <path
                                                d="M26.1891 31.2429H15.8098C15.3131 31.2429 14.8928 30.9118 14.7567 30.459C14.7266 30.5591 14.71 30.665 14.71 30.7748V31.7109C14.71 32.3173 15.2033 32.8107 15.8097 32.8107H26.189C26.7955 32.8107 27.2888 32.3173 27.2888 31.7109V30.7748C27.2888 30.665 27.2721 30.5591 27.242 30.459C27.106 30.9118 26.6857 31.2429 26.1891 31.2429Z"
                                                fill="#E2DFE2" />
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_1232_1218">
                                                <rect width="42" height="42" fill="white" />
                                            </clipPath>
                                        </defs>
                                    </svg>
                                    <div class="ml-3">
                                        <h3 class="name m-0">Hi {{ $user->first_name }}</h3>
                                        <p class="mb-0">Here is better alternative option for your description</p>
                                    </div>
                                </div>
                                <div id="open-ai-content-{{$key}}" class="open-ai-content">

                                </div>
                                <div class="footer_wraper d-flex align-items-center">
                                    <button type="button" id="copy-description-{{$key}}" data-copy-id="{{$key}}" class="copy_description use_this_btn btn w-100 py-lg-30" onclick="copyText(this);">Use this content</button>
                                    <button type="button" id="regenerate-description-{{$key}}" data-regenerate-id="{{$key}}"
                                        class="ai_description ai_description_generate btn regenerate_btn w-100 py-lg-30" onclick="reGenerateText(this);">Regenerate</button>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                @endforeach
            @else
                @empty($experiencesData)
                    <div class="row experience-field">
                        <div class="d-flex align-items-center justify-content-end col-12">
                            <button type="button" id="remove-button"
                                class="edit_btn_link d-none exp-remove-field text-danger justify-content-end border-0 p-0">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="18"
                                    viewBox="0 0 18 20" fill="none">
                                    <path
                                        d="M12.5556 4.6V3.88C12.5556 2.87191 12.5556 2.36786 12.3618 1.98282C12.1913 1.64413 11.9194 1.36876 11.5849 1.19619C11.2046 1 10.7068 1 9.71111 1H8.28889C7.29324 1 6.79542 1 6.41513 1.19619C6.08062 1.36876 5.80865 1.64413 5.63821 1.98282C5.44444 2.36786 5.44444 2.87191 5.44444 3.88V4.6M7.22222 9.55V14.05M10.7778 9.55V14.05M1 4.6H17M15.2222 4.6V14.68C15.2222 16.1921 15.2222 16.9482 14.9316 17.5258C14.6759 18.0338 14.268 18.4469 13.7662 18.7057C13.1958 19 12.449 19 10.9556 19H7.04445C5.55097 19 4.80423 19 4.2338 18.7057C3.73204 18.4469 3.32409 18.0338 3.06843 17.5258C2.77778 16.9482 2.77778 16.1921 2.77778 14.68V4.6"
                                        stroke="#ff7d57" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round"></path>
                                </svg>{{ trans('label.delete') }}

                            </button>
                        </div>
                        {!! Form::hidden('exp_id[]', 0, ['class' => 'form-control']) !!}
                        <div class="form-group col-md-6 col-lg-4 mb-4">
                            <label for="">{{ trans('label.current_organization') }}</label>
                            {!! Form::text('company[]', null, [
                                'class' => 'form-control',
                                'placeholder' => trans('label.current_organization'),
                            ]) !!}


                        </div>
                        <div class="form-group mb-4 col-md-6 col-lg-4">
                            <label for="">{{ trans('label.designation') }}</label>
                            {!! Form::text('role[]', null, ['class' => 'form-control', 'placeholder' => trans('label.designation')]) !!}


                        </div>
                        <div class="form-group mb-4 col-md-6 col-lg-4">
                            <label for="">{{ trans('label.employer_view.location') }}</label>
                            {!! Form::text('location[]', '', [
                                'class' => 'form-control',
                                'placeholder' => trans('label.employer_view.location'),
                            ]) !!}
                        </div>
                        <div class="col-12">
                            @include('auth.job_seeker.partials.joing_leaving_date', ['key' => 0])
                            <label for="" class="mb-3 ">
                                <input type="checkbox" class="mr-1 currently_working" name="currently_working[]"
                                    {{($value->currently_working ?? 0) == 1 ? "checked":''}}
                                value="1" />{{trans('label.currently_working')}}
                            </label>
                        </div>

                        <div class="form-group mb-4 col-md-6">
                            <div>
                                <label for="">{{ trans('label.roles_achievements') }}</label>

                            {!! Form::textarea('description[]', null, [
                                'richtexteditor' => true,
                                'rows' => 4,
                                'class' => 'form-control',
                                'placeholder' => trans('label.roles_achievements'),
                                'id' => 'description-0', // Assign a unique ID to the textarea
                            ]) !!}
                            </div>
                            <div class="mt-4">
                                {{-- <input type="button" id="steptwo" name="next" class="next btn btn-primary" value="Click Here to See Your New Career Summary" /> --}}
                                {{-- <a href="javascript:void(0)"  class="next chatgpt-generate-button-expr btn btn-primary" data-id=0 data-name="chatgpt-generate-button-expr">Click Here to See Your New Career Summary</a> --}}
                            </div>
                        </div>
                        {{-- <div class="col-md-6 mb-40  pr-0" id="open-ai-wrapper">
                            <div class="ai_main_wraper mt-25 position-relative">
                                <img src="{{ asset('images/ai_bg.png') }}" class="ai_wraper_img d-none d-lg-block" alt="your_image"
                                    width="100%">
                                <div class="header_wraper d-flex align-items-center mb-22">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="42" height="42" viewBox="0 0 42 42"
                                        fill="none">
                                        <g clip-path="url(#clip0_1232_1218)">
                                            <path
                                                d="M21.0177 1.14288e-05C13.7258 -0.0095042 7.7841 5.92423 7.78418 13.2161C7.78426 18.0636 10.3945 22.3009 14.2858 24.6006C14.9768 25.009 15.395 25.7574 15.395 26.5601V29.7792C15.5229 29.7257 15.6633 29.696 15.8105 29.696H26.1898C26.3371 29.696 26.4774 29.7257 26.6053 29.7792V26.56C26.6053 25.7479 27.0391 25.0017 27.7375 24.5871C31.6161 22.2841 34.216 18.0541 34.216 13.2161C34.2161 5.92283 28.3086 0.00952705 21.0177 1.14288e-05Z"
                                                fill="#FFE181" />
                                            <path
                                                d="M18.8879 26.5601C18.8879 25.7575 18.4697 25.009 17.7787 24.6006C13.8874 22.3008 11.2772 18.0636 11.2771 13.2161C11.277 6.52109 16.2861 0.971754 22.75 0.115347C22.183 0.0403708 21.605 0.000831741 21.0178 1.1429e-05C13.7259 -0.0095042 7.7841 5.92414 7.78418 13.2161C7.78426 18.0636 10.3945 22.3009 14.2858 24.6006C14.9768 25.009 15.395 25.7575 15.395 26.5601V29.7792C15.5229 29.7257 15.6633 29.696 15.8105 29.696H18.8879V26.5601Z"
                                                fill="#FEC458" />
                                            <path
                                                d="M22.6553 30.3297C22.3052 30.3297 22.0215 30.046 22.0215 29.696V24.0238C22.0215 23.4538 22.2134 22.8915 22.5618 22.4403L23.4688 21.2661C23.6467 21.0357 23.7447 20.7486 23.7447 20.4574V14.5381C23.7447 14.188 24.0285 13.9043 24.3785 13.9043C24.7285 13.9043 25.0123 14.188 25.0123 14.5381V20.4574C25.0123 21.0275 24.8203 21.5898 24.4719 22.041L23.565 23.2152C23.387 23.4456 23.289 23.7327 23.289 24.0238V29.696C23.289 30.046 23.0053 30.3297 22.6553 30.3297Z"
                                                fill="#FFB640" />
                                            <path
                                                d="M19.3444 30.3297C18.9944 30.3297 18.7106 30.046 18.7106 29.696V24.0238C18.7106 23.7328 18.6126 23.4456 18.4347 23.2152L17.5276 22.041C17.1793 21.5899 16.9873 21.0275 16.9873 20.4574V14.5381C16.9873 14.188 17.2711 13.9043 17.6211 13.9043C17.9711 13.9043 18.2549 14.188 18.2549 14.5381V20.4574C18.2549 20.7486 18.3529 21.0357 18.5308 21.266L19.4378 22.4402C19.7863 22.8914 19.9782 23.4538 19.9782 24.0238V29.6959C19.9782 30.046 19.6944 30.3297 19.3444 30.3297Z"
                                                fill="#FFB640" />
                                            <path
                                                d="M30.2195 10.6285C29.5337 8.07266 27.7716 5.93558 25.3852 4.7654C25.0709 4.61127 24.9411 4.23154 25.0951 3.91737C25.2492 3.6031 25.6291 3.47333 25.9431 3.6273C28.6581 4.95859 30.6631 7.39073 31.4438 10.3C31.5345 10.638 31.3339 10.9857 30.9959 11.0764C30.6581 11.1671 30.3102 10.9668 30.2195 10.6285Z"
                                                fill="#FFEAC8" />
                                            <path
                                                d="M18.4404 38.9766V39.4409C18.4404 40.8485 19.5921 42.0003 20.9998 42.0003C22.4075 42.0003 23.5592 40.8486 23.5592 39.4409V38.9766H18.4404Z"
                                                fill="#8479C2" />
                                            <path
                                                d="M20.7316 39.4409V38.9766H18.4404V39.4409C18.4404 40.8485 19.5921 42.0003 20.9998 42.0003C21.411 42.0003 21.8001 41.9015 22.1454 41.7272C21.309 41.3049 20.7316 40.4373 20.7316 39.4409Z"
                                                fill="#6E60B8" />
                                            <path
                                                d="M25.0115 15.875H16.9873C16.6373 15.875 16.3535 15.5912 16.3535 15.2412C16.3535 14.8912 16.6373 14.6074 16.9873 14.6074H25.0115C25.3615 14.6074 25.6453 14.8912 25.6453 15.2412C25.6453 15.5912 25.3615 15.875 25.0115 15.875Z"
                                                fill="#FEC458" />
                                            <path
                                                d="M4.70959 13.5117H2.52928C2.17925 13.5117 1.89551 13.2279 1.89551 12.8779C1.89551 12.5279 2.17925 12.2441 2.52928 12.2441H4.70959C5.05962 12.2441 5.34336 12.5279 5.34336 12.8779C5.34336 13.2279 5.05962 13.5117 4.70959 13.5117Z"
                                                fill="#FEC458" />
                                            <path
                                                d="M5.33133 9.48934L3.29286 8.7157C2.96564 8.59151 2.801 8.22548 2.92519 7.89826C3.04947 7.57104 3.41533 7.40656 3.74264 7.5306L5.78111 8.30423C6.10833 8.42843 6.27297 8.79445 6.14878 9.12167C6.02466 9.44865 5.65897 9.61345 5.33133 9.48934Z"
                                                fill="#FEC458" />
                                            <path
                                                d="M2.92519 17.8571C2.801 17.5299 2.96564 17.1639 3.29286 17.0397L5.33133 16.266C5.65839 16.1418 6.02458 16.3064 6.14878 16.6337C6.27297 16.9609 6.10833 17.3269 5.78111 17.4511L3.74264 18.2248C3.41533 18.349 3.04947 18.1844 2.92519 17.8571Z"
                                                fill="#FEC458" />
                                            <path
                                                d="M39.4703 13.5117H37.29C36.94 13.5117 36.6562 13.2279 36.6562 12.8779C36.6562 12.5279 36.94 12.2441 37.29 12.2441H39.4703C39.8204 12.2441 40.1041 12.5279 40.1041 12.8779C40.1041 13.2279 39.8204 13.5117 39.4703 13.5117Z"
                                                fill="#FEC458" />
                                            <path
                                                d="M35.85 9.12172C35.7258 8.79449 35.8904 8.42847 36.2177 8.30428L38.2561 7.53064C38.5832 7.40653 38.9494 7.571 39.0736 7.8983C39.1978 8.22553 39.0331 8.59155 38.7059 8.71574L36.6675 9.48946C36.3401 9.61358 35.9743 9.44902 35.85 9.12172Z"
                                                fill="#FEC458" />
                                            <path
                                                d="M38.2561 18.2248L36.2177 17.4511C35.8904 17.3269 35.7258 16.9609 35.85 16.6337C35.9743 16.3065 36.3401 16.1418 36.6674 16.266L38.7059 17.0397C39.0331 17.1638 39.1978 17.5299 39.0736 17.8571C38.9494 18.1841 38.5837 18.3489 38.2561 18.2248Z"
                                                fill="#FEC458" />
                                            <path
                                                d="M25.3445 35.8613H16.6545C16.048 35.8613 15.5547 36.3547 15.5547 36.961V37.8972C15.5547 38.5036 16.048 38.9969 16.6545 38.9969H25.3446C25.951 38.9969 26.4443 38.5036 26.4443 37.8972V36.961C26.4443 36.3547 25.951 35.8613 25.3445 35.8613Z"
                                                fill="#EFECEF" />
                                            <path
                                                d="M25.3445 37.4294H16.6545C16.1579 37.4294 15.7375 37.0983 15.6014 36.6455C15.5713 36.7457 15.5547 36.8516 15.5547 36.9613V37.8975C15.5547 38.5038 16.048 38.9972 16.6545 38.9972H25.3446C25.951 38.9972 26.4443 38.5038 26.4443 37.8975V36.9613C26.4443 36.8515 26.4277 36.7456 26.3976 36.6455C26.2615 37.0983 25.8412 37.4294 25.3445 37.4294Z"
                                                fill="#E2DFE2" />
                                            <path
                                                d="M26.189 32.7686H15.8097C15.2033 32.7686 14.71 33.2619 14.71 33.8683V34.8044C14.71 35.4109 15.2033 35.9042 15.8097 35.9042H26.189C26.7955 35.9042 27.2888 35.4109 27.2888 34.8044V33.8683C27.2888 33.2619 26.7955 32.7686 26.189 32.7686Z"
                                                fill="#EFECEF" />
                                            <path
                                                d="M26.1891 34.3357H15.8098C15.3131 34.3357 14.8928 34.0047 14.7567 33.5518C14.7266 33.6519 14.71 33.7578 14.71 33.8676V34.8037C14.71 35.4102 15.2033 35.9035 15.8097 35.9035H26.189C26.7955 35.9035 27.2888 35.4102 27.2888 34.8037V33.8676C27.2888 33.7577 27.2721 33.6519 27.242 33.5518C27.106 34.0047 26.6857 34.3357 26.1891 34.3357Z"
                                                fill="#E2DFE2" />
                                            <path
                                                d="M26.189 29.6748H15.8097C15.2033 29.6748 14.71 30.1681 14.71 30.7746V31.7107C14.71 32.3171 15.2033 32.8104 15.8097 32.8104H26.189C26.7955 32.8104 27.2888 32.3171 27.2888 31.7107V30.7746C27.2888 30.1681 26.7955 29.6748 26.189 29.6748Z"
                                                fill="#EFECEF" />
                                            <path
                                                d="M26.1891 31.2429H15.8098C15.3131 31.2429 14.8928 30.9118 14.7567 30.459C14.7266 30.5591 14.71 30.665 14.71 30.7748V31.7109C14.71 32.3173 15.2033 32.8107 15.8097 32.8107H26.189C26.7955 32.8107 27.2888 32.3173 27.2888 31.7109V30.7748C27.2888 30.665 27.2721 30.5591 27.242 30.459C27.106 30.9118 26.6857 31.2429 26.1891 31.2429Z"
                                                fill="#E2DFE2" />
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_1232_1218">
                                                <rect width="42" height="42" fill="white" />
                                            </clipPath>
                                        </defs>
                                    </svg>
                                    <div class="ml-3">
                                        <h3 class="name m-0">Hi {{ $user->first_name }}</h3>
                                        <p class="mb-0">Here is better alternative option for your description</p>
                                    </div>
                                </div>
                                <div id="open-ai-content-0" class="open-ai-content">

                                </div>
                                <div class="footer_wraper d-flex align-items-center">
                                    <button type="button" id="copy-description-0" data-copy-id="0" class="copy_description use_this_btn btn w-100 py-lg-30">Use this content</button>
                                    <button type="button" id="regenerate-description-0" data-regenerate-id="0" class="ai_description ai_description_generate  btn regenerate_btn w-100 py-lg-30" onclick="reGenerateText(this);">Regenerate</button>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                @endempty
            @endempty
        </div>
    </div>

    @include('resume_builder.fields_step4')

    {{-- <div class="col-md-6  mb-4">
        <label for="">{{ trans('label.skills') }}
            <span style="color: red">*</span>
        </label>
        {!! Form::select('skill_id[]', $skills ?? null, $skillsData, [
                'class' => 'form-control select-with-tag' . (isset($errors) && $errors->has('skill_id') ? 'is-invalid' : ''),
                'data-placeholder' => trans('label.choose_one'),
                'multiple' => true,
            ])
        !!}
    </div> --}}

    <div class="d-flex align-items-center  justify-content-between flex-wrap mt-50 pt-50 border-top ">
        <a href="{{ route('resume-builder.editStep',['userId' => $userId, 'step' => $step - 1]) }}" id="stepTwoPrev" class="btn-outline-primary btn mb-4 mb-lg-0"><svg style="margin-right: 12px" xmlns="http://www.w3.org/2000/svg" width="8" height="14" viewBox="0 0 8 14" fill="none">
            <path d="M6.75 12.5L1.25 7L6.75 1.5" stroke="#357DE8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
          </svg> Previous</a>
        <button type="submit" id="stepTwoNext" class="next btn btn-primary">Next <svg style="margin-right: 0; margin-left: 5px;" xmlns="http://www.w3.org/2000/svg" width="23" height="22" viewBox="0 0 23 22" fill="none">
            <path d="M8.75 16.5L14.25 11L8.75 5.5" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </button>
    </div>


</fieldset>
@push('page_scripts')
    <script>
        $(document).ready(function() {
            $(".ai_description").on("click", function() {
                // var $data = JSON.stringify({
                //     product_id: package_id,
                //     quantity: quantity
                // });
                // const form = document.querySelector('form');
                // const data = new FormData(form);
                var formData = $("#frm_resume-builder").serialize();
                var data = JSON.stringify(formData);
                console.log(data);

                processAjaxOperation("{{ route('generate.cv') }}", 'POST', data, 'applicaion/json');
                $('#open-ai-wrapper').removeClass("d-none");
            });
            $("#copy-description").on("click", function() {
                var content = $('#open-ai-content').html();

                $('#searching_for').val(content);
                // CKEDITOR.replace('description');
                // CKEDITOR.instances.description.setData(content);
            });
        });
    </script>
@endpush
@push('page_scripts')
    <script>
        $(document).ready(function() {
            $(".chatgpt-generate-button-expr").on("click", function() {
                // var $data = JSON.stringify({
                //     product_id: package_id,
                //     quantity: quantity
                // });
                // const form = document.querySelector('form');
                // const data = new FormData(form);
                var dataId = $(this).data("id");
                var seekerId = $('#seeker_id').val();

                var editor = CKEDITOR.instances['description-'+dataId];
                var editorContent = editor.getData();

                var companyName = $('input[name="company['+dataId+']"]').val();
                var designation = $('input[name="role['+dataId+']"]').val();
                var location = $('input[name="location['+dataId+']"]').val();
                var fromMonth = $('select[name="from_month['+dataId+']"] option:selected').text();
                var durationFrom = $('select[name="duration_from['+dataId+']"] option:selected').text();
                var toMonth = $('select[name="to_month['+dataId+']"] option:selected').text();
                var durationTo = $('select[name="duration_to['+dataId+']"] option:selected').text();

                var dataObject = {
                    id: dataId,
                    editorValueName: editorContent,
                    seeker_id: seekerId,
                    companyName: companyName,
                    designation: designation,
                    location: location,
                    fromMonth: fromMonth,
                    durationFrom: durationFrom,
                    toMonth: toMonth,
                    durationTo: durationTo
                };


                var data = JSON.stringify(dataObject);

                processAjaxOperation("{{ route('generate.complex.cv') }}", 'POST', data, 'applicaion/json');
                $('#open-ai-wrapper').removeClass("d-none");
            });
            // $("#copy-description").on("click", function() {
            //     var content = $('#open-ai-content').html();

            //     CKEDITOR.replace('description');
            //     CKEDITOR.instances.description.setData(content);
            // });
        });

        function setAIContent(id, content) {
            console.log('comntent', id, content);
            $('.chatgpt-generate-button-expr[data-id='+id+']').closest('.experience-field').find('.open-ai-content').html(content)
        }

        function reGenerateText(clickedButton) {
            var clickedButton = $(clickedButton);
            var id = $(clickedButton).data("regenerate-id");
            var dataId = $(this).data("regenerate-id");
            var seekerId = $('#seeker_id').val();

                var editor = CKEDITOR.instances['description-'+id];
                var editorContent = editor.getData();

                var dataObject = {
                    id: id,
                    editorValueName: editorContent,
                    seeker_id: seekerId
                };


                var data = JSON.stringify(dataObject);

                processAjaxOperation("{{ route('generate.complex.cv') }}", 'POST', data, 'applicaion/json');
            //var closestParentDiv = $clickedButton.parent().parent().parent().prev('.description-container').find('.chatgpt-generate-button-expr').click();
            return;
        }

        function copyText(clickedButton) {
            var $clickedButton = $(clickedButton);
            var id = $(clickedButton).data("copy-id");
            //var id = $clickedButton.parent().parent().parent().prev('.description-container').find('.chatgpt-generate-button-expr').data("id");
            var content = $clickedButton.parent().prev('.open-ai-content').html();
            var editor = CKEDITOR.instances['description-'+id];
                editor.setData(content);
            //alert(content);
            return;
        }
        $(document).ready(function() {
            $('.currently_working').on('change', function() {

            $('.currently_working').not(this).prop('checked', false);
                if (this.checked) {
                    $(this).closest('div').find('.to_duration').hide();
                } else{
                    $(this).closest('div').find('.to_duration').show();
                }
            });
        });
    </script>
@endpush
