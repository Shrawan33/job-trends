$(document).ready(function () {
    $("#frm-Inquiry").validate({
        rules: {
            name: {
                required: true,
            },
            email: {
                required: true,
            },
            description: {
                required: true,
            },
            phone: {
                required: true
            }

        },
        messages: {
            name: {
                required: "Please provide name title.",
            },
            email: {
                required: "Please provide email title.",
            },
            description: {
                required: "Please provide description title.",
            },
            phone: {
                required: "Please provide a phone number."
            }

        },
    });
    // document.getElementById("frm-Inquiry").addEventListener("submit", function (evt) {

    //     var response = grecaptcha.getResponse();
    //     if (response.length == 0) {
    //         //reCaptcha not verified
    //         $('.recaptcha-error').html('please verify you are humann!');

    //         evt.preventDefault();
    //         return false;
    //     }
    //     //captcha verified
    //     //do the rest of your validations here

    // });

    document.getElementById("frm-Inquiry").addEventListener("submit", function (evt) {
        var response = grecaptcha.getResponse();
        if (response.length == 0) {
            // reCaptcha not verified
            $('.recaptcha-error').html('Please verify that you are human!');
            evt.preventDefault();
            return false;
        }

        // Captcha verified, perform additional validations
        var email = document.getElementById('email').value;
        var phone = document.getElementById('phone').value;

        if (!isValidEmail(email)) {
            // Email is not valid
            $('.email-error').html('Please provide a valid email address.').css('color', 'red');
            evt.preventDefault();
            return false;
        } else {
            // Email is valid, clear error message
            $('.email-error').html('');
        }

        if (!isValidPhone(phone)) {
            // Phone number is not valid
            $('.phone-error').html('Please provide a valid phone number.').css('color', 'red');
            evt.preventDefault();
            return false;
        } else {
            // Phone number is valid, clear error message
            $('.phone-error').html('');
        }

        // All validations passed, submit the form
        // Uncomment the following line if you want to submit the form
        // document.getElementById("frm-Inquiry").submit();
    });

    function isValidEmail(email) {
        // Add your email validation logic here
        // Example validation using regular expression
        var emailRegex = /^[\w-]+(\.[\w-]+)*@([\w-]+\.)+[a-zA-Z]{2,7}$/;
        return emailRegex.test(email);
    }

    function isValidPhone(phone) {
        // Add your phone number validation logic here
        // Example validation using regular expression for a US phone number
        var phoneRegex = /^\(?(\d{3})\)?[- ]?(\d{3})[- ]?(\d{4})$/;
        return phoneRegex.test(phone);
    }

});
