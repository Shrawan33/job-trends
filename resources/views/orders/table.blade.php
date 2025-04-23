@section('third_party_stylesheets')
    @include('layouts.datatables_css')
@endsection
@includeFirst(
    ['orders.search', 'components.search'],
    [
        'form_id' => isset($entity['targetModel']) ? "search-{$entity['targetModel']}" : 'search-form',
        'id' => isset($entity['targetModel']) ? "{$entity['targetModel']}-datatable" : 'dataTableBuilder',
    ]
)

{!! $dataTable->table(['width' => '100%', 'class' => 'table table-striped table-bordered', 'id' => isset($entity['targetModel']) ? "{$entity['targetModel']}-datatable" : 'dataTableBuilder']) !!}

@section('third_party_scripts')

    @include('layouts.datatables_js')

    {!! $dataTable->scripts() !!}

    @include('vendor.datatables.submit-search', [
        'id' => isset($entity['targetModel']) ? "{$entity['targetModel']}-datatable" : 'dataTableBuilder',
        'form_id' => isset($entity['targetModel']) ? "search-{$entity['targetModel']}" : 'search-form',
    ])

@endsection
