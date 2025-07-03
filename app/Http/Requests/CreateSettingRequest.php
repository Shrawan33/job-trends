<?php

namespace App\Http\Requests;

use App\Models\Setting;
use Illuminate\Foundation\Http\FormRequest;

class CreateSettingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'key' => 'required|string',
            'page' => 'required_if:key,seo_setting|string|nullable',
            'meta_title' => 'nullable|string',
            'meta_description' => 'nullable|string',
            'google_analytics_head' => 'nullable|string',
            'google_analytics_body' => 'nullable|string',
            'google_analytics_footer' => 'nullable|string',
        ];
    }
}
