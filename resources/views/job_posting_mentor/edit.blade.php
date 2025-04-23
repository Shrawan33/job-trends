@extends('layouts.admin')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>{!! trans('label.edit') !!} {!! __('label.job_posting') !!}</h1>
                </div>
            </div>
        </div>
    </section>
    <div class="content px-3">
        @include('adminlte-templates::common.errors')
        <div class="card">
            {!! Form::model($employerJob, ['route' => [$entity['url'].'.update', $employerJob->id], 'method' => 'patch', 'id' => 'frm_'.$entity['targetModel']]) !!}
            <div class="card-body">
                @include('job_posting_mentor.fields')
            </div>
            <div class="card-footer text-right">
                {{-- @include('components.form-buttons') --}}
                <!-- Submit Field -->
                <a href="{{ route($entity['url'].'.index') }}" class="btn btn-default">{!! __('label.cancel') !!}</a>
                {!! Form::submit(__('Save and Approve'), ['class' => 'btn btn-primary ml-3']) !!}
            </div>
            {!! Form::close() !!}
        </div>

    </div>
@endsection
