history.go = function() {};

var formModel = "";
var rawFormSubmitted, modalSize, mode, url, title, requestdata, modalButtonText;

$(document).ready(function() {
    $(document).on("click", "a.open-form", function() {
        formModel = $(this).data("model");
        mode = $(this).data("mode");
        url = $(this).data("url");
        title = $(this).data("title");
        modalSize = $(this).data("modal-size");
        requestdata = $(this).data("requestdata");
        modalButtonText = $(this).data("button_text");
        openForm();
    });

    $(".explore_job").on("click", function() {
        $(".page_content_main_wraper").toggleClass("active");
        $(this).toggleClass("active");
    });

    $("button#save_button").on("click", function() {
        clearSuccessAndErrorMessage();
        formSubmit(formModel);
    });

    // Delete datatable Row
    $(document).on("submit", "form.frm-delete-datatable-row", function(e) {
        e.preventDefault();
        var form = $(this);
        formModel = form.data("model");
        var url = form.attr("action");
        var type = form.attr("method");
        var data = form.serialize();
        $.ajax({
            url: url,
            type: type,
            data: data,
            success: function(response) {
                if (response.success === false) {
                    // $("#errorMessage")
                    //     .removeClass("d-none")
                    //     .html(response.message);
                    toastr.error(response.message);
                } else {
                    // $("#successMessage")
                    //     .removeClass("d-none")
                    //     .html(response.message);
                    toastr.success(response.message);
                    reloadDataTable(formModel);
                }
            }
        });
    });
    globalModal.on("show.bs.modal", function() {
        initModalSelect2();

        // globalModal.find("input").not(".no-iCheck").iCheck({
        //     checkboxClass: "icheckbox_square-blue",
        //     radioClass: "iradio_square-blue",
        //     increaseArea: "20%", // optional
        // });
    });
    globalModal.on("hidden.bs.modal", function(e) {
        resetModel();
    });

    $(document).on("click", "a.ajax-operation", function() {
        var url = $(this).data("url");
        var dataModel = $(this).data("model");
        var dataRequest = $(this).data("request");
        var requestType = $(this).data("type");

        if (
            dataRequest == undefined ||
            dataRequest == null ||
            dataRequest == ""
        ) {
            dataRequest = "";
        }
        if (
            requestType == undefined ||
            requestType == null ||
            requestType == ""
        ) {
            requestType = "get";
        }

        processAjaxOperation(
            url,
            requestType,
            dataRequest,
            "application/json",
            dataModel,
            null,
            false,
            null,
            true
        );
    });
    jQuery(".inner_box").click(function() {
        jQuery(".right_side").addClass("active");
    });
    jQuery(".go_back_btn").click(function() {
        jQuery(".right_side").removeClass("active");
    });
});

function initModalSelect2() {
    globalModal
        .find("select")
        .not(".no-select2")
        .not(".vue-select2")
        .select2({
            selectOnClose: false,
            dropdownParent: globalModal,
            resolve: true,
            width: "100%"
        })
        .on("change", function() {
            $(this).valid();
        });
}

function openForm() {
    if (modalButtonText != undefined) {
        globalModal.find("#save_button").text(modalButtonText);
    }

    clearSuccessAndErrorMessage();
    globalModal.find(".modal-title").html(title);
    if (mode == "create")
        globalModal.find("#create_another_label").removeClass("d-none");
    else if (mode == "show") {
        globalModal.find("#save_button").addClass("d-none");
    }

    getForm(url, requestdata);
}

function getForm(
    url,
    data = null,
    contentModel = null,
    contentTitle = null,
    contentModalSize = null,
    buttonText = null
) {
    $.ajax({
        url: url,
        data: data,
        method: "get",
        success: function(response) {
            if (response.success === false) {
                // $("#errorMessage").removeClass("d-none").html(response.message);
                toastr.error(response.message);
            } else {
                globalModal.find(".modal-body").html(response.data);
                globalModal.modal("show");
                if (contentModel != null) {
                    formModel = contentModel;
                }

                if (contentModalSize != null) {
                    modalSize = contentModalSize;
                }

                if (modalSize != undefined) {
                    globalModal.find(".modal-dialog").addClass(modalSize);
                }

                if (buttonText != null) {
                    globalModal.find("#save_button").text(buttonText);
                }

                if (contentTitle != null) {
                    globalModal.find(".modal-title").html(contentTitle);
                }
            }
            rawFormSubmitted = false;
        },
        error: function(err, obj) {
            // $("#errorMessage")
            //     .removeClass("d-none")
            //     .html("Something went wrong. Please try again.");
            toastr.error("Something went wrong. Please try again.");
            rawFormSubmitted = false;
        }
    });
}

function contentModal(title, content_id) {
    showContentModal(title, $("#" + content_id).html());
}

function showContentModal(title, content) {
    globalModal.find(".modal-title").html(title);
    globalModal.find("#save_button").addClass("d-none");
    globalModal.find(".modal-body").html(content);
    globalModal.modal("show");
}

function resetModel() {
    if (modalSize != undefined) {
        globalModal.find(".modal-dialog").removeClass(modalSize);
    }
    globalModal.find(".modal-title").html("");
    globalModal.find(".modal-body").html("");
    globalModal.find("#save_button").removeClass("d-none");
    //globalModal.find("#create_another_checkbox").iCheck("destroy");
    globalModal.find("#create_another_checkbox").prop("checked", false);
    globalModal.find("#create_another_label").addClass("d-none");

    if (typeof app2 != "undefined" && app2 instanceof Vue) {
        // console.log('before ', app2);
        // app2.$destroy();
        app2 = undefined;
        delete app2;
        // console.log('after ', app2);
    }
}

function reloadDataTable(model) {
    // console.log(window.LaravelDataTables[model + "-datatable"], ' - reload');
    if (
        window.hasOwnProperty("LaravelDataTables") &&
        window.LaravelDataTables.hasOwnProperty(model + "-datatable")
    )
        window.LaravelDataTables[model + "-datatable"].draw();
}

function formSubmit(model) {
    var create_another = globalModal
        .find('[name="create_another"]')
        .prop("checked");
    var form = globalModal.find("#frm_" + model);
    var url = form.attr("action");
    var type = form.attr("method");
    var data = form.serialize();

    var data = new FormData(form[0]);

    if ($("#frm_" + model).valid()) {
        processAjaxOperation(
            url,
            type,
            data,
            false,
            model,
            form,
            create_another
        );
    }
}

function processAjaxOperation(
    url,
    type,
    data,
    contentType = false,
    model,
    parentContainer = null,
    create_another = false,
    dataType = null,
    processData = false
) {
    if (rawFormSubmitted) {
        return;
    }
    // console.log(data, typeof data);

    rawFormSubmitted = true;
    var options = {
        url: url,
        type: type,
        data: data,
        success: function(response) {
            if (response.success === true) {
                // $("#successMessage").removeClass("d-none").html(response.message);

                if (response.message) {
                    toastr.success(response.message);
                }

                // console.log(
                //     response["data"],
                //     response["data"].hasOwnProperty("callbackFunction")
                // );
                if (response["data"].hasOwnProperty("successURL")) {
                    // console.log('in redirect');
                    window.location.href = response["data"].successURL;
                } else if (
                    response["data"].hasOwnProperty("refreshContentId")
                ) {
                    // console.log("in refreshcontent");
                    if (response["data"].hasOwnProperty("refreshContent")) {
                        if (response["data"].hasOwnProperty("type")) {
                            refreshContent(
                                response["data"].refreshContentId,
                                response["data"].refreshContent,
                                response["data"].type
                            );
                            $('textarea[name="message"]').val("");
                            $("#message_box").animate(
                                {
                                    scrollTop: $(".thread_messages").prop(
                                        "scrollHeight"
                                    )
                                },
                                100
                            );
                        } else {
                            refreshContent(
                                response["data"].refreshContentId,
                                response["data"].refreshContent
                            );
                        }
                    } else {
                        refreshContent(
                            response["data"].refreshContentId,
                            "No record found."
                        );
                    }
                } else if (
                    response["data"].hasOwnProperty("callbackFunction")
                ) {
                    eval(response["data"].callbackFunction);
                } else {
                    reloadDataTable(model);
                }

                if (create_another) {
                    openForm();
                } else {
                    if (response["data"].hasOwnProperty("remainOpen")) {
                    } else {
                        globalModal.modal("hide");
                    }
                    rawFormSubmitted = false;
                }
            } else {
                // $("#errorMessage").removeClass("d-none").html(response.message);
                toastr.error(response.message);
                rawFormSubmitted = false;
            }
        },
        error: function(reject) {
            if (reject.status === 422) {
                var errors = $.parseJSON(reject.responseText);
                $.each(errors.errors, function(key, message) {
                    // applied for specifically SupplierRfq Model validating field "supplier_rfq_item.*.suppliers."
                    key = dotToArray(key);

                    if (parentContainer == null || parentContainer == "") {
                        parentContainer = $(document);
                    }
                    elem = parentContainer.find('[name="' + key + '"]');
                    if (elem.length == 0) {
                        elem = parentContainer.find('[name^="' + key + '"]');
                    }
                    setErrorMessage(message[0], elem);
                });
            } else {
                // console.log(reject);
                if (reject.status === 404) {
                    // $("#errorMessage")
                    //     .removeClass("d-none")
                    //     .html(reject.responseJSON.message);
                    toastr.error(reject.responseJSON.message);
                } else {
                    // $("#errorMessage")
                    //     .removeClass("d-none")
                    //     .html("Something went wrong. Please try again.");
                    toastr.error("Something went wrong. Please try again.");
                }
            }
            rawFormSubmitted = false;
        },
        contentType: contentType,
        processData: processData
    };

    if (dataType != null) {
        options.dataType = dataType;
    }
    $.ajax(options);
}

function dotToArray(str) {
    var output = "";
    var chucks = str.split(".");
    if (chucks.length > 1) {
        for (i = 0; i < chucks.length; i++) {
            if (i == 0) {
                output = chucks[i];
            } else {
                output += "[" + chucks[i] + "]";
            }
        }
    } else {
        output = chucks[0];
    }

    return output;
}

function clearSuccessAndErrorMessage() {
    // $("#errorMessage").addClass("d-none").html("");
    // $("#successMessage").addClass("d-none").html("");
    $("#laravelFlashMessages")
        .addClass("d-none")
        .html("");
}

function submitFormByaction(action, id, msg = "") {
    // prevent duplicate form submissions
    if (rawFormSubmitted) {
        return;
    }
    $("form#" + id)
        .find('input[name="process"]')
        .val(action);

    if (action == "delete") {
        var message =
            "This will delete the record permanently, do you want to delete?";
        if (msg != "") {
            message = msg;
        }
        if (confirm(message)) {
            rawformSubmit("DELETE", id, action);
        }
    } else if (action == "archive") {
        rawformSubmit("DELETE", id, action);
    } else if (action == "restore") {
        rawformSubmit("PATCH", id, action);
    }
}

function rawformSubmit(method, form_id, process) {
    $("form#" + form_id)
        .find('input[name="_method"]')
        .val(method);
    var url = $("form#" + form_id).attr("action");
    var data = JSON.stringify({ process: process, _method: method });
    var model = $("form#" + form_id).data("model");
    processAjaxOperation(
        url,
        method,
        data,
        "application/json",
        model,
        null,
        false
    );
}

function filterNumberValue(number) {
    number = parseFloat(number);
    return number == "" || number == undefined || isNaN(number) ? 0 : number;
}

function isStorageAvailable() {
    try {
        return "localStorage" in window && window["localStorage"] !== null;
    } catch (e) {
        return false;
    }
}

function refreshContent(target, content, type = "id") {
    // $("#" + target).html(content);
    // console.log(target);
    // alert("in");
    if (type == "id") {
        $("#" + target).html(content);
    } else {
        $("." + target).html(content);
    }
} /*$applyjob->refreshContentId = 'job-display-action';
            $applyjob->refreshContent = view('components.jobs.action_buttons', ['job' => $applyjob->employerJob])->render();*/
function reInitSelect2(select2Obj = null, data = null, selectedData = null) {
    var options = {
        width: "100%",
        placeholder: "Choose One",
        allowClear: false,
        data: []
    };

    // console.log('reinit', data, selectedData, select2Obj);

    if (select2Obj != null) {
        var url = $(select2Obj).data("url");
        var placeholder = $(select2Obj).data("placeholder");
        var width = $(select2Obj).attr("width");
        var requestdata = $(select2Obj).data("requestdata");

        if (data == null) {
            var data = $(select2Obj).data("pre-filled-data");
        }
        if (selectedData == null) {
            var selectedData = $(select2Obj).data("selected");
        }
        // var callbackfunc = $(select2Obj).data('callback');

        options["placeholder"] = placeholder;
        options["width"] = width;
        options["data"] = data;
        options["ajax"] = {
            url: url,
            dataType: "json",
            data: function(params) {
                var request_param = {};
                if (
                    requestdata != undefined &&
                    requestdata != null &&
                    requestdata != ""
                ) {
                    request_param = requestdata;
                }
                request_param["term"] = params.term; // search term
                return request_param;
            }
        };
        // console.log('options - ', options, select2Obj);
        $(select2Obj).select2(options);
        $(select2Obj)
            .val(selectedData)
            .trigger("change");
    }
}

function copyToClipboard(element) {
    var $temp = $("<input>");
    $("body").append($temp);
    $temp.val($(element).val()).select();
    document.execCommand("copy");
    $temp.remove();
    toastr.success("Link Copied Successfully");
}

$(document).on("keypress", ".only_numbers", function(event) {
    var regex = new RegExp("^[0-9.]+$");
    var key = String.fromCharCode(
        !event.charCode ? event.which : event.charCode
    );
    if (!regex.test(key)) {
        event.preventDefault();
        return false;
    }
});

$(document).on("keyup", ".only_numbers", function(event) {
    let text = $(this).val();
    let decimal = 0;
    let thisDecimal = $(this).attr("data-decimal");
    let maxDigits = $(this).attr("data-maxDigits");

    if (!isUndefined(thisDecimal)) {
        decimal = parseInt(thisDecimal);
    }

    if (text.indexOf(".") != -1) {
        let splitText = text.split(".");
        if (decimal === 0) {
            $(this).val(splitText[0]);
        } else {
            $(this).val(splitText[0] + "." + splitText[1].substr(0, decimal));
        }
    }

    if (!isUndefined(maxDigits)) {
        $(this).val(
            $(this)
                .val()
                .substr(0, parseInt(maxDigits))
        );
    }
});

$(document).on("change", ".only_numbers", function() {
    $(this).val(
        $(this)
            .val()
            .replace(/[^0-9.]+/i, "")
    );
});

function isUndefined(value) {
    // Obtain `undefined` value that's
    // guaranteed to not have been re-assigned
    var undefined = void 0;
    return value === undefined;
}
toastr.options = {
    debug: false,
    positionClass: "toast-bottom-full-width",
    onclick: null,
    fadeIn: 300,
    fadeOut: 1000,
    timeOut: 5000,
    extendedTimeOut: 1000
};

//hide show password

const passwordInput = document.getElementById("password");
const showPasswordIcon = document.getElementById("svg1");
const hidePasswordIcon = document.getElementById("svg2");

if (passwordInput && showPasswordIcon && hidePasswordIcon) {
    // Add a click event listener to the SVG elements
    showPasswordIcon.addEventListener("click", () => {
        passwordInput.type = "text";
        showPasswordIcon.style.display = "none";
        hidePasswordIcon.style.display = "block";
    });

    hidePasswordIcon.addEventListener("click", () => {
        passwordInput.type = "password";
        hidePasswordIcon.style.display = "none";
        showPasswordIcon.style.display = "block";
    });

    hidePasswordIcon.addEventListener("click", () => {
        passwordInput.type = "password";
        hidePasswordIcon.style.display = "none";
        showPasswordIcon.style.display = "block";
    });
} else {
    //   console.log("");
}

//image zoom

$(document).ready(function() {
    $(".zoomable-img").click(function() {
        var imgSrc = $(this).attr("src");
        $("#zoomed-img").attr("src", imgSrc);
        $("#zoom-modal").fadeIn(200);
        $("body").css("overflow", "hidden"); // to prevent scrolling
    });

    $("#zoom-modal").click(function() {
        $("#zoom-modal").fadeOut(200);
        $("body").css("overflow", "auto"); // restore scrolling
    });
    const urlHash = window.location.hash;
    if (urlHash === "#explore_job_section") {
        $(".page_content_main_wraper").addClass("active");
        $(".explore_job").addClass("active");
    }
});
jQuery(window).scroll(function() {
    jQuery("body").height(),
        jQuery(window).scrollTop() > 70
            ? jQuery(".navbar").addClass("scrolldown")
            : jQuery(".navbar").removeClass("scrolldown");
});

var createPopover = function(item, title) {
    var $pop = $(item);

    $pop.popover({
        placement: "bottom",
        title: (title || "&nbsp;") + ' <span class="close"">&times;</span>',
        trigger: "click",
        html: true,
        content: function() {
            return $(item + "_container")
                .find("#popup-content")
                .html();
        }
    }).on("shown.bs.popover", function(e) {
        var current_popover = "#" + $(e.target).attr("aria-describedby");
        var $cur_pop = $(current_popover);

        $cur_pop.find(".close").click(function() {
            $pop.popover("hide");
        });

        $cur_pop.find(".OK").click(function() {
            //console.log('OK triggered');
            $pop.popover("hide");
        });
    });

    return $pop;
};

createPopover("#showPopover", "Demo popover!");

// function togglePassword(fieldId, showIconId, hideIconId) {
//     const passwordInput = document.getElementById(fieldId);
//     const showPasswordIcon = document.getElementById(showIconId);
//     const hidePasswordIcon = document.getElementById(hideIconId);

//     if (passwordInput.type === "password") {
//         passwordInput.type = "text";
//         showPasswordIcon.style.display = "none";
//         hidePasswordIcon.style.display = "block";
//     } else {
//         passwordInput.type = "password";
//         showPasswordIcon.style.display = "block";
//         hidePasswordIcon.style.display = "none";
//     }
// }

// // Initialize the event listeners for the original password field
// togglePassword("password", "showPasswordIcon", "hidePasswordIcon");

// // Initialize the event listeners for the confirm password field
// togglePassword(
//     "confirmPassword",
//     "showConfirmPasswordIcon",
//     "hideConfirmPasswordIcon"
// );
