<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DiskConditionCreateRequest extends FormRequest
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
            'name' => 'required|unique:disk_conditions,name|max:255',
            'description' => 'required',
            'status' => 'required|integer',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The name field cannot be empty',
            'name.unique' => 'The name field should be unique',
            'description.required' => 'The description field cannot be empty',
            'status.required' => 'The status field cannot be empty',
        ];
    }
}
