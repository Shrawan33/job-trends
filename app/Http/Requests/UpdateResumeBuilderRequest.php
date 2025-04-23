<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\JobSeekerDetail;


class UpdateResumeBuilderRequest extends FormRequest
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
        $step = $this->get('step');

        switch ($step) {
            case 1:
                return $this->step1Rules();
            case 2:
                return $this->step2Rules();
            case 3:
                return $this->step3Rules();
            case 4:
                return $this->step4Rules();

            default:
                return [];
        }
    }

    protected function step1Rules()
    {
        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'location_id' => 'required',
            'state_id' => 'required',
            'country_id' => 'required',
            'phone' => 'required',
            'who_are_you' => 'required',
            // 'i_am_a' => 'required',
        ];
    }

    protected function step2Rules()
    {
        return [
            'i_am_a' => 'required',
            // 'skill_id' => 'required',
            'searching_for' => 'required',
            'company.*' => 'required',

            // Add rules for step 2...
        ];
    }

    protected function step3Rules()
    {
        return [
            'user_id' => 'required',
            'reference_name.*' => 'required',
            'company.*' => 'required',
            'role.*' => 'required',
        ];
    }

    protected function step4Rules()
    {
        return [

        ];
    }
}
