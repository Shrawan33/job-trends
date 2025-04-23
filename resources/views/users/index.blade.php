@extends('layouts.admin')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <h1>{!! __('label.users') !!}</h1>
                </div>
                <div class="col-md-6 text-right">
                    @include('components.add_ajax_link', ['class' => 'btn btn-primary float-right', 'entity' => $entity, 'text' => trans('label.add_new')])
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
