<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BasePriceCreateRequest extends FormRequest
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
            'start' => 'required|integer',
            'end' => 'required|integer|gt:start',
            'base' => 'required|integer|unique:base_prices,base',
            'status' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'start.required' => 'The start price field cannot be empty',
            'end.required' => 'The end price field cannot be empty',
            'end.gt' => 'The end price field cannot be equal and less than start price',
            'base.required' => 'The base price field cannot be empty',
            'base.unique' => 'The base price field should be unique',
            'status.required' => 'The status field cannot be empty',
        ];
    }
}
