<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>{{ config('app.name') }}</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{ asset('vendor/font-awesome/css/all.min.css') }}">

        <link rel="stylesheet" href="{{ asset('vendor/bootstrap-toggle/css/bootstrap-toggle.min.css') }}">

        <!-- iCheck -->
        <link rel="stylesheet" href="{{ asset('vendor/icheck-bootstrap/icheck-bootstrap.min.css') }}">

        <link rel="stylesheet" href="{{ asset('vendor/select2/css/select2.min.css') }}">

        <link rel="stylesheet" href="{{ asset('vendor/select2/css/select2-bootstrap4.min.css') }}">

        <link rel="stylesheet" href="{{ asset('vendor/date-time-picker/css/datetimepicker.min.css') }}">

        <link rel="stylesheet" href="{{ asset('vendor/toastr/toastr.min.css') }}">

        <link rel="stylesheet" href="{{ asset('vendor/overlayScrollbars/css/OverlayScrollbars.min.css') }}">

        <!-- AdminLTE -->
        <link rel="stylesheet" href="{{ asset('vendor/admin-lte/css/adminlte.min.css') }}">

        <link rel="stylesheet" href="{{ asset('css/backend.css') }}">
        <link rel="stylesheet" href="{{ asset('css/theme.css') }}">
        <link rel="stylesheet" href="{{ asset('css/flaticon.css') }}">

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="{{ asset('js/setting-modal.js') }}"></script>

        @yield('third_party_stylesheets')

        @stack('page_css')
        <style>

    .img-preview{
        float:none;
    }
            </style>
    </head>

    <body class="hold-transition sidebar-mini layout-fixed">
        <div class="wrapper">
            <!-- Main Header -->
            <nav class="main-header navbar navbar-expand navbar-white navbar-light">
                <!-- Left navbar links -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                    </li>
                </ul>

                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown user-menu">
                        <a href="#" class="btn btn-default btn-flat float-right"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                {{trans('label.sign_out')}}
                                </a>
                                <form id="logout-form" action="{{ !empty($logoutRoute) ? $logoutRoute : route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                        {{-- <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                            <img src="{{ asset('img/user1.jpg') }}"
                                class="user-image img-circle elevation-2" alt="User Image">
                            <span class="d-none d-md-inline">{{ Auth::user()->name }}</span>
                        </a> --}}
                        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                            <!-- User image -->
                            <li class="user-header bg-primary">

                                {{-- <img src="{{ asset('img/user1.jpg') }}"
                                    class="img-circle elevation-2"
                                    alt="User Image">
                                <p>
                                    {{ Auth::user()->name }}
                                    <small>{{trans('label.member_since')}} {{ Auth::user()->created_at->format('M. Y') }}</small>
                                </p> --}}
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <a href="#" class="btn btn-default btn-flat">{{trans('label.profile')}}</a>

                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>

            <!-- Left side column. contains the logo and sidebar -->
            @include('layouts.sidebar')

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <section class="content">
                    @yield('content')
                </section>
            </div>

            <!-- Main Footer -->
            <footer class="main-footer">
                <strong>{{trans('label.copyright')}}{{ date('Y') }} <a href="#">{{ env('APP_NAME') }}</a>.</strong> {{trans('label.all_right')}}
            </footer>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="globalModal" role="dialog" aria-labelledby="globalModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body"></div>
                    <div class="modal-footer">
                        <div id="create_another_label" class="d-none flex-content">
                            {!! Form::checkbox('create_another', 1, old('create_another', 0), ['id' => 'create_another', 'label' => 'Create Another']) !!}
                        </div>
                        <button type="button" class="btn btn-primary" id="save_button">{{__('Save')}}</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">{{__('close')}}</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- jQuery -->
        <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
        <script src="{{asset('vendor/jquery-validation/jquery.validate.min.js')}}"></script>
        <script src="{{asset('vendor/jquery-validation/additional-methods.min.js')}}"></script>

        {{-- <script src="{{ asset('vendor/popper/umd/popper.min.js') }}"></script> --}}

        <!-- Bootstrap 4 -->
        <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

        {{-- <script src="{{ asset('vendor/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script> --}}
        <script src="{{ asset('vendor/toastr/toastr.min.js') }}"></script>

        <script src="{{ asset('vendor/moment/moment.min.js') }}"></script>

        <script src="{{ asset('vendor/date-time-picker/js/date-time-picker.min.js') }}"></script>

        <script src="{{ asset('vendor/bootstrap-toggle/js/bootstrap-toggle.min.js') }}"></script>

        <script src="{{ asset('vendor/select2/js/select2.full.min.js') }}"></script>

        <script src="{{ asset('vendor/bootstrap-switch/js/bootstrap-switch.min.js') }}"></script>

        <script src="{{ asset('vendor/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>

        <!-- AdminLTE App -->
        <script src="{{ asset('vendor/admin-lte/js/adminlte.min.js') }}"></script>

        <script src="{{ asset('js/common/general.js') }}"></script>

        <script>
            var globalModal = $("#globalModal");

            $(function () {
                // bsCustomFileInput.init();
                $.fn.modal.Constructor.prototype.enforceFocus = function() {};

                $.validator.setDefaults({
                    errorPlacement: function(error, elem) {
                        setErrorMessage(error[0].innerText, elem)
                    },
                    unhighlight: function(element, errorClass, validClass) {
                        console.log("un",element);
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
                        initDatePicker()
                    },
                });

                initDatePicker()

                $('.content select').not('.no-select2, .vue-select2, .input-group-select, .input-group-addon, .custom-select').select2({
                    selectOnClose: false,
                    resolve: true,
                    width: '100%',
                    theme: 'bootstrap4'
                });

                $('.content').find('select.input-group-select, select.input-group-addon').not('.select2, .vue-select2, .custom-select').select2({
                    selectOnClose: false,
                    resolve: true,
                    theme: 'bootstrap4'
                });

                $(document).on("change", ".select2-hidden-accessible", function() {
                    if ($(this).hasClass('error') == true) {
                        $(this).valid();
                    }
                });
            });

            $("input[data-bootstrap-switch]").each(function(){
                $(this).bootstrapSwitch('state', $(this).prop('checked'));
            });

            function initDatePicker()
            {
                $('.datepicker').datetimepicker({
                    format: "{{ config('constants.format.moment_date') }}",
                    useCurrent: true
                });

                $('.datetimepicker').datetimepicker({
                    format: "{{ config('constants.format.moment_datetime') }}",
                    useCurrent: true
                });
            }

            function setErrorMessage(error, elem) {
                elem.addClass('is-invalid');
                if (elem.hasClass('select2-hidden-accessible')) {
                    elem.parent().find('.select2-selection').addClass('is-invalid');
                }
                var span_help = '';
                if (elem.parent().hasClass("input-group")) {
                    span_help = elem.parent().next("span.help-block");
                } else if (elem.closest(".form-group").find(".form-check-inline")) {
                    span_help = elem.closest(".form-group").find("span.help-block");
                } else {
                    span_help = elem.parent().find("span.help-block");
                }

                span_help.addClass('invalid-feedback');
                span_help.html(error)
            }

            function resetElementError(elem)
            {console.log("resetElementError",elem);
                if(elem.hasClass('is-invalid')) {
                    elem.removeClass('is-invalid').addClass('is-valid');

                    if (elem.hasClass('select2-hidden-accessible')) {
                        elem.parent().find('.select2-selection').removeClass('is-invalid').addClass('is-valid');
                    }

                    // elem.removeClass('is-invalid')
                    if (elem.parent().hasClass("input-group")) {
                        elem.parent()
                            .next("span.help-block")
                            .html('');
                    } else if (elem.closest(".form-group").find(".form-check-inline")) {
                        elem.closest(".form-group").find("span.help-block").html('');
                    } else {
                        elem.parent().find("span.help-block").html('');
                    }
                }
            }
        </script>

        @yield('third_party_scripts')

        @stack('page_scripts')
        @if(old('toast_error',false) == true ||  old('toast_success',false) == true)
        <script>
            $(document).ready(function(){
                @if(old('toast_error',false))
                toastr.error('{{old("toast_error")}}');
                @else
                toastr.success('{{old("toast_success")}}');
                @endif
            })
        </script>
        @endif

        <script>
            $(document).on('submit', 'form', function (e) {
            e.preventDefault();

            let $form = $(this);
            let url = $form.attr('action');
            let method = $form.attr('method');
            let formData = new FormData(this);
            let form_key = $form.find('input[name="key"]').val(); // <-- ✅ this line is important

            $.ajax({
                url: url,
                type: method,
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    // ✅ Add this:
                    if (form_key === 'google_analytics') {
                        window.location.reload();
                        return;
                    }

                    // Default behavior
                    $('#mainModal').modal('hide');
                    if (window.LaravelDataTables && window.LaravelDataTables["dataTableBuilder"]) {
                        window.LaravelDataTables["dataTableBuilder"].ajax.reload();
                    }
                },
                error: function (err) {
                    // show error
                }
            });
        });

        </script>
    </body>
</html>
