@extends('layouts.front')

@section('content')
<div class="">
    @include('flash::message')
    <div id="cart_list">
        @include($entity['view'].'.cart_list')
    </div>
</div>
@endsection
