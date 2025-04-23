@extends('layouts.backend')

@section('content')
<div class="login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="{{ route('staff.login') }}">
                <img src="{{ asset('images/Logo.png') }}" alt="logo" class="white_logo" height="60px">
                {{-- <img src="{{ asset('images/black_logo.svg') }}" alt="logo" class="black_logo"> --}}
            </a>
        </div>

        <!-- /.login-logo -->

        <!-- /.login-card-body -->
        <div class="card">

            <div class="card-body login-card-body">

                <h4 class="text-center">{{trans('label.admin_portal')}}</h4>

                <p class="login-box-msg">{{trans('label.signin_start')}}</p>

                <div class="clearfix"></div>
                @include('flash::message')
                <div class="clearfix"></div>

                <form method="post" action="{{ route('staff.login.store') }}">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="email"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="Email"
                            class="form-control @error('email') is-invalid @enderror">
                        <div class="input-group-append">
                            <div class="input-group-text"><span class="fas fa-envelope"></span></div>
                        </div>
                        @error('email')
                            <span class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input-group mb-3">
                        <input type="password"
                            name="password"
                            placeholder="Password"
                            class="form-control @error('password') is-invalid @enderror">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        @error('password')
                            <span class="error invalid-feedback">{{ $message }}</span>
                        @enderror

                    </div>

                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember">
                                <label for="remember">{{trans('label.remember_me')}}</label>
                            </div>
                        </div>

                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">{{trans('label.sign_in')}}</button>
                        </div>

                    </div>
                    <div class="row mt-3">
                        <a
                            href="{{ route('forgot_password') }}"
                            class="btn btn-link p-0  btn-sm text-metal"
                        >
                            {{trans('label.forgot_pass')}}
                        </a>
                    </div>
                </form>
            </div>
            <!-- /.login-card-body -->
        </div>

    </div>
    <!-- /.login-box -->
</div>
@endsection
