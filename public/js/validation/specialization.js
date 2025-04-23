$(document).ready(function () {
    $("#frm_specialization").validate({
        rules: {
            name: {
                required: true,
            },
        },
        messages: {
            name: {
                // required: "Please provide specialization name.",
            },
        },
    });
});
