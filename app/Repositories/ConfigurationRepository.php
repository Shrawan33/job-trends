<?php

namespace App\Repositories;

use App\Models\Configuration;

/**
 * Class ConfigurationRepository
 * @package App\Repositories
 * @version May 22, 2020, 5:57 am UTC
 */

class ConfigurationRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'setting_type',
        'setting_field',
        'setting_value'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Configuration::class;
    }

    /**
     * sync function
     *
     * @param array $input
     * @param object $data
     * @return void
     */
    public function sync(array $input = [], $dbData)
    {
        $data = [];
        foreach ($input as $type => $settings) {
            if ($type != 'sea_freight') {
                $data = $this->updateData($settings, $data, $dbData, $type);
            } else {
                foreach ($settings as $subType => $fields) {
                    $data = $this->updateData($fields, $data, $dbData, $type, $subType);
                }
            }
        }

        // To insert new data
        if (!empty($data)) {
            $this->model->insert($data);
        }

        $this->model::setSessionConfiguration(['general', 'contact']);
    }

    public function updateData($settings, $data, $dbData, $type, $subType = null)
    {
        foreach ($settings as $field => $value) {
            $existingData = $dbData;
            $search = ['setting_type' => $type, 'setting_field' => $field];
            if (!empty($subType)) {
                $search = array_merge($search, ['setting_sub_type' => $subType]);
            }

            if ($existingData->count() > 0) {
                foreach ($search as $key => $item) {
                    $existingData = $existingData->where($key, $item);
                }
                $dbval = $existingData->first();
                // dd($search, $dbval);
                if (!empty($dbval)) {
                    $dbval->setting_value = $value;
                    $dbval->save();
                } else {
                    $input_data = array_merge($search, ['setting_value' => $value]);
                    array_push($data, $input_data);
                }
            } else {
                $input_data = array_merge($search, ['setting_value' => $value]);
                array_push($data, $input_data);
            }
        }

        // To delete removed configured key
        $search = ['setting_type' => $type];
        if (!empty($subType)) {
            $search = array_merge($search, ['setting_sub_type' => $subType]);
            $setting_fields = array_keys(config("constants.default_configuration_model.$type.$subType.label", []));
        } else {
            $setting_fields = array_keys(config("constants.default_configuration_model.$type.label", []));
        }

        if (!empty($setting_fields)) {
            $existingData = $dbData;
            foreach ($search as $key => $item) {
                $existingData = $existingData->where($key, $item);
            }

            $tobeRemoved = $existingData->whereNotIn('setting_field', $setting_fields);
            if ($tobeRemoved->count() > 0) {
                foreach ($tobeRemoved as $record) {
                    $record->delete();
                }
            }
        }
        return $data;
    }

    public function updateOrCreateGeneratedNumbers($generatedNumbers)
    {
        foreach ($generatedNumbers as $input) {
            if (!empty($input['setting_value'])) {
                $this->model->updateOrCreate([
                    'setting_field' => $input['setting_field']
                ], $input);
            } else {
                $this->model->whereSettingField($input['setting_field'])->delete();
            }
        }

        return true;
    }

    public function getPatternPreview($pattern, $configNumberPatternName, $clientIdNumber = null)
    {
        $configuration = (object) ['setting_type' => 'pattern', 'setting_value' => $pattern, 'setting_field' => $configNumberPatternName];

        return $this->getNumberField($configuration, $clientIdNumber);
    }

    // public function updateOrCreateGeneralSettings($generatedNumbers)
    // {
    //     foreach ($generatedNumbers as $settingField => $input) {
    //         if (!empty($input['setting_value'])) {
    //             $this->model->updateOrCreate([
    //                 'setting_field' => $settingField,
    //                 'setting_type' => config('constants.configuration_setting_type.3', 'general')
    //             ], $input);
    //         } else {
    //             $this->model->whereSettingFieldAndSettingType($settingField, config('constants.configuration_setting_type.3', 'general'))->delete();
    //         }
    //     }

    //     return true;
    // }
}
