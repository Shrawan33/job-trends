@extends('layouts.front')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-40">
        <h1 class="inner_page_heading m-0">{{trans('label.job_alerts')}}</h1>
        <a class="open-form btn btn-primary" href="javascript:void(0)" data-mode="create" data-modal-size="modal-lg"
        data-title="{{trans('label.add_alert')}}" data-model="{{$entity['targetModel']}}" data-url="{{ route($entity['url'].'.create') }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                <path d="M7.99998 1.58331V14.4166M1.58331 7.99998H14.4166" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>
            {{trans('label.add_alert')}}
        </a>
    </div>
    <div class="row mb-50 jobseeker_dashboard">
        @include('auth.job_seeker.profile.layout')
        <div class="col-md-8 col-lg-9 table_box">
        @includeFirst([$entity['view'].'.table', 'components.table'])
        </div>
    </div>
</div>
@endsection
