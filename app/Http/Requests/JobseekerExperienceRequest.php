<?php

namespace App\Http\Requests;

use App\Models\JobSeekerExperience;
use Illuminate\Foundation\Http\FormRequest;

class JobseekerExperienceRequest extends FormRequest
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
            'user_id' => 'required',
            'reference_name.*' => 'required',
            'company.*' => 'required',
            'role.*' => 'required',
        ];
}

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return JobSeekerExperience::$messages;
    }
}
