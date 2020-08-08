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
            'genres' => 'required',
            'platforms' => 'required',
            'description' => 'required',
            'game_modes' => 'required',
            'released' => 'required',
            'rating' => 'required',
            'game_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5120'
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'The Name field cannot be empty',
            'name.genres' => 'The Genre field cannot be empty',
            'name.platforms' => 'The Platform field cannot be empty',
            'description.required' => 'The Description field cannot be empty',
            'game_modes.required' => 'Game Mode cannot be empty',
            'released.required' => 'The Released field cannot be empty',
            'rating.required' => 'The Rating field cannot be empty',
            'game_image.image' => 'Invalid image type',
            'game_image.max' => 'Image size cannot be larger than 5 MB',

        ];
    }
}
