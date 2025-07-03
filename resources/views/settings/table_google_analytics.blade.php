@php
    $dataTable = app(\App\DataTables\SettingDataTable::class);
    $dataTable->setFilterKey('google_analytics');
@endphp

{!! $dataTable->render($entity['view'] . '.table_wrapper', ['entity' => $entity]) !!}
