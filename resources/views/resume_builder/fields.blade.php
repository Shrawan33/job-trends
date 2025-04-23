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
{!! Form::hidden('seeker_id', $userId ?? '', ['id' => 'seeker_id']) !!}

<div class="row mb-50 mx-0">
    @if ($step && $step != 5)
        <div class="col-md-3 step_main_wraper">
            @include($entity['view'] . '.fields_left')
        </div>
    @endif


    <!-- HTML structure for steps -->
    <div class="@if ($step && $step != 5) step_detail_wraper col-md-9 @else col-12 step-5-wrapper @endif">
        @if ($step && $step == 1)
            @include($entity['view'] . '.fields_step1')
        @elseif ($step && $step == 2)
            @include($entity['view'] . '.fields_step2')
        @elseif ($step && $step == 3)
            @include($entity['view'] . '.fields_step3')
        @elseif ($step && $step == 4)
            @include($entity['view'] . '.fields_step5')
        {{-- @elseif ($step && $step == 5)
            @include($entity['view'] . '.fields_step5') --}}
        @endif
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
<script>
    $(function() {
        // Dynamically add/remove inputs for any field[]'s
        $('.experience-field-wrapper').each(function() {
            var $wrapper = $('.experience-fields', this);
            // Add button

            $(".exp-add-field", $(this)).click(function(e) {
                var data = [];
                var cloned_content = $('.experience-field:first-child', $wrapper).clone(true)
                    .appendTo($wrapper);
                cloned_content.find('input, select, textarea').val('');
                // alert("hello")
                cloned_content.find('input[type!=hidden]:first').focus();
                cloned_content.find('#remove-button').removeClass('d-none');
                var namekey = $('.experience-field').length - 1;
                cloned_content.find('input, select').each(function() {
                    stringtoreplace = $(this).attr('name');
                    $(this).attr('name', stringtoreplace.replace("[0]", "[" + namekey +
                        "]"));
                });

                cloned_content.find('textarea').each(function() {
                    stringtoreplace = $(this).attr('name');
                    var editor = CKEDITOR.instances[stringtoreplace];
                    if (editor) {
                        editor.destroy(true);
                    }
                    $(this).next().remove();
                    $(this).attr('name', stringtoreplace.replace("[0]", "[" + namekey +
                        "]"));
                    var textareaId = 'description-' + namekey;
                    $(this).attr('id', textareaId);
                    CKEDITOR.replace(textareaId);
                    var editor = CKEDITOR.instances[textareaId];
                    editor.setData(data[stringtoreplace]);
                });

                cloned_content.find('a').each(function() {


                    btnName = $(this).data("name");
                    if (btnName == 'chatgpt-generate-button-expr') {
                        var btnId = 'chatgpt-generate-button-expr-' + namekey;
                        $(this).attr('id', btnId);
                        $(this).attr("data-id", namekey);
                        var openId = "open-ai-content-"+namekey;
                        $(this).closest('.experience-field').find('.open-ai-content').attr("id", openId);
                        $(this).closest('.experience-field').find('.ai_description_generate').attr("data-regenerate-id", namekey);
                        $(this).closest('.experience-field').find('.copy_description').attr("data-copy-id", namekey);

                        //$('.chatgpt-generate-button-expr[data-id='+namekey+']').closest('.experience-field').find('#regenerate-description').attr("data-id", namekey);
                    }
                })
            });

            // Remove buttons
            $('.experience-field .exp-remove-field', $wrapper).click(function() {
                if ($('.experience-field', $wrapper).length > 1) {
                    $(this).parents('.experience-field').remove();
                }
            });

            // Initialize CKEditor for the initial description textarea
            var textareaId = 'description-0';
            CKEDITOR.replace(textareaId);
        });
    });
</script>
<script>
    $(function() {
        // Dynamically add/remove inputs for any field[]'s
        $('.license-field-wrapper').each(function() {
            var $wrapper = $('.license-fields', this);
            // Add button

            $(".lic-add-field", $(this)).click(function(e) {
                var data = [];
                var cloned_content = $('.license-field:first-child', $wrapper).clone(true)
                    .appendTo($wrapper);
                cloned_content.find('input, select, textarea').val('');
                // alert("hello")
                cloned_content.find('input[type!=hidden]:first').focus();
                cloned_content.find('#remove-button').removeClass('d-none');
                var namekey = $('.license-field').length - 1;
                cloned_content.find('input, select').each(function() {
                    stringtoreplace = $(this).attr('name');
                    $(this).attr('name', stringtoreplace.replace("[0]", "[" + namekey +
                        "]"));
                });

                cloned_content.find('textarea').each(function() {
                    stringtoreplace = $(this).attr('name');
                    var editor = CKEDITOR.instances[stringtoreplace];
                    if (editor) {
                        editor.destroy(true);
                    }
                    $(this).next().remove();
                    $(this).attr('name', stringtoreplace.replace("[0]", "[" + namekey +
                        "]"));
                    var textareaId = 'description-' + namekey;
                    $(this).attr('id', textareaId);
                    CKEDITOR.replace(textareaId);
                    var editor = CKEDITOR.instances[textareaId];
                    editor.setData(data[stringtoreplace]);
                });
            });

            // Remove buttons
            $('.license-field .lic-remove-field', $wrapper).click(function() {
                if ($('.license-field', $wrapper).length > 1) {
                    $(this).parents('.license-field').remove();
                }
            });

            // Initialize CKEditor for the initial description textarea
            var textareaId = 'description-0';
            CKEDITOR.replace(textareaId);
        });
    });
</script>
<script>
    $(function() {
        // Dynamically add/remove inputs for any field[]'s
        $('.education-field-wrapper').each(function() {
            var $wrapper = $('.education-fields', this);
            // Add button

            $(".edu-add-field", $(this)).click(function(e) {
                var data = [];
                var cloned_content = $('.education-field:first-child', $wrapper).clone(true)
                    .appendTo($wrapper);
                cloned_content.find('input, select, textarea').val('');
                // alert("hello")
                cloned_content.find('input[type!=hidden]:first').focus();
                cloned_content.find('#remove-button').removeClass('d-none');
                var namekey = $('.education-field').length - 1;
                cloned_content.find('input, select').each(function() {
                    stringtoreplace = $(this).attr('name');
                    $(this).attr('name', stringtoreplace.replace("[0]", "[" + namekey +
                        "]"));
                });

                cloned_content.find('textarea').each(function() {
                    stringtoreplace = $(this).attr('name');
                    var editor = CKEDITOR.instances[stringtoreplace];
                    if (editor) {
                        editor.destroy(true);
                    }
                    $(this).next().remove();
                    $(this).attr('name', stringtoreplace.replace("[0]", "[" + namekey +
                        "]"));
                    var textareaId = 'description-' + namekey;
                    $(this).attr('id', textareaId);
                    CKEDITOR.replace(textareaId);
                    var editor = CKEDITOR.instances[textareaId];
                    editor.setData(data[stringtoreplace]);
                });

                cloned_content.find('a').each(function() {
                    anchorClass = $(this).attr('class');

                    if (anchorClass == 'chatgpt-generate-button-expr') {
                        var btnId = 'chatgpt-generate-button-expr-' + namekey;
                        $(this).attr('id', btnId);
                    }
                })
            });

            // Remove buttons
            $('.education-field .edu-remove-field', $wrapper).click(function() {
                if ($('.education-field', $wrapper).length > 1) {
                    $(this).parents('.education-field').remove();
                }
            });

            // Initialize CKEditor for the initial description textarea
            var textareaId = 'description-0';
            CKEDITOR.replace(textareaId);
        });
    });
</script>
@endpush
