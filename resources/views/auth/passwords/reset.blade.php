@extends('layouts.front')

@section('content')
    <div class="container mt-50 my-lg-120">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-6 ">
                <div class="login-form p-4 rounded">
                    <h2 class="mt-3 pb-4 font-weight-bold h3">{{ trans('label.reset_pass') }} </h2>
                    <p>{{ trans('label.recover_password') }}</p>
                    <form action="{{ route('password.update') }}" method="POST">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group mb-4">
                            <input type="email" name="email" value="{{ $email ?? old('email') }}"
                                class="form-control @error('email') is-invalid @enderror"
                                placeholder="{{ trans('label.email') }}">
                            @error('email')
                                <span class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group mb-4">
                            <input type="password" name="password"
                                class="form-control @error('password') is-invalid @enderror"
                                placeholder="{{ trans('label.password') }}">
                            @error('password')
                                <span class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group  mb-4">
                            <input type="password" name="password_confirmation" class="form-control"
                                placeholder="{{ trans('label.confirm_password') }}">
                        </div>
                        <div class="row mt-4">
                            <div class="col-12">
                                <button type="submit"
                                    class="mx-auto btn btn-primary mt-3">{{ trans('label.reset_password') }}</button>
                            </div>
                            <!-- /.col -->
                        </div>




                    </form>
                </div>
            </div>
        </div>
    @endsection
