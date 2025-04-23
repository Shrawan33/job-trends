@extends('layouts.admin')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>{!!$entity['singular']!!}</h1>
                </div>
            </div>
        </div>
    </section>
    <div class="content px-3">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    @include($entity['view'].'.show_fields')
                </div>
            </div>
            <div class="card-footer">
                <div class="d-flex justify-content-between align-items-center">
                    @include('components.edit_link', ['text' => '<i class="fa fa-edit"></i> Edit'])
                    @include('components.detail-buttons')
                </div>
            </div>

        </div>

    </div>
@endsection
