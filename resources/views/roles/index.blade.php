@extends('layouts.admin')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <h1>{!! __('label.roles') !!}</h1>
                </div>
                <div class="col-md-6 text-right">
                    <a class="btn btn-primary" href="{{ route($entity['url'].'.create') }}">{!! __('label.add_new') !!}</a>
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
                @includeFirst([$entity['view'].'.table', 'components.table'])
            </div>
        </div>
    </div>
@endsection

