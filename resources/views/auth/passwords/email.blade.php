@extends('layouts.front')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6 ">
            <div class="login-form p-4 pb-5 rounded">
            <h2 class="mt-3 pb-4 font-weight-bold">{{trans('label.forgot_your')}}</h2>
            <p>{{trans('label.reset_link')}}</p>
            @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                    @endif
                    <form action="{{ route('password.email') }}" method="post">
                        @csrf

                        <div class="form-group my-4">
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                placeholder="{{trans('label.your_email')}}">
                                @error('email')
                            <span class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>


                        <div class="row">
                            <div class="col-12">
                                <button type="submit" class="btn btn-secondary font-weight-bold rounded-pill px-5 text-white">Submit</button>
                            </div>
                            <!-- /.col -->
                        </div>
                    </form>

            </div>
        </div>
    </div>
    </div>
    @endsection
