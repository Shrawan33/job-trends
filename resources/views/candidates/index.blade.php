@extends('layouts.front')

@section('content')


<div class="container">
<h1 class="inner_page_heading">{{trans('label.search_jobseeker_candidates')}}</h1>
@include('candidates.partial_index')
</div>
@endsection

@push('page_scripts')
@include('candidates.script')
@endpush
