<?php

namespace App\Http\Requests;

use App\Models\User;
use App\Rules\ValidateRecaptcha;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class CreateUserRequest extends FormRequest
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

        if (!empty(auth()->user()) && auth()->user()->hasRole('admin')) {
            unset($rules['tc_checkbox']);
        }

        if ($this->user_type == 'Jobseeker') {
            $rules['first_name'] = 'required|string|max:255|filled';
            $rules['last_name'] = 'required|string|max:255';
        } else {
            $rules['company_name'] = 'required';
        }

        $rules['g-recaptcha-response'] = ['required', new ValidateRecaptcha()];

        if (request()->get('provider', null) != null) {
            unset($rules['password']);
        }

        // dd($rules);

        return $rules;
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->formatPhoneNumber();
    }

    protected function formatPhoneNumber()
    {
        if ($this->request->has('phone_number')) {
            $this->merge([
                'phone_number' => Str::formatePhoneNumber($this->request->get('phone_number'))
            ]);
        }
    }

    public function messages()
    {
        return [
            'g-recaptcha-response.required' => 'Please ensure that you are a human!'
        ];
    }
}
