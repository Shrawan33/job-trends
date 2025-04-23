@extends('layouts.admin')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                @include('adminlte-templates::common.errors')
                <div class="col-sm-12">
                    <h1>{{trans('label.account_dashboard')}}</h1>
                </div>
            </div>
        </div>
    </section>
    <div class="content px-3">
        <div class="card card-tabs">
            <div class="card-header p-0 pt-1">
                <ul class="nav nav-line-tabs">

                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="pill" href="#tab_see_users" role="tab">{{trans('label.see_users')}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="pill" href="#tab_see_employers" role="tab">{{trans('label.see_employers')}}</a>
                    </li>
                </ul>
            </div>

            <div class="card-body">
                <div class="tab-content">
                    <div id="tab_see_users" class="tab-pane fade in active show">
                        @include('candidates.partial_index', ['entity' => FunctionHelper::getEntity('candidates'), 'input' => $input])


                    </div>

                    <div id="tab_see_employers" class="tab-pane fade in">
                        {!! $seeEmployers !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('page_scripts')
@include('candidates.script',['entity' => FunctionHelper::getEntity('candidates')])
@endpush

