$(document).ready(function () {
    $("#frm_language").validate({
        rules: {
            title: {
                required: true,
            },
        },
        messages: {
            title: {
                required: "Please provide language title.",
            },
        },
    });
});
