@extends('layouts.admin')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>{!! trans('label.edit') !!} {!!$entity['singular']!!}</h1>
                </div>
            </div>
        </div>
    </section>
    <div class="content px-3">
        @include('adminlte-templates::common.errors')
        <div class="card">
            {!! Form::model($event, ['route' => [$entity['url'].'.update', $event->id], 'method' => 'patch', 'id' => 'frm_'.$entity['targetModel']]) !!}
            <div class="card-body">
                @include($entity['view'].'.fields')
            </div>
            <div class="card-footer text-right">
                @include('components.form-buttons')
            </div>
            {!! Form::close() !!}
        </div>

    </div>
@endsection
