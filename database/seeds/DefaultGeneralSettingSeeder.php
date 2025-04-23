<?php

use App\Models\Configuration;
use Illuminate\Database\Seeder;

class DefaultGeneralSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $setting_fields = [
            'general' => [
                // ['field' => 'profit_margin', 'value' => null],
                // ['field' => 'labour_cost_above_300_kg', 'value' => null],
                // ['field' => 'custom', 'value' => null],
                // ['field' => 'document_fees', 'value' => null],
                // ['field' => 'road_document_fees', 'value' => null],
                // ['field' => 'other_charge', 'value' => null]
            ],
            'contact' => [
                ['field' => 'tag_line', 'value' => "We would love to hear from you. Please write to us, and we'll get back to you real soon!"],
                ['field' => 'email', 'value' => null],
                ['field' => 'phone', 'value' => null],
                ['field' => 'location', 'value' => null]
            ]
        ];
        foreach ($setting_fields as $type => $settings) {
            foreach ($settings as $setting) {
                $search = ['setting_type' => $type, 'setting_field' => $setting['field'], 'setting_value' => null];
                $data = $search + ['setting_value' => $setting['value']];
                Configuration::firstOrCreate($search, $data);
            }
        }
    }
}
