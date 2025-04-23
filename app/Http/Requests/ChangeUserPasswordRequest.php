<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangeUserPasswordRequest extends FormRequest
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
            'old_password' => 'required',
            // 'password' => 'required|confirmed'
            'password' => ['required', 'string', 'min:8', 'regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/', 'confirmed'],

        ];

        return $rules;
    }

    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        $messages = [
            'old_password.required' => 'Current password field is required.',
            'password.required' => 'New password field is required.',
            'password.confirmed' => 'New password & Re-entered password does not match.'
        ];

        return $messages;
    }
}
