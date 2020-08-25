<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckpointCreateRequest extends FormRequest
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
            'user_id' => 'required',
            'flat_no' => 'required',
            'house_no' => 'required',
            'block_no' => 'required',
            'area_id' => 'required',
            'status' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The name field cannot be empty',
            'user_id.required' => 'The user id field cannot be empty',
            'flat_no.required' => 'The flat no field cannot be empty',
            'house_no.required' => 'The house no field cannot be empty',
            'block_no.required' => 'The block no field cannot be empty',
            'area_id.required' => 'The area id field cannot be empty',
            'status.required' => 'The status field cannot be empty',
        ];
    }
}
