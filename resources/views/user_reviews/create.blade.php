@section('third_party_stylesheets')
    @include('vendor.image_upload.style')
    @include('vendor.richtexteditor.style')
@endsection
@extends('layouts.ajax')
{{-- @dd($entity) --}}
@section('content')
    {!! Form::open(['route' => [$entity['url'] . '.store'], 'id' => 'frm_' . $entity['targetModel']]) !!}
    @include($entity['view'] . '.fields')
    {!! Form::close() !!}
@endsection

@push('page_scripts')

<script>
    $(document).ready(function() {
        function hideSaveButton() {
            $('#save_button').hide();
        }

        function showSaveButton() {
            $('#save_button').show();
        }

        var basicReviewCount = {!! $review_count['basic_review_count'] !!};
        var advanceReviewCount = {!! $review_count['advance_review_count'] !!};
        var userRoles = {!! json_encode(auth()->user()->roles->pluck('name')) !!};

        console.log('Basic Review Count:', basicReviewCount);
        console.log('Advance Review Count:', advanceReviewCount);

        $('.nav-link.review-type-tab').on('click', function(e) {
            e.preventDefault();
            var tabId = $(this).attr('id');
            $('#active_tab').val(tabId);
            $('#review_type').val(tabId === 'basic-tab' ? 1 : 2);

            if (tabId === 'basic-tab') {
                if (basicReviewCount === 1) {
                    hideSaveButton();
                } else {
                    showSaveButton();
                }
            } else if (tabId === 'advance-tab') {
                if (advanceReviewCount === 1 || userRoles.includes('employer')) {
                    hideSaveButton();
                } else {
                    showSaveButton();
                }
            } else if(userRoles.includes('employer'))
            {
                console.log('employer')
                hideSaveButton();

            }
        });

        var activeTabId = $('.nav-link.review-type-tab.active').attr('id');
        if (activeTabId === 'basic-tab' && basicReviewCount === 1) {
            hideSaveButton();
        } else if (activeTabId === 'advance-tab' && advanceReviewCount === 1) {
            hideSaveButton();
        }

        $('.badge-tab').on('click', function() {
            var tabId = this.id;
            var tabValue = $(this).data("badge-value");
            $('#badge_id').val(tabValue);
        });
        $('.badge-tab:first').click();
    });
</script>
    @include('imagecropper.croppermodal')
    @section('third_party_scripts')
        @include('vendor.richtexteditor.script')
        @include('vendor.image_upload.script')
        @include('vendor.dropzone.script')
    @endsection
@endpush
