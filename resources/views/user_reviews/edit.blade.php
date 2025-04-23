@section('third_party_stylesheets')
    @include('vendor.image_upload.style')
    @include('vendor.richtexteditor.style')
@endsection
@extends('layouts.ajax')
@section('content')
{{-- @dd($entity) --}}

    {!! Form::model($review, [
        'route' => [$entity['url'] . '.update', $review->id],
        'method' => 'patch',
        'id' => 'frm_' . $entity['targetModel'],

    ]) !!}
    @include($entity['view'] . '.edit_advance_fields')
    {!! Form::close() !!}
@endsection
@push('page_scripts')
    @include('imagecropper.croppermodal')
    @section('third_party_scripts')
        @include('vendor.richtexteditor.script')
        @include('vendor.image_upload.script')
        @include('vendor.dropzone.script')
    @endsection
@endpush


<script>


function reloadData(route) {
        setTimeout(function() {
            // After 5 seconds, reload the page
            location.reload();
        }, 1000); // 5000 milliseconds = 5 seconds
    }
     $('.badge-tab').on('click', function() {
            var tabId = this.id;
            var tabValue = $(this).data("badge-value");
            $('#badge_id').val(tabValue);
        });


</script>




