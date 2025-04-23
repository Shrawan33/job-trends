@php
    $numberFields = [];

    $settingField = 'employer_number';

    $lableName = 'Employer No';

    if(isset($configurations) && $configurations->count() > 0) {
        $numberFields = $configurations->where('setting_field', $settingField)->first();
    }
@endphp
@include('configurations.number_fields', ['numberFields' => $numberFields, 'index' => 1, 'settingField' => $settingField, 'lableName' => $lableName])
