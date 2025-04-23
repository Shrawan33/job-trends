@extends('layouts.front')

@section('content')
<div class="container">
    <div class="row my-50">
        @include($entity['view'].'.show_fields')
    </div>
</div>
{{-- @include('components.detail-buttons') --}}
@endsection
