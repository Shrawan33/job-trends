var globalModal = $("#globalModal");

$(function () {
    // bsCustomFileInput.init();
    $.fn.modal.Constructor.prototype.enforceFocus = function() {};

    $.validator.setDefaults({
        errorPlacement: function(error, elem) {
            setErrorMessage(error[0].innerText, elem)
        },
        unhighlight: function(element, errorClass, validClass) {
            // console.log("un",element);
            $(element).removeClass(errorClass).addClass(validClass);
            resetElementError($(element));
        }
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        beforeSend: function () {
            // toggleLoader()
            $(document.body).css({ cursor: "wait" });
        },
        complete: function() {
            $(document.body).css({ cursor: "default" });
            // initDatePicker()
        },
    });

    // initDatePicker()

    $(document.body).find('select').not('.no-select2, .vue-select2, .input-group-select, .input-group-addon, .custom-select, .select-with-tag').select2({
        selectOnClose: false,
        resolve: true,
        width: '100%',
        theme: 'bootstrap4'
    });

    $(document.body).find('.select-with-tag').not('.no-select2, .vue-select2, .input-group-select, .input-group-addon, .custom-select').select2({
        selectOnClose: false,
        matcher: function (textTerm, dataTerm) {
            if ($.trim(textTerm) === '') {
                return dataTerm;
            }

            if (dataTerm.text.toUpperCase().indexOf(textTerm.term.toUpperCase()) == 0) {
              return dataTerm;
            }

            return null;
        },
        resolve: true,
        width: '100%',
        theme: 'bootstrap4',
        maximumInputLength: 30,
        tags: true,
        createTag: function (params) {
            var term = $.trim(params.term);

            if (term === '') {
                return null;
            }

            return {
                id: term,
                text: term,
                newTag: true // add additional parameters
            }
        },
        // templateResult: function (item) {
        //     // item.id = parseInt(item.id)
        //     console.log('result', item.hasOwnProperty('newTag'));
        //     if (item.hasOwnProperty('newTag')) {
        //         return item.id
        //     }

        //     return item.text;
        // },
        // templateSelection: function (item) {

        //     console.log('selection', item.hasOwnProperty('newTag'));
        //     if (item.hasOwnProperty('newTag')) {
        //       return item.id;
        //     }
        //     return item.text
        // }
    });

    $(document.body).find('select.input-group-select, select.input-group-addon').not('.select2, .vue-select2, .custom-select, .select-with-tag').select2({
        selectOnClose: false,
        resolve: true,
        theme: 'bootstrap4'
    });

    $(document).on("change", ".select2-hidden-accessible", function() {
        if ($(this).hasClass('error') == true) {
            $(this).valid();
        }
    });

    $('body').tooltip({selector: '[data-toggle="tooltip"]'});
    $('body').on('click', '[data-toggle="tooltip"]', function(){
        $(this).tooltip('hide')
    })
});

// $("input[data-bootstrap-switch]").each(function(){
//     $(this).bootstrapSwitch('state', $(this).prop('checked'));
// });

// function initDatePicker()
// {
//     $('.datepicker').datetimepicker({
//         format: "{{ config('constants.format.moment_date') }}",
//         useCurrent: true
//     });

//     $('.datetimepicker').datetimepicker({
//         format: "{{ config('constants.format.moment_datetime') }}",
//         useCurrent: true
//     });
// }

function setErrorMessage(error, elem) {
    elem.addClass('is-invalid');
    if (elem.hasClass('select2-hidden-accessible')) {
        elem.parent().find('.select2-selection').addClass('is-invalid');
    }
    var span_help = '';
    if (elem.parent().hasClass("input-group")) {
        span_help = elem.parent().next("span.error");
    } else if (elem.closest(".form-group").find(".form-check-inline")) {
        span_help = elem.closest(".form-group").find("span.error");
    } else {
        span_help = elem.parent().find("span.error");
    }
    span_help.html(error)
}

function resetElementError(elem)
{
    // console.log("resetElementError",elem);
    if(elem.hasClass('is-invalid')) {
        elem.removeClass('is-invalid').addClass('is-valid');

        if (elem.hasClass('select2-hidden-accessible')) {
            elem.parent().find('.select2-selection').removeClass('is-invalid').addClass('is-valid');
        }

        // elem.removeClass('is-invalid')
        if (elem.parent().hasClass("input-group")) {
            elem.parent()
                .next("span.error")
                .html('');
        } else if (elem.closest(".form-group").find(".form-check-inline")) {
            elem.closest(".form-group").find("span.error").html('');
        } else {
            elem.parent().find("span.error").html('');
        }
    }
}
