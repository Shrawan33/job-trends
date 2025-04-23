<script>
    var onloadCallback = function() {
        grecaptcha.render('captcha_element', {
        'sitekey' : "{{ config('constants.google_captcha.site_key') }}"
        });
    };
</script>

<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit"
        async defer>
</script>