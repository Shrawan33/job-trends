<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\JobSeekerDetail;

class UpdateJobSeekerDetailRequest extends FormRequest
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
        $rules = JobSeekerDetail::$rules;

        // required for intro section
        if (request()->get('form_title') == 'intro') {
            $rules['location_id'] = 'required';
            $rules['first_name'] = 'required';
            $rules['last_name'] = 'required';
            $rules['gender'] = 'required';
            $rules['country_id'] = 'required';
            $rules['state_id'] = 'required';
            $rules['title'] = 'required';
            // $rules['description'] = 'required';
            $rules['professional_manner'] = 'required';


        }

        return $rules;
    }

    public function messages()
    {
        $messages = JobSeekerDetail::$messages;

        return $messages;
    }
}
