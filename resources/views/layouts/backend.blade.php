<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>{{ config('app.name') }}</title>

        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{ asset('vendor/font-awesome/css/all.min.css') }}">

        <link rel="stylesheet" href="{{ asset('vendor/date-time-picker/css/datetimepicker.min.css') }}">

        <link rel="stylesheet" href="{{ asset('vendor/toastr/toastr.min.css') }}">


        <link rel="stylesheet" href="{{ asset('vendor/select2/css/select2.min.css') }}">

         <!-- iCheck -->
         <link rel="stylesheet" href="{{ asset('vendor/icheck-bootstrap/icheck-bootstrap.min.css') }}">

        <link rel="stylesheet" href="{{ asset('vendor/select2/css/select2-bootstrap4.min.css') }}">

        <!-- AdminLTE -->
        <link rel="stylesheet" href="{{ asset('vendor/admin-lte/css/adminlte.min.css') }}">

        <link rel="stylesheet" href="{{ asset('css/backend.css') }}">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        @yield('third_party_stylesheets')

        @stack('page_css')
    </head>
    <body class="hold-transition">

        @include('flash::message')
        <div class="clearfix"></div>
        @yield('content')
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
                    {{-- <div class="modal-footer">
                        <div id="create_another_label" class="d-none flex-content">
                            {!! Form::checkbox('create_another', 1, old('create_another', 0), ['id' => 'create_another', 'label' => 'Create Another']) !!}
                        </div>
                        <button type="button" class="btn btn-primary" id="save_button">{{__('Save')}}</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div> --}}
                </div>
            </div>
        </div>
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
        <!-- AdminLTE App -->
        <script src="{{ asset('vendor/admin-lte/js/adminlte.min.js') }}"></script>
        <script src="{{ asset('js/common/general.js') }}"></script>
        <script src="{{ asset('js/common/layout.js') }}"></script>
        @yield('third_party_scripts')

        @stack('page_scripts')
    </body>
</html>
