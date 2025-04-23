@extends('layouts.front')

@section('content')

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-6 ">
                <div class="login-form p-4 mb-30 rounded">
                    <h2 class="mt-3 pb-4 font-weight-bold h3">{{trans('label.reset_pass')}} </h2>
                    <p>{{trans('label.recover_password')}}</p>
                    <form action="{{ route('forgot_password.reset') }}" method="POST">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">

                        {{-- <div class="form-group mb-4">
                            <input
                                type="password" name="password"
                                class="form-control @error('password') is-invalid @enderror"
                                placeholder="{{trans('label.password')}}"
                            >
                            @error('password')
                                <span class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div> --}}
                        <div class="form-group mb-4" id="popover-password">
                            <label for="">{{ trans('label.password') }}<span class="text-danger">*</span></label>
                            <input id="password" type="password" name="password" placeholder="" class="form-control input-md @error('password') is-invalid @enderror" data-placement="bottom" data-toggle="popover" data-container="body" type="button" data-html="true">
                            <div class="progress">
                                <div id="password-strength" class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:0%">
                                </div>
                            </div>
                            <div class="mt-1">
                                <p class="mb-2">Password Strength: <span id="result"> </span></p>
                                <ul class="pl-3 m-0">
                                    <li class="">1 lowercase &amp; 1 uppercase</li>
                                    <li class="">1 Special Character (!@#$%^&*).</li>
                                    <li class="">Atleast 8 Character</li>
                                </ul>
                            </div>
                            @error('password')
                                <span class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group input-group  mb-4">
                            <input
                                type="password" name="password_confirmation"
                                class="form-control password"id="password"
                                placeholder="{{trans('label.confirm_password')}}"
                            >
                             <button type="button" id="togglePassword"
                                                        class="password-icon">
                                                        <div>
                                                            <svg id="svg1" xmlns="http://www.w3.org/2000/svg"
                                                                width="24" height="24" viewBox="0 0 24 24"
                                                                fill="none">
                                                                <path
                                                                    d="M2.42012 12.7132C2.28394 12.4975 2.21584 12.3897 2.17772 12.2234C2.14909 12.0985 2.14909 11.9015 2.17772 11.7766C2.21584 11.6103 2.28394 11.5025 2.42012 11.2868C3.54553 9.50484 6.8954 5 12.0004 5C17.1054 5 20.4553 9.50484 21.5807 11.2868C21.7169 11.5025 21.785 11.6103 21.8231 11.7766C21.8517 11.9015 21.8517 12.0985 21.8231 12.2234C21.785 12.3897 21.7169 12.4975 21.5807 12.7132C20.4553 14.4952 17.1054 19 12.0004 19C6.8954 19 3.54553 14.4952 2.42012 12.7132Z"
                                                                    stroke="black" stroke-width="1.5"
                                                                    stroke-linecap="round"
                                                                    stroke-linejoin="round" />
                                                                <path
                                                                    d="M12.0004 15C13.6573 15 15.0004 13.6569 15.0004 12C15.0004 10.3431 13.6573 9 12.0004 9C10.3435 9 9.0004 10.3431 9.0004 12C9.0004 13.6569 10.3435 15 12.0004 15Z"
                                                                    stroke="black" stroke-width="1.5"
                                                                    stroke-linecap="round"
                                                                    stroke-linejoin="round" />
                                                            </svg>
                                                            <svg id="svg2" xmlns="http://www.w3.org/2000/svg"
                                                                width="24" height="24" viewBox="0 0 24 24"
                                                                fill="none" style="display:none">
                                                                <path
                                                                    d="M10.7429 5.09232C11.1494 5.03223 11.5686 5 12.0004 5C17.1054 5 20.4553 9.50484 21.5807 11.2868C21.7169 11.5025 21.785 11.6103 21.8231 11.7767C21.8518 11.9016 21.8517 12.0987 21.8231 12.2236C21.7849 12.3899 21.7164 12.4985 21.5792 12.7156C21.2793 13.1901 20.8222 13.8571 20.2165 14.5805M6.72432 6.71504C4.56225 8.1817 3.09445 10.2194 2.42111 11.2853C2.28428 11.5019 2.21587 11.6102 2.17774 11.7765C2.1491 11.9014 2.14909 12.0984 2.17771 12.2234C2.21583 12.3897 2.28393 12.4975 2.42013 12.7132C3.54554 14.4952 6.89541 19 12.0004 19C14.0588 19 15.8319 18.2676 17.2888 17.2766M3.00042 3L21.0004 21M9.8791 9.87868C9.3362 10.4216 9.00042 11.1716 9.00042 12C9.00042 13.6569 10.3436 15 12.0004 15C12.8288 15 13.5788 14.6642 14.1217 14.1213"
                                                                    stroke="black" stroke-width="1.5"
                                                                    stroke-linecap="round"
                                                                    stroke-linejoin="round" />
                                                            </svg>
                                                    </button>
                        </div>
                        <div class="row mt-4">
                            <div class="col-12">
                                <button
                                    type="submit"
                                    class="btn btn-primary mx-auto px-5"
                                >
                                    {{trans('label.reset_password')}}
                                </button>
                            </div>
                            <!-- /.col -->
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {

    $('#password').keyup(function() {
        var password = $('#password').val();
        if (checkStrength(password) == false) {
            $('#sign-up').attr('disabled', true);
        }
    });






    function checkStrength(password) {
        var strength = 0;


        //If password contains both lower and uppercase characters, increase strength value.
        if (password.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/)) {
            strength += 1;
            $('.low-upper-case').addClass('text-success');
            $('.low-upper-case i').removeClass('fa-file-text').addClass('fa-check');
            $('#popover-password-top').addClass('hide');


        } else {
            $('.low-upper-case').removeClass('text-success');
            $('.low-upper-case i').addClass('fa-file-text').removeClass('fa-check');
            $('#popover-password-top').removeClass('hide');
        }

        //If it has numbers and characters, increase strength value.
        if (password.match(/([a-zA-Z])/) && password.match(/([0-9])/)) {
            strength += 1;
            $('.one-number').addClass('text-success');
            $('.one-number i').removeClass('fa-file-text').addClass('fa-check');
            $('#popover-password-top').addClass('hide');

        } else {
            $('.one-number').removeClass('text-success');
            $('.one-number i').addClass('fa-file-text').removeClass('fa-check');
            $('#popover-password-top').removeClass('hide');
        }

        //If it has one special character, increase strength value.
        if (password.match(/([!,%,&,@,#,$,^,*,?,_,~])/)) {
            strength += 1;
            $('.one-special-char').addClass('text-success');
            $('.one-special-char i').removeClass('fa-file-text').addClass('fa-check');
            $('#popover-password-top').addClass('hide');

        } else {
            $('.one-special-char').removeClass('text-success');
            $('.one-special-char i').addClass('fa-file-text').removeClass('fa-check');
            $('#popover-password-top').removeClass('hide');
        }

        if (password.length > 7) {
            strength += 1;
            $('.eight-character').addClass('text-success');
            $('.eight-character i').removeClass('fa-file-text').addClass('fa-check');
            $('#popover-password-top').addClass('hide');

        } else {
            $('.eight-character').removeClass('text-success');
            $('.eight-character i').addClass('fa-file-text').removeClass('fa-check');
            $('#popover-password-top').removeClass('hide');
        }




        // If value is less than 2

        if (strength < 2) {
            $('#result').removeClass()
            $('#password-strength').addClass('progress-bar-danger');

            $('#result').addClass('text-danger').text('Very Week');
            $('#password-strength').css('width', '10%');
        } else if (strength == 2) {
            $('#result').addClass('good');
            $('#password-strength').removeClass('progress-bar-danger');
            $('#password-strength').addClass('progress-bar-warning');
            $('#result').addClass('text-warning').text('Week')
            $('#password-strength').css('width', '60%');
            return 'Week'
        } else if (strength == 4) {
            $('#result').removeClass()
            $('#result').addClass('strong');
            $('#password-strength').removeClass('progress-bar-warning');
            $('#password-strength').addClass('progress-bar-success');
            $('#result').addClass('text-success').text('Strength');
            $('#password-strength').css('width', '100%');

            return 'Strong'
        }

    }

});
</script>
