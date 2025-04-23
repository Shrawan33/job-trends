@push('page_css')
    @include('layouts.datatables_css')
@endpush
{{-- {{'assign_board.'.$entity['targetModel'].'.search'}} --}}
@includeFirst(
    ['account_dashboard.'.$entity['targetModel'].'.search', 'components.admin.search'],
    ['form_id' => isset($entity['targetModel']) ? "search-{$entity['targetModel']}" : 'search-form']
)
{{-- <div class="my-2"><label for=""><input type="checkbox"><span class="ml-2">Best Match</span></label></div> --}}
{!! $dataTable->table(['width' => '100%', 'class' => 'table theme-table', 'id' => isset($entity['targetModel']) ? "{$entity['targetModel']}-datatable" : 'dataTableBuilder']) !!}

@push('page_scripts')
    @include('layouts.datatables_js')
    {!! $dataTable->scripts() !!}
    @include('vendor.datatables.search', [
        'id' => isset($entity['targetModel']) ? "{$entity['targetModel']}-datatable" : 'dataTableBuilder',
        'form_id' => isset($entity['targetModel']) ? "search-{$entity['targetModel']}" : 'search-form',
    ])
@endpush
