<?php

namespace App\Http\Requests;

use App\Models\PostReport;
use Illuminate\Foundation\Http\FormRequest;

class PostReportCreateRequest extends FormRequest
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
            'reason' => 'required|string',
        ];
    }

    public function commit()
    {
        return PostReport::create([
            'user_id' => $this->get('user_id'),
            'product_id' => $this->get('product_id'),
            'name' => $this->get('name'),
            'email' => $this->get('email'),
            'phone_no' => $this->get('phone_no'),
            'reason' => $this->get('reason')
        ]);
    }
}
