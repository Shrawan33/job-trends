<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\EmployerJob;

class CreateJobPostRequest extends FormRequest
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
        $rules = EmployerJob::$rules;
        unset($rules['tc_checkbox']);
        return $rules;
    }

    public function messages()
    {
        return EmployerJob::$messages;
    }
}
