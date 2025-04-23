@extends('layouts.front')

@if (request()->ajax() == false)
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
@endif

@section('content')
<div class="container my-5">
    <div class="job_top_banner bg_frame position-relative">
        <img src="../public/images/about_banner.png" alt="fea_img" width="100%" class="inner_banner">
        <h1 class="my-4 text-center position-relative text-secondary">{{$work_with_us->title??''}}</h1>
    </div>
    <div class="content_pages">
        <p id="terms">{!!$work_with_us->description??''!!}</p>
    </div>
</div>
@endsection
