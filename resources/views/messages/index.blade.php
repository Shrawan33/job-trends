@extends('layouts.front')

@section('content')
@role('employer')
    <div class="container">
        <h1 class="inner_page_heading">{!! __('label.messages') !!}</h1>
        <div class="row mb-5 mx-0">
            <div class="col-12">
                <div class="col text-right">
                    @if(isset(auth()->user()->isAssignedByAccount) && $layout == "front")

                    @include('components.send_message', [
                    'model' => auth()->user()->isAssignedByAccount->accountManager??null,
                    'type' => 'link',
                    'text' => trans('label.contact_account'),
                    'to' => auth()->user()->isAssignedByAccount->accountManager->full_name??null,
                    'class_sendmail_btn' => 'btn btn-primary mb-3'
                    ])
                    @endif
                </div>


            </div>
            <div class="clearfix"></div>
            @include('flash::message')
            <div class="clearfix"></div>

            <div class="col-12 table_box">
                @includeFirst([$entity['view'].'.table', 'components.table'])
            </div>
        </div>

    </div>
@endrole
@role('jobseeker')
<div class="container">
    <h1 class="inner_page_heading">{!! __('label.messages') !!}</h1>
    <div class="row mb-5 jobseeker_dashboard">
        <div class="col-12">
            <div class="col text-right">
                @if(isset(auth()->user()->isAssignedByAccount) && $layout == "front")
                    @include('components.send_message', [
                        'model' => auth()->user()->isAssignedByAccount->accountManager??null,
                        'type' => 'link',
                        'text' => trans('label.contact_account'),
                        'to' => auth()->user()->isAssignedByAccount->accountManager->full_name??null,
                        'class_sendmail_btn' => 'btn btn-primary mb-3'
                    ])
                @endif
            </div>
        </div>
        @include('auth.job_seeker.profile.layout')
        <div class="col-md-8 col-lg-9 p-md-0">
            <div class="table_box">
                @include('flash::message')
                @includeFirst([$entity['view'].'.table', 'components.table'])
            </div>
        </div>
    </div>

</div>
@endrole
@endsection
@push('page_scripts')
<script>
    $('#globalModal').on('shown.bs.modal', function (e) {
        $("#message_box").animate({ scrollTop: $('#message_box').prop("scrollHeight")}, 500);
        $(".modal-body").animate({ scrollTop: $('.modal-body').prop("scrollHeight")}, 500);
    });
</script>
@endpush
