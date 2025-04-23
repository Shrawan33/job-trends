<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class UpdateAdminUserRequest extends FormRequest
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
        $id = $this->route('user');
        $rules = User::$rules;

        unset($rules['tc_checkbox']);

        $rules['email'] = 'required|email|unique:users,email,' . $id;
        // $rules['phone_number'] = 'required|phone_number|unique:users,phone_number,' . $id;
        $rules['phone_number'] = ['required', 'regex:/^([0-9\s\-\+\(\)]*)$/', 'unique:users,phone_number,' . $id . ',id,deleted_at,NULL'];
        $rules['password'] = 'confirmed';
        return $rules;
    }
}
