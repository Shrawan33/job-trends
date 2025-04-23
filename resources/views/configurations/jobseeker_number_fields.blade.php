@php
    $numberFields = [];

    $settingField = 'jobseeker_number';

    $lableName = 'Jobseeker No';

    if(isset($configurations) && $configurations->count() > 0) {
        $numberFields = $configurations->where('setting_field', $settingField)->first();
    }
@endphp
@include('configurations.number_fields', ['numberFields' => $numberFields, 'index' => 2, 'settingField' => $settingField, 'lableName' => $lableName])
