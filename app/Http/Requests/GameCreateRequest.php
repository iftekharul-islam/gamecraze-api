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
            'released' => 'required',
            'publisher' => 'required',
            'developer' => 'required',
            'rating' => 'required',
            'trending_url' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'cover_url' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'poster_url' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'game_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5120',
            'image_source' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'The Name field cannot be empty',
            'name.genres' => 'The Genre field cannot be empty',
            'name.platforms' => 'The Platform field cannot be empty',
            'released.required' => 'The Released field cannot be empty',
            'rating.required' => 'The Rating field cannot be empty',
            'trending_image.image' => 'Invalid image type',
            'trending_image.required' => 'The trending image cannot be empty',
            'cover_image.image' => 'Invalid image type',
            'cover_image.required' => 'The Cover image cannot be empty',
            'poster_image.image' => 'Invalid image type',
            'poster_image.required' => 'The Poster image cannot be empty',
            'game_image.image' => 'Invalid image type',
            'game_image.max' => 'Image size cannot be larger than 5 MB',
            'image_source.image_source' => 'Image source cannot be empty',
        ];
    }
}
