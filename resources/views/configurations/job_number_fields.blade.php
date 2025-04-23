@php
    $numberFields = [];

    $settingField = 'job_number';

    $lableName = 'Job No';

    if(isset($configurations) && $configurations->count() > 0) {
        $numberFields = $configurations->where('setting_field', $settingField)->first();
    }
@endphp
@include('configurations.number_fields', ['numberFields' => $numberFields, 'index' => 3, 'settingField' => $settingField, 'lableName' => $lableName])
