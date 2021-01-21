<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserByPhoneRequest extends FormRequest
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
            'name' => 'required|max:191',
            'email' => 'required|email|unique:users,email,' . auth()->user()->id,
            'phone_number' => 'required|max:11|unique:users,phone_number,' . auth()->user()->id,
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The name field cannot be empty',
            'name.max' => 'The name should be max 191 character',
            'email.email' => 'Enter valid email',
            'email.required' => 'Enter valid email',
            'email.unique' => 'Email already taken',
            'phone_number.required' => 'The phone number field cannot be empty',
            'phone_number.unique' => 'The phone number should be unique',
            'phone_number.max' => 'The phone number should be max 11 character',
        ];
    }
}
