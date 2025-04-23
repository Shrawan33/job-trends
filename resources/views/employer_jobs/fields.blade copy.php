@section('third_party_stylesheets')
@include('vendor.image_upload.style')
@include('vendor.richtexteditor.style')
<style>
    .blink_me {
        animation: blinker 1s linear infinite;
    }

    @keyframes blinker {
        50% {
            opacity: 0.5
        }
    }

    #employer_phone_number {
        display: none;
    }

    #other:checked~#employer_phone_number {
        display: flex;
    }

    /* Form styles */
    #frm_employerJob {
        width: 100%;
        margin: 0 auto;

        position: relative;
    }

    #frm_employerJob fieldset {
        background: #fff;
        border: 0 none;
        border-radius: 5px;
        box-sizing: border-box;
        width: 95%;
        margin: 0 auto;

        /*stacking fieldsets above each other*/
        position: relative;
    }

    /* Hide all except first fieldset */
    #frm_employerJob fieldset:not(:first-of-type) {
        display: none;
    }

    img.logo {
        max-width: 155px;
        margin-top: 5px;
    }

    #frm_employerJob p {
        color: #8b9ab0;
        font-size: 12px;
    }



    /* Buttons */

    #frm_employerJob .submitbutton {
        width: 30%;
        text-transform: uppercase;
        background: #d91b5b;
        font-weight: bold;
        color: white;
        border: 1px solid transparent;
        border-radius: 3px;
        cursor: pointer;
        padding: 12px 5px;
        margin: 10px 0;
        font-size: 16px;
        display: inline-block;
        -webkit-transition: all 0.2s;
        -moz-transition: all 0.2s;
        transition: all 0.2s;
    }

    #frm_employerJob .action-button {
        width: 30%;
        text-transform: uppercase;
        background: #d91b5b;
        font-weight: bold;
        color: white;
        border: 1px solid transparent;
        border-radius: 3px;
        cursor: pointer;
        padding: 12px 5px;
        margin: 10px 0;
        font-size: 16px;
        display: inline-block;
        -webkit-transition: all 0.2s;
        -moz-transition: all 0.2s;
        transition: all 0.2s;
    }

    #frm_employerJob .previous.action-button {
        background: #fff;
        border: 1px solid #7bbdf3;
        color: #7bbdf3;
    }

    #frm_employerJob .action-button:hover,
    #frm_employerJob .action-button:focus {
        box-shadow: 0 10px 30px 1px rgba(0, 0, 0, 0.2);
    }

    /* Headings */
    .fs-title {
        font-size: 20px;
        font-weight: 400;
        color: #a94442;
        margin-bottom: 20px;
        background-color: #9999CC;
        margin-top: 20px;
        padding: 5px;
        color: #fff;
    }

    .fs-subtitle {
        font-weight: 400;
        font-size: 19px;
        color: #434a54;
        margin-bottom: 20px;
    }

    /* Progressbar */


    /* css for checkbox */

    /* The container */
    #frm_employerJob .checkstyle {
        display: inline-flex;
        position: relative;
        width: auto;
        padding-left: 35px;
        padding-right: 25px;
        margin-bottom: 12px;
        cursor: pointer;
        font-size: 16px;

        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }

    /* Hide the browser's default checkbox */
    #frm_employerJob .checkstyle input {
        position: absolute;
        opacity: 0;
        cursor: pointer;
        height: 0;
        width: 0;
    }

    /* Create a custom checkbox */
    #frm_employerJob .checkmark {
        position: absolute;
        top: 0;
        left: 0;
        height: 25px;
        width: 25px;
        background-color: #eee;
    }

    /* On mouse-over, add a grey background color */
    #frm_employerJob .checkstyle:hover input~.checkmark {
        background-color: #ccc;
    }

    /* When the checkbox is checked, add a blue background */
    #frm_employerJob .checkstyle input:checked~.checkmark {
        background-color: #2196F3;
    }

    /* Create the checkmark/indicator (hidden when not checked) */
    #frm_employerJob .checkmark:after {
        content: "";
        position: absolute;
        display: none;
    }

    /* Show the checkmark when checked */
    #frm_employerJob .checkstyle input:checked~.checkmark:after {
        display: block;
    }

    /* Style the checkmark/indicator */
    #frm_employerJob .checkstyle .checkmark:after {
        left: 9px;
        top: 5px;
        width: 5px;
        height: 10px;
        border: solid white;
        border-width: 0 3px 3px 0;
        -webkit-transform: rotate(45deg);
        -ms-transform: rotate(45deg);
        transform: rotate(45deg);
    }

    .terms_text a:hover {
        text-decoration: none !important;
    }

    .listordercls {
        line-height: 25px !important;
        font-size: 13px !important;
        list-style: none !important;
        padding-left: 0px !important;
    }

    .icheck-primary {
        margin-right: 5px;
    }
</style>
@endsection


{!! Form::hidden('slug',null) !!}
{!! Form::hidden('country_id', config('constants.default_country_id')) !!}
<!-- Job ID Field -->
<div class="form-group col-sm-6 d-none">
    {!! Form::text('job_number',$pattern, ['class' => 'form-control', 'placeholder' => trans('label.job_id'),
    'readonly']) !!}

</div>
@hasrole('admin')
<!-- Employer Field -->
<div class="form-group mb-4 mt-5">
    {!! Form::select('created_by', $employers??[],$employerID??null, ['class' => 'form-control mt-5'.
    ($errors->has('created_by') ? 'is-invalid' : ''),
    'placeholder' => trans('label.select_employer')]) !!}
    @if ($errors->has('created_by'))
    <span class="text-danger">{{ $errors->first('created_by') }}</span>
    @endif
</div>
@endrole


<div class="row">
    <div class="col-md-3 step_main_wraper">
        <ul id="progressbar" class="m-0 p-0">
            <li class="active">
                <span class="number">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="12" viewBox="0 0 16 12" fill="none" class="finish_arrow">
                        <path d="M14.6654 1L5.4987 10.1667L1.33203 6" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </span>
                <p>Basic Details</p>
            </li>
            <li>
                <span class="number">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="12" viewBox="0 0 16 12" fill="none" class="finish_arrow">
                        <path d="M14.6654 1L5.4987 10.1667L1.33203 6" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </span>
                <p>Skills & Knowledge</p>
            </li>
            <li>
                <span class="number">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="12" viewBox="0 0 16 12" fill="none" class="finish_arrow">
                        <path d="M14.6654 1L5.4987 10.1667L1.33203 6" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </span>
                <p>Questions</p>
            </li>
            <li>
                <span class="number">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="12" viewBox="0 0 16 12" fill="none" class="finish_arrow">
                        <path d="M14.6654 1L5.4987 10.1667L1.33203 6" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </span>
                <p>Other Requirement</p>
            </li>
            <li>
                <span class="number">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="12" viewBox="0 0 16 12" fill="none" class="finish_arrow">
                        <path d="M14.6654 1L5.4987 10.1667L1.33203 6" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </span>
                <p>Screening Questions</p>
            </li>
            <li>
                <span class="number">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="12" viewBox="0 0 16 12" fill="none" class="finish_arrow">
                        <path d="M14.6654 1L5.4987 10.1667L1.33203 6" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </span>
                <p>Other Information</p>
            </li>
        </ul>
    </div>
    <div class="step_detail_wraper col-md-9">
        <h2>Basic Details</h2>
        <fieldset id="step1" class="job_steps_common">
            <div class="row mx-0 mkj-form-text">
                <div class="form-group mb-4">
                    @include('vendor.image_upload.upload', ['id' => 'employer_job_logo', 'name' => 'employer_job_logo', 'height'
                    => '80px', 'width' => '80px', 'document_type' => config('constants.document_type.cropped_images', 2), 'multiple'
                    => true, 'limit' => 1])
                </div>
                <div class="col-lg-6">
                    <!-- Title Field -->
                    <div class="form-group mb-4 pb-lg-3">
                        {!! Form::text('title', null, ['class' => 'form-control '. ($errors->has('title') ? 'is-invalid' : ''), 'placeholder' => trans('label.candidate_profile_title')]) !!}
                        @if ($errors->has('title'))
                            <span class="text-danger">{{ $errors->first('title') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col-lg-6">
                    <!-- Category Id  Field -->
                    <div class="form-group mb-4">
                        {!! Form::select('category_id', $categories??[], null, ['class' => 'form-control '. ($errors->has('category_id') ? 'is-invalid' : ''), 'data-placeholder' => trans('label.category')]) !!}
                        @if ($errors->has('category_id'))
                        <span class="text-danger">{{ $errors->first('category_id') }}</span>
                        @endif
                    </div>
                </div>

                <!-- Job Description Field -->
                <div class="form-group mb-4">
                    {!! Form::textarea('description', null, ['rows' => 4,'class' => 'form-control '. ($errors->has('description') ?
                    'is-invalid' : ''), 'placeholder' =>trans('label.job_detail_page.title'), 'richtexteditor' => true]) !!}
                    @if ($errors->has('description'))
                        <span class="text-danger">{{ $errors->first('description') }}</span>
                    @endif
                </div>

                <!-- Work type ID  Field -->
                <div class="form-group mb-4">
                    {!! Form::select('work_type_id[]', $workTypes??null, $workTypesids, ['class' => 'form-control '. (isset($errors) &&
                    $errors->has('work_type_id') ? 'is-invalid' : ''), 'data-placeholder' => trans('label.job_type'),
                    'multiple'=>true]) !!}
                    @error('work_type_id')
                        <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="px-lg-3 text-right">
                <input style="float:right;" type="button" id="stepone" name="next"
                    class="next primary-btn primary-btn-flat" value="Next" />
            </div>
        </fieldset>
        <fieldset id="step2" class="job_steps_common">
            <div class="row mx-0 mkj-form-text">
                <!-- Skill Id  Field -->
                <div class="form-group mb-4">
                    {!! Form::select('skill_id[]', $skills??null,$skillids, ['class' => 'form-control', 'data-placeholder' => trans('label.skills'), 'multiple'=>true]) !!}
                </div>
            </div>

            <div class="row mx-0 mkj-form-text">
                <!-- Specialization Id  Field -->
                <div class="form-group mb-4">
                    {!! Form::select('specialization_id', $specializations??null,$specializationids, ['class' => 'form-control', 'data-placeholder' => trans('label.specializations'), 'multiple'=>false]) !!}
                </div>
            </div>
        </fieldset>
    </div>
</div>



<!-- certifications Id  Field -->
<div class="form-group mb-4">
    {!! Form::select('certification_id[]', $certifications??null,$certificationids, ['class' => 'form-control',
    'data-placeholder' => trans('label.certification'), 'multiple'=>true]) !!}

</div>

<div class="row">
    <div class="col-sm">
        <div class="form-group mb-4">
            @include('components.state', ['states' => $states, 'selected' => $employerJob->state_id ?? ''])
            @error('state_id')
            <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-sm">
        <div class="form-group mb-4">
            @include('components.location', ['locations' => $locations, 'selected' => $employerJob->location_id ?? ''])
            @error('location_id')
            <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>
</div>




<div class="form-group mb-4">
    {!! Form::text('area', old('area', $employerJob->area ?? null), ['class' => 'form-control', 'placeholder' =>
    trans('label.area')]) !!}
    @error('area')
    <span class="error invalid-feedback">{{ $message }}</span>
    @enderror
</div>

<!-- Skill Id  Field -->
<div class="form-group mb-4">
    {!! Form::select('qualification_id[]', $qualifications??null,$qualificationIDS, ['class' => 'form-control',
    'data-placeholder' => trans('label.education'), 'multiple'=>true]) !!}

</div>


<!-- Experience Id Field -->
<div class="form-group mb-4">
    {!! Form::select('experience_id', $experinces??[], null, ['class' => 'form-control', 'data-placeholder' =>
    trans('label.experience_in_year')]) !!}

</div>
<div class="row">
    <div class="col-sm">
        <!-- Salary Id  Field -->
        <div class="form-group mb-4">
            {!! Form::select('salary_id', $salaries??[], null, ['class' => 'form-control', 'data-placeholder' =>
            trans('label.annual_salary_range')]) !!}
        </div>
    </div>
    <div class="col-sm">
        <!-- Salary Type Id  Field -->
        <div class="form-group mb-4">
            {!! Form::select('salary_type_id', $salary_types??[], null, ['class' =>
            'form-control', 'data-placeholder' => trans('label.salary_type')]) !!}
        </div>
    </div>
</div>


<!-- Is featured  Field -->
{{-- <div class="form-group mb-4">
    <div class="d-flex align-items-center">
        {!! Form::checkbox('is_featured', 1, null, ['class' => '']) !!} {{trans('label.is_featured')}}
</div>
</div> --}}
<div class="form-group mb-4">
    <div class="input-group">
        <div class="input-group-prepend">
            <div class="input-group-text">{{trans('label.expiration_date')}}</div>
        </div>
        {!! Form::text('expiration_date', null, ['class' => 'form-control datepicker', 'readonly' => true, 'id'=>'expiration_date','placeholder'
        => trans('label.expiration_date')]) !!}
    </div>
    <span class="input-group-prepend">

    </span>

</div>
<hr>
{{-- @if(isset($clone) && $clone == false) --}}
<h4>{!! __('label.screening_title') !!}</h4>
<div id="questionnaire-list" class="my-3">
    @include('questionnaires.list', ['job' => $id, 'list' => $questionnaires ?? [], 'display' => true])
</div>
{{-- @endif --}}
<a class="open-form" data-mode="edit" data-modal-size="modal-lg" data-title="{!! __('label.apply_job_question')!!}"
    data-model="questionnaire" data-url="{{route('questionnaires.create', ['job' => $id])}}"
    href="javascript:void(0)">{!! __('label.create')!!}</a>

{!! Form::hidden('tmp_id', $id) !!}

@include('imagecropper.croppermodal')
@section('third_party_scripts')
@include('vendor.image_upload.script')
@include('vendor.richtexteditor.script')
@endsection

@if (isset($employerJob) && !empty($employerJob->expiration_date))
    @include('vendor.moment.datetimepicker', ['dateFields' => ['expiration_date' => $employerJob->expiration_date]])
@else
    @push('page_scripts')
    <script>

//var formSubmit = 0;
        $(document).ready(function() {

            $("select", "#step2").addClass("ignore"); // do not validate #form2 input
            $("input", "#step3").addClass("ignore"); // do not validate #form2 input
            $("select", "#step3").addClass("ignore"); // do not validate #form2 input
            $("input", "#step4").addClass("ignore"); // do not validate #form2 input
            $("input", "#step5").addClass("ignore");
            $("input", "#step6").addClass("ignore");
            $("select", "#step6").addClass("ignore");
            $("textarea", "#step6").addClass("ignore");

            var v = $("#frm_employerJob").validate({
                ignore: ".ignore",
                rules: {
                    title: "required",
                    category_id: "required",
                    'skill_id[]': "required",
                    'qualification_id[]': "required",
                    experience_id: "required",
                    nationality: "required",
                    location_address: "required",
                    state_id: "required",
                    location_id: "required",
                    'communication_setting[]': {
                        required: true,
                        maxlength: 2
                    }
                },
                submitHandler: function(form) {
                    var skill = filterNumberValue($('[name="skill_weightage"]').val());
                    var standard = filterNumberValue($('[name="standard_weightage"]').val());
                    var optional = filterNumberValue($('[name="optional_weightage"]').val());
                    // console.log(skill, '+', standard, '+', optional);
                    if ((skill + standard + optional) != 100) {
                        toastr.error("{{ trans('message.weightage_not_match') }}")
                    } else {
                        form.submit();
                    }
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

                if (v.form()) {
                    $("select", "#step2").removeClass("ignore");

                    $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
                    $('#step1').hide();
                    $('#step2').show();
                    window.scrollTo(0, 0);
                }

            });

            $("#previous1").click(function() {

                $("select", "#step2").addClass("ignore");

                current_fs = $(this).parent().parent();
                previous_fs = $(this).parent().parent().prev();

                $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");
                $('#step2').hide();
                $('#step1').show();
                window.scrollTo(0, 0);
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
                    // console.log($(this).attr('name'), $(this).val(), $(this).attr('type'), $(this).hasClass('is-invalid'), $(this).parent(), $(this).parent().find('span.text-danger'));
                    $(this).removeClass('is-invalid');
                } else if ($(this).val() == '' && $(this).val() == null) {
                    $(this).addClass('is-invalid');
                }

            })
        });

        var date = new Date();
        var threemonthafter = date.setMonth(date.getMonth() + 3);

        var m = moment(new Date());
        $('.datepicker').datetimepicker({
            minDate:  m.add(1, 'days').startOf('day'),
            format: "{{ config('constants.format.moment_date') }}",
            useCurrent: false,
            defaultDate:threemonthafter,

            // maxDate:dateAfter
        });
    </script>
    @endpush
@endif
