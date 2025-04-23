<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Role;

class UpdateRoleRequest extends FormRequest
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
        $rules = Role::$rules;
        $platform = request()->get('guard_name', null);
        $id = $this->route('role');
        $rules['name'] = 'required|unique:roles,name,' . $id . ',id,deleted_at,NULL,guard_name,' . $platform;
        return $rules;
    }

    public function messages()
    {
        $messages = Role::$messages;
        $messages['name.unique'] = Role::getMessages('name.unique', request()->only(['name', 'title', 'guard_name']));
        return $messages;
    }
}
