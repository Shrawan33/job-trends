<?php

namespace App\Http\Requests;

use App\Models\ApplyJob;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class CreateApplyJobRequest extends FormRequest
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
        $rules = ApplyJob::$rules;

        $rules['questionnaire.*.answer'] = 'required_with:questionnaire.*.questionnaire_id';

        return $rules;
    }

    public function messages()
    {
        $messages = ApplyJob::$messages;
        $messages['questionnaire.*.answer.required_with'] = 'Answer is required.';

        return $messages;
    }
}
