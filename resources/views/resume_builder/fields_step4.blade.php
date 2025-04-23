{{-- {!! Form::hidden('step', $step) !!}
<fieldset id="step4" class="job_steps_common"> --}}
    {{-- <h2>Other Information</h2> --}}
    <div class="education-field-wrapper">
        <div class="d-flex mb-35 align-items-center justify-content-between profile_box">
            <h3 class="mb-0">{{ trans('label.education') }}</h3>
            <button type="button" class="edu-add-field edit_btn_link p-0 border-top-0 border-left-0 border-right-0">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16"
                    fill="none">
                    <path d="M7.99998 1.58331V14.4166M1.58331 7.99998H14.4166" stroke="#fff"
                        stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
                {{ trans('label.add_more') }}
            </button>
        </div>
        <div class="education-fields border-bottom-das  mb-25">
            @if (!empty($educationsData) && is_iterable($educationsData))
                @foreach ($educationsData as $key => $value)
                    <div class="row education-field border-bottom mb-4">
                        {!! Form::hidden("edu_id[$key]", old("edu_id .$key", $value->id ?? 0), ['class' => 'form-control']) !!}
                        <div class="d-flex mb-4 align-items-center justify-content-end col-12">
                            <button type="button" id="remove-button"
                                class="edit_btn_link @if ($key == 0) d-none @endif edu-remove-field text-danger justify-content-end border-0 p-0">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="18"
                                    viewBox="0 0 18 20" fill="none">
                                    <path
                                        d="M12.5556 4.6V3.88C12.5556 2.87191 12.5556 2.36786 12.3618 1.98282C12.1913 1.64413 11.9194 1.36876 11.5849 1.19619C11.2046 1 10.7068 1 9.71111 1H8.28889C7.29324 1 6.79542 1 6.41513 1.19619C6.08062 1.36876 5.80865 1.64413 5.63821 1.98282C5.44444 2.36786 5.44444 2.87191 5.44444 3.88V4.6M7.22222 9.55V14.05M10.7778 9.55V14.05M1 4.6H17M15.2222 4.6V14.68C15.2222 16.1921 15.2222 16.9482 14.9316 17.5258C14.6759 18.0338 14.268 18.4469 13.7662 18.7057C13.1958 19 12.449 19 10.9556 19H7.04445C5.55097 19 4.80423 19 4.2338 18.7057C3.73204 18.4469 3.32409 18.0338 3.06843 17.5258C2.77778 16.9482 2.77778 16.1921 2.77778 14.68V4.6"
                                        stroke="#ff7d57" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round"></path>
                                </svg>{{ trans('label.delete') }}
                            </button>
                        </div>
                        <div class="form-group col-md-6 col-lg-4 mb-4">
                            <label for="">{{ trans('label.choose_degree') }}</label>
                            {!! Form::select(
                                "qualification_id[$key]",
                                $educations,
                                old("qualification_id.$key", $value->qualification_id ?? null),
                                ['class' => 'form-control no-select2', 'placeholder' => trans('label.choose_degree')],
                            ) !!}
                        </div>
                        <div class="form-group col-md-6 col-lg-4 mb-4">
                            <label for="">{{ trans('label.choose_specialization') }}</label>
                            {!! Form::select(
                                "specialization_id[$key]",
                                $specializations,
                                old("specialization_id.$key", $value->specialization_id ?? null),
                                ['class' => 'form-control no-select2', 'placeholder' => trans('label.choose_specialization')],
                            ) !!}
                        </div>


                        {{-- <div class="form-group col-md-6 col-lg-4 mb-4">
                            <label for="">{{ trans('label.university') }}</label>
                            {!! Form::text("university[$key]", old("university.$key", $value->university ?? null), [
                                'class' => 'form-control',
                                'placeholder' => trans('label.university'),
                            ]) !!}

                        </div> --}}

                        {{-- <div class="form-group col-md-6 col-lg-4 mb-4">
                            <label for="">{{ trans('label.employer_view.location') }}</label>
                            {!! Form::text("location[$key]", old("location.$key", $value->location ?? null), [
                                'class' => 'form-control',
                                'placeholder' => trans('label.employer_view.location'),
                            ]) !!}

                        </div> --}}

                        {{-- <div class="form-group col-md-6 col-lg-4 mb-4">
                            <label for="">{{ trans('label.percentile_cgpa') }}</label>
                            {!! Form::text("percentile_cgpa[$key]", old("percentile_cgpa.$key", $value->percentile_cgpa ?? null), [
                                'class' => 'form-control',
                                'placeholder' => trans('label.percentile_cgpa'),
                                'oninput' => 'this.value = this.value.replace(/[^0-9.]/g, \'\')',
                            ]) !!}

                        </div> --}}
                        <div class="col-md-12">
                            @include('auth.job_seeker.partials.joing_leaving_date', [
                                'key' => $key,
                                'value' => $value,
                            ])
                        </div>
                    </div>
                @endforeach
            @else
                @empty($educationsData)

                    <div class="row education-field">
                        <div class="col-12 d-none mb-30" id="remove-button">
                            <button type="button"
                                class="ml-auto edit_btn_link edu-remove-field text-danger justify-content-end border-top-0 border-left-0 border-right-0 p-0">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="18"
                                    viewBox="0 0 18 20" fill="none">
                                    <path
                                        d="M12.5556 4.6V3.88C12.5556 2.87191 12.5556 2.36786 12.3618 1.98282C12.1913 1.64413 11.9194 1.36876 11.5849 1.19619C11.2046 1 10.7068 1 9.71111 1H8.28889C7.29324 1 6.79542 1 6.41513 1.19619C6.08062 1.36876 5.80865 1.64413 5.63821 1.98282C5.44444 2.36786 5.44444 2.87191 5.44444 3.88V4.6M7.22222 9.55V14.05M10.7778 9.55V14.05M1 4.6H17M15.2222 4.6V14.68C15.2222 16.1921 15.2222 16.9482 14.9316 17.5258C14.6759 18.0338 14.268 18.4469 13.7662 18.7057C13.1958 19 12.449 19 10.9556 19H7.04445C5.55097 19 4.80423 19 4.2338 18.7057C3.73204 18.4469 3.32409 18.0338 3.06843 17.5258C2.77778 16.9482 2.77778 16.1921 2.77778 14.68V4.6"
                                        stroke="#ff7d57" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round"></path>
                                </svg>{{ trans('label.delete') }}

                            </button>
                        </div>
                        {!! Form::hidden('edu_id[]', 0, ['class' => 'form-control']) !!}


                        <div class="form-group col-md-6 mb-4">
                            <label for="">{{ trans('label.choose_degree') }}</label>
                            {!! Form::select('qualification_id[]', $educations, null, [
                                'class' => 'form-control no-select2',
                                'placeholder' => trans('label.choose_degree'),
                            ]) !!}
                        </div>
                        <div class="form-group col-md-6 mb-4">
                            <label for="">{{ trans('label.choose_specialization') }}</label>
                            {!! Form::select('specialization_id[]', $specializations, null, [
                                'class' => 'form-control no-select2',
                                'placeholder' => trans('label.choose_specialization'),
                            ]) !!}
                        </div>
                        {{-- <div class="form-group col-md-6 col-lg-4 mb-4">
                            <label for="">{{ trans('label.university') }}</label>
                            {!! Form::text('university[]', null, ['class' => 'form-control', 'placeholder' => trans('label.university')]) !!}
                        </div> --}}

                        {{-- <div class="form-group col-md-6 col-lg-4 mb-4">
                            <label for="">{{ trans('label.employer_view.location') }}</label>
                            {!! Form::text('location[]', '', [
                                'class' => 'form-control',
                                'placeholder' => trans('label.employer_view.location'),
                            ]) !!}
                        </div> --}}
                        {{-- <div class="form-group col-md-6 col-lg-4 mb-4">
                            <label for="">{{ trans('label.percentile_cgpa') }}</label>
                            {!! Form::text('percentile_cgpa[]', null, [
                                'class' => 'form-control',
                                'placeholder' => trans('label.percentile_cgpa'),
                                'oninput' => 'this.value = this.value.replace(/[^0-9.]/g, \'\')',
                            ]) !!}
                        </div> --}}

                        <div class="col-12 mb-3">
                            @include('auth.job_seeker.partials.joing_leaving_date', ['key' => 0])
                        </div>
                    </div>
                @endempty
            @endempty
        </div>
        <div class="license-field-wrapper border-bottom-das  mb-25">
            <div class="d-flex mb-4 align-items-center justify-content-between profile_box">
                <h3 class="mb-0">{{ trans('label.job_detail_page.training_certificate') }}</h3>
                <button type="button" class="lic-add-field edit_btn_link p-0 border-top-0 border-left-0 border-right-0">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                        viewBox="0 0 16 16" fill="none">
                        <path d="M7.99998 1.58331V14.4166M1.58331 7.99998H14.4166" stroke="#fff"
                            stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                    {{ trans('label.add_more') }}

                </button>
            </div>
            <div class="license-fields">
                @if (!empty($licenseData) && is_iterable($licenseData))
                    @foreach ($licenseData as $key => $value)
                        <div class="row license-field border-bottom mb-4">

                            {!! Form::hidden("lic_id[$key]", old("lic_id.$key", $value->id ?? 0), ['class' => 'form-control']) !!}

                            <div class="d-flex mb-4 align-items-center justify-content-end col-12">
                                <button type="button" id="remove-button"
                                    class="edit_btn_link @if ($key == 0) d-none @endif lic-remove-field text-danger justify-content-end border-0 p-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="18"
                                        viewBox="0 0 18 20" fill="none">
                                        <path
                                            d="M12.5556 4.6V3.88C12.5556 2.87191 12.5556 2.36786 12.3618 1.98282C12.1913 1.64413 11.9194 1.36876 11.5849 1.19619C11.2046 1 10.7068 1 9.71111 1H8.28889C7.29324 1 6.79542 1 6.41513 1.19619C6.08062 1.36876 5.80865 1.64413 5.63821 1.98282C5.44444 2.36786 5.44444 2.87191 5.44444 3.88V4.6M7.22222 9.55V14.05M10.7778 9.55V14.05M1 4.6H17M15.2222 4.6V14.68C15.2222 16.1921 15.2222 16.9482 14.9316 17.5258C14.6759 18.0338 14.268 18.4469 13.7662 18.7057C13.1958 19 12.449 19 10.9556 19H7.04445C5.55097 19 4.80423 19 4.2338 18.7057C3.73204 18.4469 3.32409 18.0338 3.06843 17.5258C2.77778 16.9482 2.77778 16.1921 2.77778 14.68V4.6"
                                            stroke="#ff7d57" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                    </svg>{{ trans('label.delete') }}

                                </button>
                            </div>
                            <div class="form-group col-md-6 col-lg-4 mb-4">
                                <label for="">{{ trans('label.certificate_name') }}</label>
                                {!! Form::text("certificate_name[$key]", old("certificate_name.$key", $value->certificate_name ?? null), [
                                    'class' => 'form-control',
                                    'placeholder' => trans('label.certificate_name'),
                                ]) !!}

                                @error("certificate_name.$key")
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror


                            </div>
                            <div class="form-group col-md-6 col-lg-4 mb-4">
                                <label for="">{{ trans('label.certifying_authority') }}</label>
                                {!! Form::text(
                                    "certifying_authority[$key]",
                                    old("certifying_authority.$key", $value->certifying_authority ?? null),
                                    ['class' => 'form-control', 'placeholder' => trans('label.certifying_authority')],
                                ) !!}

                                @error("certifying_authority.$key")
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror


                            </div>
                            <div class="col-md-6 col-lg-4">
                                @include('auth.job_seeker.partials.month_year_duration', [
                                    'key' => $key,
                                    'value' => $value,
                                ])
                            </div>
                        </div>
                    @endforeach
                @else
                    @empty($licenseData)

                        <div class="row license-field">
                            <div class="col-12 d-none mb-30" id="remove-button">
                                <button type="button"
                                    class="ml-auto edit_btn_link lic-remove-field text-danger justify-content-end border-top-0 border-left-0 border-right-0 p-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="18"
                                        viewBox="0 0 18 20" fill="none">
                                        <path
                                            d="M12.5556 4.6V3.88C12.5556 2.87191 12.5556 2.36786 12.3618 1.98282C12.1913 1.64413 11.9194 1.36876 11.5849 1.19619C11.2046 1 10.7068 1 9.71111 1H8.28889C7.29324 1 6.79542 1 6.41513 1.19619C6.08062 1.36876 5.80865 1.64413 5.63821 1.98282C5.44444 2.36786 5.44444 2.87191 5.44444 3.88V4.6M7.22222 9.55V14.05M10.7778 9.55V14.05M1 4.6H17M15.2222 4.6V14.68C15.2222 16.1921 15.2222 16.9482 14.9316 17.5258C14.6759 18.0338 14.268 18.4469 13.7662 18.7057C13.1958 19 12.449 19 10.9556 19H7.04445C5.55097 19 4.80423 19 4.2338 18.7057C3.73204 18.4469 3.32409 18.0338 3.06843 17.5258C2.77778 16.9482 2.77778 16.1921 2.77778 14.68V4.6"
                                            stroke="#ff7d57" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                    </svg>{{ trans('label.delete') }}

                                </button>
                            </div>
                            {!! Form::hidden('lic_id[]', 0, ['class' => 'form-control']) !!}


                            <div class="form-group col-md-6 mb-4">
                                <label for="">{{ trans('label.certificate_name') }}</label>
                                {!! Form::text('certificate_name[]', null, [
                                    'class' => 'form-control',
                                    'placeholder' => trans('label.certificate_name'),
                                ]) !!}

                                @error('certificate_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>
                            <div class="form-group col-md-6 mb-4">
                                <label for="">{{ trans('label.certifying_authority') }}</label>
                                {!! Form::text('certifying_authority[]', null, [
                                    'class' => 'form-control',
                                    'placeholder' => trans('label.certifying_authority'),
                                ]) !!}

                                @error('certifying_authority')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>
                            <div class="col-12 mb-3">
                                @include('auth.job_seeker.partials.month_year_duration', [
                                    'key' => 0
                                ])
                            </div>
                        </div>
                    @endempty
                @endempty
            </div>
        </div>
        {{-- <div class="d-flex align-items-center justify-content-between flex-wrap mt-4">
            <input type="button" name="previous" id="previous1" class="btn-outline-primary btn mb-4 mb-lg-0" value="Previous" />
            <input style="float:right;" type="button" id="steptwo" name="next" class="next btn btn-primary" value="Next" />
        </div> --}}
        {{-- @dd($seekerDetails); --}}
        <div class="trainings-feld-wrap w-100">
           <div class="row">
            <div class="col-sm-12 text-left profile_box">
                <h3>{{ trans('label.trainings') }}</h3>
            </div>
            <div class="mb-lg-0 mb-4 col-md-6 col-lg-4">
                <label for="">{{ trans('label.training_name') }}</label>
                {!! Form::text('training_name', old('training_name', $seekerDetails->training_name ?? null), [
                    'class' => 'form-control',
                    'placeholder' => trans('label.training_name'),
                ]) !!}
                @error('training_name')
                    <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-lg-0 mb-4 col-md-6 col-lg-4">
                <label for="" class="text-transform-none">{{ trans('label.attended_at_company') }}</label>
                {!! Form::text('attended_at_company', old('attended_at_company', $seekerDetails->attended_at_company ?? null), [
                    'class' => 'form-control',
                    'placeholder' => trans('label.attended_at_company'),
                ]) !!}
                @error('attended_at_company')
                    <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-6 col-lg-4">
                @include('auth.job_seeker.partials.duration_year', [
                    // 'key' => $key,
                    // 'value' => $value,
                ])
            </div>
           </div>
        </div>
        {{-- <div class="d-flex align-items-center justify-content-between flex-wrap mt-50 pt-50  border-top">
            <a href="{{ route('resume-builder.editStep',['userId' => $userId, 'step' => $step - 1]) }}" id="stepTwoPrev" class="btn-outline-primary btn mb-4 mb-lg-0"><svg style="margin-right: 12px" xmlns="http://www.w3.org/2000/svg" width="8" height="14" viewBox="0 0 8 14" fill="none">
                <path d="M6.75 12.5L1.25 7L6.75 1.5" stroke="#357DE8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
              </svg> Previous
            </a>
            {!! Form::submit(__('label.save'), ['class' => 'btn btn-primary ml-3']) !!}
        </div> --}}
    </div>
{{-- </fieldset> --}}
