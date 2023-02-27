<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlatformCreateRequest extends FormRequest
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
            'name' => 'required|unique:platforms,name',
            'url' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'

        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The name field cannot be empty',
            'name.unique' => 'The name field should be unique',
            'url.required' => 'The image field cannot be empty',
            'url.image' => 'Invalid image type',
            'url.max' => 'Image size cannot be larger than 2 MB',
        ];
    }

}
