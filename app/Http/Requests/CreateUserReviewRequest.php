<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\UserReview;

class CreateUserReviewRequest extends FormRequest
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
        $activeTab = $this->input('active_tab');
        //dd($activeTab);
        $validationRules = [
            'active_tab' => 'required', // Ensure the active_tab value is present
        ];

        if ($activeTab === 'basic-tab') {
            $validationRules['basic_review'] = 'required'; // Validation rule for tab 1 review
        } elseif ($activeTab === 'advance-tab') {
            $validationRules['advance_review'] = 'required'; // Validation rule for tab 2 review
            $validationRules['weeknesses'] = 'required|array'; // Validation rule for tab 2 review
            $validationRules['responsibilities'] = 'required|array';
        }

        return $validationRules;
    }
}
