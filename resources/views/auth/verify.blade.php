@extends('layouts.front')

@section('content')
    <div class="container">
        @if (Route::has('login'))
            <div class="top-right links">
                {{-- @auth
                    <a href="{{ url('/home') }}">Home</a>
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Logout
                    </a>
                    <form id="logout-form" action="{{ !empty($logoutRoute) ? $logoutRoute : route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                @else
                    <a href="{{ route('login') }}">Login</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}">Register</a>
                    @endif
                @endauth --}}
            </div>
        @endif
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">{{ trans('label.verify_your_email_address ') }}</h3>
                    </div>
                    <div class="card-body">
                        @if (session('resent'))
                            <div class="alert alert-success" role="alert">{{ trans('label.a_fresh_verification_link') }}
                            </div>
                        @endif
                        <p>{{ trans('label.before_procesing_check_email') }}</p>
                        <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                            @csrf
                            <button type="submit" class="btn btn-link">
                                click here to request another
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
