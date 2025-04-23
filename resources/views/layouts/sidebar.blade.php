<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{ !empty($homeRoute) ? $homeRoute : route('home') }}" class="brand-link">
        {{-- <img src="{{ asset('images/withouttext-logo.svg') }}" alt="{{ config('app.name') }} Logo"
            class="brand-image img-circle elevation-3"> --}}
        {{-- <span class="brand-text font-weight-light d-inline-block">Ministry of<br> Education and Youth</span> --}}
        <img src="{{ asset('images/Logo.png') }}" alt="logo" class="black_logo">
    </a>
    <a class="navbar-brand" href="{{ route('home.verfied') }}">
        {{-- <img src="{{ asset('images/home_logo.svg') }}" alt="logo" class="white_logo"> --}}
        {{-- <img src="{{ asset('images/black_logo.svg') }}" alt="logo" class="black_logo"> --}}
    </a>

    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                @include('layouts.menu')
            </ul>
        </nav>
    </div>

</aside>


