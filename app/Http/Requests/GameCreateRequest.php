<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GameCreateRequest extends FormRequest
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
        return [
            'name' => 'required',
            'description' => 'required',
            'game_mode' => 'required',
            'released' => 'required',
            'rating' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'The Name field cannot be empty',
            'description.required' => 'The Description field cannot be empty',
            'game_mode.required' => 'The Game Mode field cannot be empty',
            'released.required' => 'The Released field cannot be empty',
            'rating.required' => 'The Rating field cannot be empty',

        ];
    }
}
