@extends('layouts.front')

@section('content')


<div class="container">
<h1 class="inner_page_heading">{{ trans('label.search_employers') }}</h1>
@include('employers.partial_index')
</div>
@endsection

@push('page_scripts')
@include('employers.script')
@endpush
