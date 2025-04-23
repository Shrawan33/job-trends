<meta name="csrf-token" content="{{ csrf_token() }}">

@yield('third_party_stylesheets')

@stack('page_css')

@yield('content')

@yield('third_party_scripts')

@stack('page_scripts')
