<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BasePriceUpdateRequest extends FormRequest
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
            'start' => 'integer',
            'end' => 'integer|gt:start',
        ];
    }
    public function messages()
    {
        return [
            'start.integer' => 'The start price field must be integer',
            'end.integer' => 'The end price field must be integer',
            'end.gt' => 'The end price field cannot be equal and less than start price',
        ];
    }
}
