<!DOCTYPE html>
<html>
    <head>
        @include('users.pdf_components.head')
        <style>
            body {
                background-image: url('{{ asset('images/pdf_placeholder.png') }}');
                background-repeat: no-repeat;
                background-size: 60%;
                background-position: center center;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="new-page">
                @include('users.pdf_components.smart_resume_download')
            </div>
        </div>
    </body>
</html>
{{-- @dd(); --}}
