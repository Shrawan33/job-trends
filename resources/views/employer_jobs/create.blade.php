@extends('layouts.front')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12 mt-5 p-0">
            <div class="job_top_banner bg_frame position-relative">
                <img src="{{ asset('images/inner_banner.png') }}" alt="fea_img" width="100%" class="inner_banner">
                <div class="d-flex align-items-center justify-content-between position-relative p-lg-3">
                    <h1 class="">{!!
                        __('label.add_job') !!}</h1>
                </div>
            </div>
        </div>
    </div>

    {!! Form::open(['route' => $entity['url'].'.store', 'id' => 'frm_'.$entity['targetModel']]) !!}
    @include($entity['view'].'.fields')

    {{-- <div class="row">
        <div class="col-12 text-center my-5">
            @include('components.form-buttons')
        </div>
    </div> --}}
    {!! Form::close() !!}

</div>

@endsection
