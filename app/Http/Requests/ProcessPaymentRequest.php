<?php

namespace App\Http\Requests;

use App\Models\OrderHeader;
use Illuminate\Foundation\Http\FormRequest;

class ProcessPaymentRequest extends FormRequest
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
        $rules = OrderHeader::$rules;
        $rules['first_name'] = 'required';
        $rules['last_name'] = 'required';
        $rules['phone_number'] = 'required|regex:/^([0-9\s\-\+\(\)]*)$/';
        $rules['email'] = 'required|string|email|regex:/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/|max:255';
        $rules['state_id'] = 'required';
        $rules['location_id'] = 'required';
        $rules['postal_code'] = 'required';
        $rules['tc_checkbox'] = 'required';


        return $rules;
    }
}
