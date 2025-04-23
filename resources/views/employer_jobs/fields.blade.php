@section('third_party_stylesheets')
    @include('vendor.image_upload.style')
    @include('vendor.richtexteditor.style')
    <style>
        /* Hide all except first fieldset */
        #frm_employerJob fieldset:not(:first-of-type) {
            display: none;
        }
    </style>
@endsection
@section('third_party_stylesheets')
@include('vendor.image_upload.style')
@include('vendor.richtexteditor.style')
@endsection
{!! Form::hidden('slug', null) !!}
{!! Form::hidden('country_id', config('constants.default_country_id')) !!}
<!-- Job ID Field -->
<div class="form-group col-sm-6 d-none">
    {!! Form::text('job_number', $pattern, [
        'class' => 'form-control',
        'placeholder' => trans('label.job_id'),
        'readonly',
    ]) !!}

</div>
@hasrole('admin')
    <!-- Employer Field -->
    <div class="row">
        <div class="form-group mb-4 mt-5 col-md-4">
            {!! Form::select('created_by', $employers ?? [], $employerID ?? null, [
                'class' => 'form-control mt-5' . ($errors->has('created_by') ? 'is-invalid' : ''),
                'placeholder' => trans('label.select_employer'),
            ]) !!}
            @if ($errors->has('created_by'))
                <span class="text-danger">{{ $errors->first('created_by') }}</span>
            @endif
        </div>
    </div>
@endrole


<div class="row mb-50 mx-0">
    <div class="col-md-3 step_main_wraper">
        <ul id="progressbar" class="m-0 p-0">
            <li class="active">
                <span class="number"><span class="digit">1</span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="12" viewBox="0 0 16 12"
                        fill="none" class="finish_arrow">
                        <path d="M14.6654 1L5.4987 10.1667L1.33203 6" stroke="white" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </span>
                <p>Basic Details</p>
            </li>
            <li>
                <span class="number"><span class="digit">2</span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="12" viewBox="0 0 16 12"
                        fill="none" class="finish_arrow">
                        <path d="M14.6654 1L5.4987 10.1667L1.33203 6" stroke="white" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </span>
                <p>Write or choose skills</p>
            </li>
            <li>
                <span class="number"><span class="digit">3</span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="12" viewBox="0 0 16 12"
                        fill="none" class="finish_arrow">
                        <path d="M14.6654 1L5.4987 10.1667L1.33203 6" stroke="white" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </span>
                <p>Experience & Certifications</p>
            </li>
            <li>
                <span class="number"><span class="digit">4</span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="12" viewBox="0 0 16 12"
                        fill="none" class="finish_arrow">
                        <path d="M14.6654 1L5.4987 10.1667L1.33203 6" stroke="white" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </span>
                <p>Other Requirement</p>
            </li>
            <li>
                <span class="number"><span class="digit">5</span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="12" viewBox="0 0 16 12"
                        fill="none" class="finish_arrow">
                        <path d="M14.6654 1L5.4987 10.1667L1.33203 6" stroke="white" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </span>
                <p>Screening Questions</p>
            </li>
            <li>
                <span class="number"><span class="digit">6</span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="12" viewBox="0 0 16 12"
                        fill="none" class="finish_arrow">
                        <path d="M14.6654 1L5.4987 10.1667L1.33203 6" stroke="white" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </span>
                <p>Other Informations</p>
            </li>
        </ul>
    </div>
    <div class="step_detail_wraper col-md-9">

        <fieldset id="step1" class="job_steps_common">
            <h2>Basic Details</h2>
            <div class="row mkj-form-text">
                <div class="col-md-6">
                    <!-- Title Field -->
                    <div class="form-group mb-4">
                        {!! html_entity_decode(
                            Form::label('title', trans('label.candidate_profile_title') . '<span style="color: red">*</span>', ['class' => 'required-label']),
                        ) !!}
                        {{-- {!! Form::label('title', trans('label.candidate_profile_title') . '*', ['class' => 'required-label']) !!} --}}
                        {!! Form::text('title', null, [
                            'class' => 'form-control ' . ($errors->has('title') ? 'is-invalid' : ''),
                            'placeholder' => trans('label.candidate_profile_title'),
                        ]) !!}
                        @if ($errors->has('title'))
                            <span class="text-danger">{{ $errors->first('title') }}</span>
                        @endif
                    </div>
                </div>

                <div class="col-md-6">
                    <!-- Category Id  Field -->
                    <div class="form-group mb-4">
                        {!! html_entity_decode(
                            Form::label('category_id', trans('label.category') . '<span style="color: red">*</span>', [
                                'class' => 'required-label',
                            ]),
                        ) !!}
                        {{-- {!! Form::label('category_id', trans('label.category') . '*', ['class' => 'required-label']) !!} --}}
                        {!! Form::select('category_id', $categories ?? [], null, [
                            'class' => 'form-control select-with-tag' . ($errors->has('category_id') ? 'is-invalid' : ''),
                            'data-placeholder' => trans('label.category'),
                        ]) !!}
                        @if ($errors->has('category_id'))
                            <span class="text-danger">{{ $errors->first('category_id') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <!-- Work type ID  Field -->
                    <div class="form-group mb-4">
                        {!! Form::label('work_type_id', trans('label.work_type')) !!}
                        {!! Form::select('work_type_id[]', $workTypes ?? null, $workTypesids, [
                            'class' => 'form-control ' . (isset($errors) && $errors->has('work_type_id') ? 'is-invalid' : ''),
                            'data-placeholder' => trans('label.work_type'),
                            'multiple' => true,
                        ]) !!}
                        @error('work_type_id')
                            <span class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                {{-- <div class="col-md-6">
                    <!-- Category Id Field -->
                    <div class="form-group mb-4">
                        {!! Form::label('job_type_id', trans('label.job_type')) !!}
                        {!! Form::select('job_type_id', $jobTypes ?? [], null, [
                            'class' => 'form-control ' . ($errors->has('job_type_id') ? 'is-invalid' : ''),
                            'data-placeholder' => trans('label.job_type'),
                            'placeholder' => trans('label.select_job_type') // Add a placeholder option
                        ]) !!}
                        @if ($errors->has('job_type_id'))
                            <span class="text-danger">{{ $errors->first('job_type_id') }}</span>
                        @endif
                    </div>
                </div> --}}



                <div class="form-group col-md-12">
                    <label for="description">{{ trans('label.description') }}<span class="text-danger">*</span></label>

                    {!! Form::textarea('description', null, [
                        'id' => 'description',
                        'name' => 'description',
                        'rows' => 4,
                        'class' => 'form-control ' . ($errors->has('description') ? 'is-invalid' : ''),
                        'placeholder' => trans('label.job_detail_page.title'),
                        'richtexteditor' => true,
                    ]) !!}

                    {{-- @if ($errors->has('description'))
                        <span class="text-danger">{{ $errors->first('description') }}</span>
                    @endif --}}

                    <span id="description-error" class="text-danger"></span> <!-- Add this line -->
                </div>



                {{-- <button onclick="getValue()">Get Value</button> --}}


                {{-- <input type="text" id="myTextField" value="Example Text">
<button onclick="getValue()">Get Value</button> --}}

                {{-- <div class="form-group col-md-6 mb-4 uploaded_img">
                    <label for="">{{('Upload Document')}}</label>
                    @include('vendor.image_upload.upload', ['id' => 'employer_job_logo', 'name' => 'employer_job_logo', 'height'
                    => '80px', 'width' => '80px', 'document_type' => config('constants.document_type.cropped_images', 2), 'multiple'
                    => true, 'limit' => 1])
                </div> --}}

                <!-- Job Description Field -->
                {{-- <div class="form-group mb-4 col-md-12">
                    {!! Form::textarea('description', null, [
                        'rows' => 4,
                        'class' => 'form-control ' . ($errors->has('description') ? 'is-invalid' : ''),
                        'placeholder' => trans('label.job_detail_page.title') ,'richtexteditor' => true ,

                    ]) !!}
                    {{-- @if ($errors->has('description'))
                        <span class="text-danger">{{ $errors->first('description') }}</span>
                    @endif
                </div> --}}

                {{-- <div class="form-group col-md-12 mb-4">
                    <label for="">Description</label>
                    {!! Form::textarea('description', null, [
                        'rows' => 4,
                        'class' => 'form-control ' . ($errors->has('description') ? 'is-invalid' : ''),
                        // 'placeholder' => trans('label.job_detail_page.description'),
                        // 'richtexteditor' => false,
                    ]) !!}
                    @if ($errors->has('description'))
                        <span class="text-danger">{{ $errors->first('description') }}</span>
                    @endif
                </div> --}}
                {{-- <div class="form-group">
                    {!! Form::textarea('description', null, ['id' => 'description', 'rows' => 4, 'class' => 'form-control '. ($errors->has('description') ? 'is-invalid' : ''), 'placeholder' => trans('label.job_detail_page.title'), 'richtexteditor' => true]) !!}

                    @if ($errors->has('description'))
                        <span class="text-danger">{{ $errors->first('description') }}</span>
                    @endif
                    <span id="description-error" class="text-danger"></span> <!-- Add this line -->
                </div> --}}


                {{--
                <div class="form-group mb-4 col-md-12">
                    {!! Form::textarea('description', null, [
                        'rows' => 4,
                        'class' => 'form-control ' . ($errors->has('description') ? 'is-invalid' : ''),
                        'placeholder' => trans('label.job_detail_page.title'),
                        'richtexteditor' => true
                    ]) !!}

                    @error('description')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror

                    @if (empty(old('description')) && !$errors->has('description'))
                    <span class="text-danger">The description field is required.</span>
                    @endif
                </div> --}}




            </div>
            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route($entity['url'] . '.index') }}" class="btn btn-default">{!! __('label.cancel') !!}</a>
                {{-- <input type="button" id="stepone" name="next" class="next btn btn-primary" value="Next" /> --}}
                <input type="button" id="stepone" name="next" class="next btn btn-primary" value="Next" />
            </div>
        </fieldset>

        <fieldset id="step2" class="job_steps_common">
            <h2>Write or choose skills</h2>
            <div class="row mkj-form-text">
                <!-- Skill Id  Field -->
                <div class="form-group mb-4 pb-lg-3 fill-dropdown new-multiple-selection-wrap col-12">
                    {!! Form::select('skill_id[]', $skills ?? null, $skillids, [
                        'class' => 'form-control select-with-tag' . ($errors->has('skill_id') ? 'is-invalid' : ''),
                        'data-placeholder' => trans('label.skills') . '*',
                        'multiple' => true,
                        'ajax-url' => route('ajax.skills'),
                    ]) !!}


                    @error('skill_id')
                        <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                    @error('skill_id')
                    <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                {{-- <div class="form-group col-md-12 mb-4">
                    <label for="">{{ trans('label.specializations') }} *</label>
                    {!! Form::select('specialization_id', $specializations ?? null, $specializationids, [
                        'class' => 'form-control select-with-tag',
                        'data-placeholder' => trans('label.specializations'),
                        'multiple' => false,
                    ]) !!}
                </div> --}}


            </div>
            <div class="d-flex align-items-center justify-content-between flex-wrap mt-4">
                <input type="button" name="previous" id="previous1" class="btn-outline-primary btn mb-4 mb-lg-0"
                    value="Previous" />
                <input style="float:right;" type="button" id="steptwo" name="next"
                    class="next btn btn-primary" value="Next" />
            </div>
        </fieldset>

        <fieldset id="step3" class="job_steps_common">
            <h2>Experience & Certifications</h2>
            <div class="row mkj-form-text">
                <!-- certifications Id  Field -->
                <div class="form-group col-md-6 mb-4">
                    {!! Form::label('certification_id', trans('label.certification')) !!}
                    {!! Form::select('certification_id[]', $certifications ?? null, $certificationids, [
                        'class' => 'form-control select-with-tag',
                        'data-placeholder' => trans('label.certification'),
                        'multiple' => true,
                    ]) !!}
                </div>

                <!-- Experience Id Field -->
                <div class="form-group col-md-6 mb-4">
                    {!! html_entity_decode(
                        Form::label('experience_id', trans('label.experience_in_year'), ['class' => 'required-label']),
                    ) !!}
                    {{-- {!! Form::label('experience_id', trans('label.experience_in_year') . '*') !!} --}}
                    {!! Form::select('experience_id', $experinces ?? [], null, [
                        'class' => 'form-control',
                        'data-placeholder' => trans('label.experience_in_year'),
                    ]) !!}
                </div>
                <!-- Qualification Id  Field -->
                <div class="form-group col-md-12 mb-4">
                    {!! html_entity_decode(
                        Form::label('qualification_id[]', trans('label.education') . '<span style="color: red">*</span>', [
                            'class' => 'required-label',
                        ]),
                    ) !!}
                    {{-- {!! Form::label('qualification_id', trans('label.education') . '*') !!} --}}
                    {!! Form::select('qualification_id[]', $qualifications ?? null, $qualificationIDS, [
                        'class' => 'form-control  select-with-tag',
                        'data-placeholder' => trans('label.education'),
                        'multiple' => true,
                    ]) !!}
                </div>
            </div>
            <div class="d-flex align-items-center justify-content-between flex-wrap mt-4">
                <input type="button" name="previous" id="previous2" class="btn-outline-primary btn mb-4 mb-lg-0"
                    value="Previous" />
                <input style="float:right;" type="button" id="stepthree" name="next"
                    class="next btn btn-primary" value="Next" />
            </div>
        </fieldset>

        <fieldset id="step4" class="job_steps_common">
            <h2>Other Requirement</h2>
            <div class="row mkj-form-text">
                <!-- Other requirements Field -->
                <div class="form-group col-md-12 mb-4">
                    <label for="">Other Requirement</label>
                    {!! Form::textarea('other_recuirements', null, [
                        'rows' => 4,
                        'class' => 'form-control ' . ($errors->has('other_recuirements') ? 'is-invalid' : ''),
                        'placeholder' => trans('label.job_detail_page.other_recuirements'),
                        'richtexteditor' => true,
                    ]) !!}
                    @if ($errors->has('other_recuirements'))
                        <span class="text-danger">{{ $errors->first('other_recuirements') }}</span>
                    @endif
                </div>
            </div>
            <div class="d-flex align-items-center justify-content-between flex-wrap px-lg-3 mt-4">
                <input type="button" name="previous" id="previous3" class="btn-outline-primary btn mb-4 mb-lg-0"
                    value="Previous" />
                <input style="float:right;" type="button" id="stepfour" name="next"
                    class="next btn btn-primary" value="Next" />
            </div>
        </fieldset>
        {{--
         <fieldset id="step5" class="job_steps_common">
            <h2>Screening Questions</h2>
            <div class="mkj-form-text question_wraper text-center p-4 p-lg-5 mb-5">
                <div id="questionnaire-list" class="">
                    @include('questionnaires.list', ['job' => $id, 'list' => $questionnaires ?? [], 'display' => true])
                </div>
                <div class="">
                    <a class="open-form btn btn-primary m-auto" data-mode="edit" data-modal-size="modal-lg" data-title="{!! __('label.apply_job_question')!!}" data-model="questionnaire" data-url="{{route('questionnaires.create', ['job' => $id])}}" href="javascript:void(0)">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                            <path d="M7.99998 1.58331V14.4166M1.58331 7.99998H14.4166" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                        {!! __('label.create')!!}</a>
                </div>
                {!! Form::hidden('tmp_id', $id) !!}
            </div>
            <div class="d-flex align-items-center justify-content-between flex-wrap px-lg-3 mt-4">
                <input type="button" name="previous"  id="previous4" class="btn-outline-primary btn mb-4 mb-lg-0" value="Previous" />
                <input style="float:right;" type="button" id="stepfive" name="next" class="next btn btn-primary" value="Next" />
            </div>
        </fieldset> --}}
        {{-- <fieldset id="step5" class="job_steps_common">
            <h2>Screening Questions</h2>
            <div id="questionnaire-container" class="mkj-form-text question_wraper text-center p-4 p-lg-5 mb-5">
                <div class="form-group mb-4 question-item d-none to-clone">
                    <div class="row align-items-center">
                        <div class="col pr-0">
                            <input type="hidden" name="questionnaire[0][id]" disabled="disabled" value="0">
                            <input type="text" name="questionnaire[0][title]" class="form-control text-black" disabled="disabled" placeholder="{{ trans('label.new_question_placeholder') }}" autocomplete="off">
                        </div>
                        <div class="col-auto pl-0">
                            <a href="javascript:void(0)" data-id="0" class="text-danger ml-4 item-remove-field">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="20" viewBox="0 0 18 20" fill="none" class="mr-2">
                                    <path d="M12.5556 4.6V3.88C12.5556 2.87191 12.5556 2.36786 12.3618 1.98282C12.1913 1.64413 11.9194 1.36876 11.5849 1.19619C11.2046 1 10.7068 1 9.71111 1H8.28889C7.29324 1 6.79542 1 6.41513 1.19619C6.08062 1.36876 5.80865 1.64413 5.63821 1.98282C5.44444 2.36786 5.44444 2.87191 5.44444 3.88V4.6M7.22222 9.55V14.05M10.7778 9.55V14.05M1 4.6H17M15.2222 4.6V14.68C15.2222 16.1921 15.2222 16.9482 14.9316 17.5258C14.6759 18.0338 14.268 18.4469 13.7662 18.7057C13.1958 19 12.449 19 10.9556 19H7.04445C5.55097 19 4.80423 19 4.2338 18.7057C3.73204 18.4469 3.32409 18.0338 3.06843 17.5258C2.77778 16.9482 2.77778 16.1921 2.77778 14.68V4.6" stroke="#F00404" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
                <div id="questionnaire-list" class="">
                    @include('questionnaires.list', ['job' => $id, 'list' => $questionnaires ?? [], 'display' => true])

                </div>
                <a href="javascript:void(0)" id="add_question" class="btn btn-link px-0 @if (count($questionnaires ?? []) >= config('constants.questions_limit', 5)) d-none @endif">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                        <path d="M7.99998 1.58331V14.4166M1.58331 7.99998H14.4166" stroke="#152b9b" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg> {{ trans('label.add_question') }}
                </a>
                {!! Form::hidden('tmp_id', $id) !!}
            </div>
            <div class="d-flex align-items-center justify-content-between flex-wrap px-lg-3 mt-4">
                <input type="button" name="previous" id="previous4" class="btn-outline-primary btn mb-4 mb-lg-0" value="Previous" />
                <input style="float:right;" type="button" id="stepfive" name="next" class="next btn btn-primary" value="Next" />
            </div>
        </fieldset> --}}
        <fieldset id="step5" class="job_steps_common">
            <h2>Screening Questions</h2>
            <div id="questionnaire-container" class="mkj-form-text question_wraper text-center p-4 p-lg-4 mb-5">
                <div class="form-group mb-4 question-item d-none to-clone">
                    <div class="row align-items-center">
                        <div class="col pr-0">
                            <input type="hidden" name="questionnaire[0][id]" disabled="disabled" value="0">
                            <input type="text" name="questionnaire[0][title]" class="form-control text-black"
                                disabled="disabled" placeholder="{{ trans('label.new_question_placeholder') }}"
                                autocomplete="off">
                        </div>
                        <div class="col-auto pl-0">
                            <a href="javascript:void(0)" data-id="0" class="text-danger ml-4 item-remove-field">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="20"
                                    viewBox="0 0 18 20" fill="none" class="mr-2">
                                    <path
                                        d="M12.5556 4.6V3.88C12.5556 2.87191 12.5556 2.36786 12.3618 1.98282C12.1913 1.64413 11.9194 1.36876 11.5849 1.19619C11.2046 1 10.7068 1 9.71111 1H8.28889C7.29324 1 6.79542 1 6.41513 1.19619C6.08062 1.36876 5.80865 1.64413 5.63821 1.98282C5.44444 2.36786 5.44444 2.87191 5.44444 3.88V4.6M7.22222 9.55V14.05M10.7778 9.55V14.05M1 4.6H17M15.2222 4.6V14.68C15.2222 16.1921 15.2222 16.9482 14.9316 17.5258C14.6759 18.0338 14.268 18.4469 13.7662 18.7057C13.1958 19 12.449 19 10.9556 19H7.04445C5.55097 19 4.80423 19 4.2338 18.7057C3.73204 18.4469 3.32409 18.0338 3.06843 17.5258C2.77778 16.9482 2.77778 16.1921 2.77778 14.68V4.6"
                                        stroke="#F00404" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
                <div id="questionnaire-list" class="">
                    @include('questionnaires.list', [
                        'job' => $id,
                        'list' => $questionnaires ?? [],
                        'display' => true,
                    ])
                </div>
                <a href="javascript:void(0)" id="add_question"
                    class="btn btn-link px-0 mx-auto @if (count($questionnaires ?? []) >= config('constants.questions_limit', 5)) d-none @endif">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16"
                        fill="none">
                        <path d="M7.99998 1.58331V14.4166M1.58331 7.99998H14.4166" stroke="#357de8"
                            stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg> {{ trans('label.add_question') }}
                </a>
                {!! Form::hidden('tmp_id', $id) !!}
            </div>
            <div class="d-flex align-items-center justify-content-between flex-wrap px-lg-3 mt-4">
                <input type="button" name="previous" id="previous4" class="btn-outline-primary btn mb-4 mb-lg-0"
                    value="Previous" />
                <input style="float:right;" type="button" id="stepfive" name="next"
                    class="next btn btn-primary" value="Next" />
            </div>
        </fieldset>







        <fieldset id="step6" class="job_steps_common">
            <h2>Other Informations</h2>
            <div class="row mkj-form-text align-items-end">
                <div class="col-md-6">
                    <!-- Salary Id  Field -->
                    <div class="form-group mb-4">
                        <label for="">Salary Range</label>
                        {!! Form::select('salary_id', $salaries??[], null, ['class' => 'form-control', 'data-placeholder' =>
                        trans('label.annual_salary_range')]) !!}
                    </div>
                </div>
                <div class="col-md-6">
                    <!-- Salary Type Id  Field -->
                    <div class="form-group mb-4">
                        <label for="">Salary Type</label>
                        {!! Form::select('salary_type_id', $salary_types??[], null, ['class' =>
                        'form-control', 'data-placeholder' => trans('label.salary_type')]) !!}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-4">
                        <label>{{ trans('label.state') }}<span class="text-danger">*</span></label>
                        @include('components.state', [
                            'states' => $states,
                            'selected' => $employerJob->state_id ?? '',
                        ])
                        @error('state_id')
                            <span class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-4">
                        <label for="">{{ trans('label.city') }}<span class="text-danger">*</span></label>
                        @include('components.location', [
                            'locations' => $locations,
                            'selected' => $employerJob->location_id ?? '',
                        ])
                        @error('location_id')
                            <span class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-4">
                        <label for="">Address</label>
                        {!! Form::text('area', old('area', $employerJob->area ?? null), [
                            'class' => 'form-control',
                            'placeholder' => trans('label.area'),
                        ]) !!}
                        @error('area')
                            <span class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group mb-4">
                        <label for="">{{ trans('label.expiration_date') }}<span
                                style="color: red">*</span></label>
                        <div class="input-group">
                            {{-- <div class="input-group-prepend">
                                <div class="input-group-text">{{trans('label.expiration_date')}}</div>
                            </div> --}}
                            {!! Form::text('expiration_date', null, [
                                'class' => 'form-control datepicker',
                                'id' => 'expiration_date',
                                'placeholder' => trans('label.expiration_date'),
                            ]) !!}
                            @error('expiration_date')
                                <span class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                            <svg class="calander_icon" xmlns="http://www.w3.org/2000/svg" width="20"
                                height="20" viewBox="0 0 20 20" fill="none">
                                <path
                                    d="M16.6663 8.5H3.33301M12.9626 2.5V5.5M7.03671 2.5V5.5M6.88856 17.5H13.1108C14.3553 17.5 14.9776 17.5 15.453 17.2548C15.8711 17.039 16.2111 16.6948 16.4241 16.2715C16.6663 15.7902 16.6663 15.1601 16.6663 13.9V7.6C16.6663 6.33988 16.6663 5.70982 16.4241 5.22852C16.2111 4.80516 15.8711 4.46095 15.453 4.24524C14.9776 4 14.3553 4 13.1108 4H6.88856C5.644 4 5.02172 4 4.54636 4.24524C4.12822 4.46095 3.78827 4.80516 3.57522 5.22852C3.33301 5.70982 3.33301 6.33988 3.33301 7.6V13.9C3.33301 15.1601 3.33301 15.7902 3.57522 16.2715C3.78827 16.6948 4.12822 17.039 4.54636 17.2548C5.02172 17.5 5.644 17.5 6.88856 17.5Z"
                                    stroke="#717884" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                        </div>
                        <span class="input-group-prepend">
                        </span>
                    </div>
                </div>
                {{-- <div class="form-group col-md-12">
                    <label for="">{{ trans('label.description') }}</label>

                    {!! Form::textarea('description', null, ['id' => 'description', 'name' => 'description', 'rows' => 4, 'class' => 'form-control '. ($errors->has('description') ? 'is-invalid' : ''), 'placeholder' => trans('label.job_detail_page.title'), 'richtexteditor' => true]) !!}

                    @if ($errors->has('description'))
                        <span class="text-danger">{{ $errors->first('description') }}</span>
                    @endif

                    <span id="description-error" class="text-danger"></span> <!-- Add this line -->
                </div> --}}

                <div class="col-md-6">
                    <!-- Title Field -->
                    <div class="form-group mb-4 d-flex pl-1 align-items-center">
                        {!! Form::checkbox('is_urgent', 1, $employerJob->is_urgent ?? 0, [
                            'class' => ' ' . ($errors->has('is_urgent') ? 'is-invalid' : ''),
                        ]) !!}
                        {!! Form::label('is_urgent', trans('label.is_urgent'), ['class' => 'required-label mb-0']) !!}
                        @if ($errors->has('is_urgent'))
                            <span class="text-danger">{{ $errors->first('is_urgent') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-4">
                        <input type="checkbox" name="tc_checkbox" id="tc_checkbox" value="1"
                            class="form-control @error('tc_checkbox') is-invalid @enderror" placeholder="tc_checkbox">
                        <label for="tc_checkbox">
                            I agree to the
                            {{-- <a class="open-form" href="javascript:void(0)" data-mode="show"
                                data-modal-size="modal-lg"  data-model="employerJobs"
                                data-url="{!! route('terms-conditions') !!}" title="">Terms &
                                Conditions</a> --}}
                            <a class="" href="{!! route('terms-conditions') !!}" target="_blank" title="">Terms &
                                Conditions</a>
                        </label>
                        @error('tc_checkbox')
                            <span class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="d-flex align-items-center justify-content-between flex-wrap mt-4">
                <input type="button" name="previous" id="previous5" class="btn-outline-primary btn mb-4 mb-lg-0"
                    value="Previous" />
                {{-- <input type="submit" class="primaty-btn-outline mb-4 mb-lg-0" name="preview" value="{{__('label.preview')}}" id="preview"> --}}
                {{-- <input style="float:right;" type="submit" id="stepsix" name="submit" class="submitbutton" value="Submit" /> --}}
                {{-- <a href="{{ route($entity['url'].'.index') }}" class="primaty-btn-outline mb-4 mb-lg-0 text-body">{!! __('label.cancel') !!}</a>
                 --}}
                <div class="d-flex flex-wrap align-items-center">
                    @include('components.form-buttons')
                </div>
                {{-- {!! Form::submit(__('label.save'), ['class' => 'btn btn-primary', 'id' => 'stepsix']) !!} --}}
            </div>
        </fieldset>

    </div>
</div>







@include('imagecropper.croppermodal')
@section('third_party_scripts')
    @include('vendor.image_upload.script')
    @include('vendor.richtexteditor.script')
@endsection

@if (isset($employerJob) && !empty($employerJob->expiration_date))
    @include('vendor.moment.datetimepicker', [
        'dateFields' => ['expiration_date' => $employerJob->expiration_date],
    ])
@else
    @push('page_scripts')
        <script>
            var date = new Date();
            var threemonthafter = date.setMonth(date.getMonth() + 3);

            var m = moment(new Date());
            $('.datepicker').datetimepicker({
                minDate: m.add(1, 'days').startOf('day'),
                format: "{{ config('constants.format.moment_date') }}",
                useCurrent: false,
                defaultDate: threemonthafter,

                // maxDate:dateAfter
            });
        </script>
    @endpush
@endif
@push('page_scripts')
    <script>
        $(document).ready(function() {
            $("select", "#step2").addClass("ignore");
            $("input", "#step3").addClass("ignore");
            $("select", "#step3").addClass("ignore");
            $("input", "#step4").addClass("ignore");
            $("input", "#step5").addClass("ignore");
            $("input", "#step6").addClass("ignore");
            $("select", "#step6").addClass("ignore");
            $("textarea", "#step6").addClass("ignore");

            $.validator.addMethod("ckeditorRequired", function(value, element) {
                // Get the CKEditor instance
                var editorID = $(element).attr('id');
                var description = CKEDITOR.instances[editorID];
                // Check if the editor is empty or contains only whitespace
                var content = description ? description.getData().trim() : '';
                return content !== '';
            }, function() {
                var errorMessage = document.getElementById('description-error');
                errorMessage.textContent = "Description Field is Required.";
                return false;
            });



            var v = $("#frm_employerJob").validate({
                ignore: ".ignore",
                rules: {
                    title: "required",
                    category_id: "required",
                    // job_type_id: "required",
                    // description: "required",
                    'skill_id[]': "required",
                    'qualification_id[]': "required",

                    experience_id: "required",
                    nationality: "required",
                    location_address: "required",
                    state_id: "required",
                    location_id: "required",
                    tc_checkbox: "required",
                    'communication_setting[]': {
                        required: true,
                        maxlength: 2
                    },
                    description: {
                        ckeditorRequired: true
                    },
                    expiration_date: "required",
                },
                submitHandler: function(form) {
                    form.submit();
                },
                highlight: function(element, errorClass) {
                    window.scrollTo(0, 0);
                },
                unhighlight: function(element, errorClass) {
                    //$(element).closest(".form-group").removeClass("has-error");
                },
            });

            $("#stepone").click(function() {
                current_fs = $(this).parent().parent();
                next_fs = $(this).parent().parent().next();

                // var description = CKEDITOR.instances.description;

                // // Get the editor content
                // var content = description.getData().trim();
                // // alert(content);
                if (v.form()) {
                    $("select", "#step2").removeClass("ignore");

                    $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
                    $('#step1').hide();
                    $('#step2').show();
                    window.scrollTo(0, 0);
                }

            });
            // $("#stepone").click(function() {
            //     // Check if description field is empty
            //     var description = $('#description').val();

            //     if (description.trim() === '') {
            //         // Show error message
            //         $('#description-error').text('Description field cannot be empty');
            //     } else {
            //         if (v.form()) {
            //             $("select", "#step2").removeClass("ignore");

            //             current_fs = $(this).parent().parent();
            //             next_fs = $(this).parent().parent().next();

            //             $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
            //             $('#step1').hide();
            //             $('#step2').show();
            //             window.scrollTo(0, 0);
            //         }
            //     }
            // });




            // $("#previous1").click(function() {
            //     $("select", "#step2").addClass("ignore");

            //     current_fs = $(this).parent().parent();
            //     previous_fs = $(this).parent().parent().prev();

            //     $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");
            //     $('#step2').hide();
            //     $('#step1').show();
            //     window.scrollTo(0, 0);
            // });
            $("#previous1").click(function() {
                $("select", "#step2").addClass("ignore");

                current_fs = $(this).parent().parent();
                previous_fs = $(this).parent().parent().prev();

                $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");
                $('#step2').hide();
                $('#step1').show();
                window.scrollTo(0, 0);

                // Clear the description error message
                var errorMessage = document.getElementById('description-error');
                errorMessage.textContent = "";
            });


            $("#steptwo").click(function() {
                current_fs = $(this).parent().parent();
                next_fs = $(this).parent().parent().next();

                if (v.form()) {
                    $("input", "#step3").removeClass("ignore");
                    $("select", "#step3").removeClass("ignore");

                    $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
                    $('#step2').hide();
                    $('#step3').show();
                    window.scrollTo(0, 0);
                }
            });

            $("#previous2").click(function() {
                $("input", "#step3").addClass("ignore");
                $("select", "#step3").addClass("ignore");

                current_fs = $(this).parent().parent();
                previous_fs = $(this).parent().parent().prev();

                $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");
                $('#step3').hide();
                $('#step2').show();
                window.scrollTo(0, 0);
            });

            $("#stepthree").click(function() {
                current_fs = $(this).parent().parent();
                next_fs = $(this).parent().parent().next();

                if (v.form()) {
                    $("input", "#step4").removeClass("ignore");

                    $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
                    $('#step3').hide();
                    $('#step4').show();
                    window.scrollTo(0, 0);
                }
            });

            $("#previous3").click(function() {
                $("input", "#step4").addClass("ignore");

                current_fs = $(this).parent().parent();
                previous_fs = $(this).parent().parent().prev();

                $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");
                $('#step4').hide();
                $('#step3').show();
                window.scrollTo(0, 0);
            });

            $("#stepfour").click(function() {
                current_fs = $(this).parent().parent();
                next_fs = $(this).parent().parent().next();

                if (v.form()) {
                    $("input", "#step5").removeClass("ignore");

                    $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
                    $('#step4').hide();
                    $('#step5').show();
                    window.scrollTo(0, 0);
                }
            });

            $("#previous4").click(function() {
                $("input", "#step5").addClass("ignore");

                current_fs = $(this).parent().parent();
                previous_fs = $(this).parent().parent().prev();

                $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");
                $('#step5').hide();
                $('#step4').show();
                window.scrollTo(0, 0);
            });

            $("#stepfive").click(function() {
                current_fs = $(this).parent().parent();
                next_fs = $(this).parent().parent().next();

                if (v.form()) {
                    $("input", "#step6").removeClass("ignore");
                    $("select", "#step6").removeClass("ignore");
                    $("textarea", "#step6").removeClass("ignore");

                    $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
                    $('#step5').hide();
                    $('#step6').show();
                    window.scrollTo(0, 0);
                }
            });

            $("#previous5").click(function() {
                $("input", "#step6").addClass("ignore");
                $("select", "#step6").addClass("ignore");
                $("textarea", "#step6").addClass("ignore");

                current_fs = $(this).parent().parent();
                previous_fs = $(this).parent().parent().prev();

                $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");
                $('#step6').hide();
                $('#step5').show();
                window.scrollTo(0, 0);
            });

            $('form#frm_employerJob input,select,textarea').on('change', function(e) {
                if ($(this).hasClass('is-invalid') && $(this).val() != '' && $(this).val() != null) {
                    $(this).removeClass('is-invalid');
                } else if ($(this).val() == '' && $(this).val() == null) {
                    $(this).addClass('is-invalid');
                }
            });
        });

        var date = new Date();
        var threemonthafter = date.setMonth(date.getMonth() + 3);

        var m = moment(new Date());
        $('.datepicker').datetimepicker({
            minDate: m.add(1, 'days').startOf('day'),
            format: "{{ config('constants.format.moment_date') }}",
            useCurrent: false,
            defaultDate: threemonthafter
        });
    </script>



    <script type="text/javascript">
        var $wrapper = $('#questionnaire-container');
        var $question_limit = {!! config('constants.questions_limit', 5) !!};

        function updateQuestionIndexes() {
            $('.question-item', $wrapper).not('.to-clone').each(function(index) {
                $(this)
                    .find('input[name^="questionnaire"]')
                    .each(function() {
                        var currentName = $(this).attr('name');
                        var newName = currentName.replace(/\[\d+\]/, '[' + index + ']');
                        $(this).attr('name', newName);
                    });
            });
        }

        $('#add_question').on("click", function(e) {
            e.preventDefault();
            var total_questions = $('.question-item', $wrapper).not('.d-none').length;
            if (total_questions >= $question_limit) {
                return;
            }
            var cloned_content = $('.to-clone', $wrapper).clone(true).removeClass('to-clone d-none');
            cloned_content.find('[name^=questionnaire]').prop('disabled', false);
            cloned_content.find('a').addClass('item-remove-field').attr('data-id', total_questions);
            cloned_content.find('input').each(function() {
                var stringToReplace = $(this).attr('name');
                $(this).attr('name', stringToReplace.replace("[0]", "[" + total_questions + "]"));
            });
            $wrapper.find('#questionnaire-list').prepend(cloned_content); // Prepend the cloned content
            total_questions += 1;
            if (total_questions >= $question_limit) {
                $('#add_question').addClass('d-none');
            }
            updateQuestionIndexes(); // Update question indexes
        });

        // Remove buttons
        $wrapper.on("click", ".item-remove-field", function() {
            $(this).parents('.question-item').remove();
            var total_questions = $('.question-item', $wrapper).not('.d-none').length;
            if (total_questions < $question_limit) {
                $('#add_question').removeClass('d-none');
            }
            updateQuestionIndexes(); // Update question indexes
        });
    </script>
    {{-- <script>
        $(document).ready(function() {
            $('form').on('submit', function(event) {
                var description = $('#description').val();

                if (description.trim() === '') {
                    event.preventDefault();
                    $('#description-error').text('Description field cannot be empty');
                }
            });
        });
    </script> --}}
    <script>
        function getValue() {
            var descriptionField = document.getElementById('description');
            var descriptionValue = descriptionField.value.trim();
            var descriptionError = document.getElementById('description-error');

            if (descriptionValue === '') {
                descriptionError.textContent = 'Error: Description cannot be empty.';
                descriptionError.style.display = 'block';
            } else {
                descriptionError.style.display = 'none';
                alert(descriptionValue);
            }
        }
    </script>


{{-- <script>
 $(document).ready(function() {
        $('.js-example-basic-multiple').select2({
            placeholder: 'Select skills', // Placeholder text
            multiple: true, // Enable multiple selections
            allowClear: true, // Option to clear selected items

            // AJAX settings for dynamic data (modify accordingly)
            ajax: {
                url: '{{ route('ajax.skills') }}',
                dataType: 'json',
                delay: 250,
                processResults: function(data) {
                    return {
                        results: data.results
                    };
                },
                cache: true
            }
        });
    });
</script> --}}
@endpush
