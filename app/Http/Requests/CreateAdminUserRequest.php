<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class CreateAdminUserRequest extends FormRequest
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
        $rules = User::$rules;
    
        unset($rules['tc_checkbox']);
        $rules['role'] = 'required';
        unset($rules['g-recaptcha-response']);
    
        if ($this->role == 'jobseeker') {
            $rules['first_name'] = 'required|string|max:255';
            $rules['last_name'] = 'required|string|max:255';
        } elseif ($this->role == 'employer') {
            $rules['company_name'] = 'required';
        }
        $rules['password'] = 'nullable|min:8';
    
        return $rules;
    }
    
}
