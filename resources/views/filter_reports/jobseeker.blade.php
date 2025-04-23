@extends('layouts.admin')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <h1>{!! __('label.jobseeker_reports') !!}</h1>
                </div>
                <div class="col-md-6 text-right">

                </div>
            </div>
        </div>
    </section>
    <div class="content px-3">

        <div class="clearfix"></div>
        @include('flash::message')
        <div class="clearfix"></div>

        <div class="card">
            <div class="card-body">

                @includeFirst([$entity['view'].'.table', 'components.admin.table'])
            </div>
        </div>
    </div>
@endsection
