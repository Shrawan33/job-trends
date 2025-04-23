<?php

namespace App\Http\Requests;

use App\Rules\ValidateRecaptcha;
use Illuminate\Foundation\Http\FormRequest;

class VerifyEmailPhoneRequest extends FormRequest
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
            'verification_code' => 'required',
            'token' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'verification_code.required' => 'Please provide verification codes',
            'token.required' => 'Please provide valid data',
        ];
    }
}
