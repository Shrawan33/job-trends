<?php

namespace App\Http\Requests;

use App\Models\User;
use App\Rules\ValidateRecaptcha;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class CreateOfferUserRequest extends FormRequest
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
        $rules = [];
        $rules['first_name'] = 'required|string|max:255|filled';

        $rules['last_name'] = 'required|string|max:255';
        $rules['phone_number'] = ['required', 'regex:/^([0-9\s\-\+\(\)]*)$/', 'unique:users,phone_number,NULL,id,deleted_at,NULL'];
        $rules['email'] = ['required', 'string', 'email', 'regex:/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/', 'max:255', 'unique:users,email,NULL,id,deleted_at,NULL'];
        $rules['password'] = ['required', 'string', 'min:8', 'regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/', 'confirmed'];

        $rules['document'] = 'required';
        $rules['instruction_cv_writing'] = 'required';
        $rules['g-recaptcha-response'] = ['required', new ValidateRecaptcha()];

        return $rules;
    }



    public function messages()
    {
        return [
            'g-recaptcha-response.required' => 'Please ensure that you are a human!'
        ];
    }
}
