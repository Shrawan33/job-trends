<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\UserReview;

class UpdateUserReviewRequest extends FormRequest
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
        $validationRules['advance_review'] = 'required'; // Validation rule for tab 2 review
        $validationRules['responsibilities'] = 'required|array';
        $validationRules['weeknesses'] = 'required|array'; // Validation rule for tab 2 review

        return $validationRules;
    }
    public function messages()
    {
        return [
            'advance_review.required' => 'The advance review field is required.',
            'responsibilities.required' => 'The responsibilities field is required.',
            'weeknesses.required' => 'The weaknesses field is required.',
        ];
    }
}
