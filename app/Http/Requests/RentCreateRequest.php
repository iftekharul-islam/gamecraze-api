<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RentCreateRequest extends FormRequest
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
            'game_id' =>  'required|integer',
            'max_week' =>  'required|integer',
            'availability' =>  'required',
            'platform_id' =>  'required|integer',
            'disk_condition_id' =>  'required|integer',
            'rented_user_id' =>  'nullable|integer',
            'status' => 'required|integer',
        ];
    }
}
