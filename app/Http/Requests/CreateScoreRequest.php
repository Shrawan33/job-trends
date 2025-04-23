<?php

namespace App\Http\Requests;

use App\Models\ScoreBoard;
use Illuminate\Foundation\Http\FormRequest;

class CreateScoreRequest extends FormRequest
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
        $rules = ScoreBoard::$rules;

        $rules['score.*.level'] = 'required';
        // dd($rules);
        return $rules;
    }


    public function messages()
    {
        $messages = ScoreBoard::$messages;
        $messages['score.*.level.required'] = 'This field is required.';

        return $messages;
    }
}
