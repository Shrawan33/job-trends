<div class="table-responsive">
    {!! $dataTable->table(['class' => 'table table-bordered table-striped'], true) !!}
</div>

@push('scripts')
    {!! $dataTable->scripts() !!}
@endpush
