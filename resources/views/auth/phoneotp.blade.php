@extends('layouts.front')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6 ">
            <div class="login-form p-4 rounded">
                <h3 class="mt-2 pb-3 font-weight-bold">{{trans('label.phone_verification')}}</h3>
                <p class="mb-4">{{trans('label.verification_code')}}</p>
                <h6 class="mb-3">{{trans('label.phone_code_text')}}</h6>
                <ul class="list-inline">
                      <li class="list-inline-item border px-3 py-2 text-dark">1</li>
                      <li class="list-inline-item border px-3 py-2 text-dark">2</li>
                      <li class="list-inline-item border px-3 py-2 text-dark">3</li>
                      <li class="list-inline-item border px-3 py-2 text-dark">4</li>
                      <li class="list-inline-item border px-3 py-2 text-dark">5</li>
                      <li class="list-inline-item border px-3 py-2 text-dark">6</li>
                </ul>
                <a href="" class="btn btn-primary font-wight-bold rounded-pill mt-3 rounded-pill mt-3 px-5">{{trans('label.login_btn')}}</a>
            </div>
        </div>
    </div>
</div>
@endsection
