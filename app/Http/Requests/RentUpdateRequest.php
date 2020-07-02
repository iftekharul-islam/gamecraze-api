<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RentUpdateRequest extends FormRequest
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
            'game_id' =>  'integer',
            'max_week' =>  'integer',
            'availability' =>  '',
            'platform_id' =>  'integer',
            'earning_amount' =>  'integer',
            'disk_condition_id' =>  'integer',
            'cover_image' =>  'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
            'disk_image' =>  'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
            'rented_user_id' =>  'integer',
            'status' => 'integer',
        ];
    }
}
