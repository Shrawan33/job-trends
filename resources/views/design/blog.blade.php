@extends('layouts.front')


@section('content')
<section class="bg-dark py-5">

<div class="container">
    <div class="row my-5">
        <div class="col-12">
            <h1 class="font-weight-bold mb-0 display-4">
               Blog</h1>
        </div>
    </div>
</div>
</section>
<section class="my-5">
<div class="container">
    <div class="row">
    @include('design.blog-card')
    @include('design.blog-card')
    @include('design.blog-card')
    @include('design.blog-card')
    @include('design.blog-card')
    @include('design.blog-card')
    @include('design.blog-card')
    @include('design.blog-card')
    @include('design.blog-card')
    @include('design.blog-card')
    
    </div>
</div>
</section>
@endsection