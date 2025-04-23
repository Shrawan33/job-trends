<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Role;

class CreateRoleRequest extends FormRequest
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
        $roles = Role::$rules;
        $platform = request()->get('guard_name', null);
        $rules['name'] = 'required|unique:roles,name,NULL,id,deleted_at,NULL,guard_name,'.$platform;
        return $roles;
    }

    public function messages()
    {
        $messages = Role::$messages;
        $messages['name.unique'] = Role::getMessages('name.unique', request()->only(['name', 'title', 'guard_name']));
        return $messages;
    }
}
