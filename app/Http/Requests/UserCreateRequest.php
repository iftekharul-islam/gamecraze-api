<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserCreateRequest extends FormRequest
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
            'name' => 'required|unique:users,name',
            'phone_number' => 'required|unique:users,phone_number|max:11',
            'password' => 'required|confirmed',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The name field cannot be empty',
            'name.unique' => 'The name field should be unique',
            'phone_number.required' => 'The phone number field cannot be empty',
            'phone_number.unique' => 'The phone number should be unique',
            'password.required' => 'The password field cannot be empty',
            'password.confirmed' => 'The password field should be same',
        ];
    }
}
