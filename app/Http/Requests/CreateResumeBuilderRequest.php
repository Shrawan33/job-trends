<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\JobSeekerDetail;


class CreateResumeBuilderRequest extends FormRequest
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
         $rules = [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'location_id' => 'required',
            'state_id' => 'required',
            'country_id' => 'required',
            'phone' => 'required'

            // 'i_am_a' => 'required',
        ];
        return $rules;
    }
}
