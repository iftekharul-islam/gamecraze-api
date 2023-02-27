<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VideoCreateRequest extends FormRequest
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
            'title' => 'required|max:191',
            'video_url' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'The title field cannot be empty',
            'title.max' => 'The title should be maximum 191 character',
            'video_url.required' => 'The video url field cannot be empty'
        ];
    }
}
