<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestCustommerRole extends FormRequest
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
            'role' => 'bail|required|max:255'
        ];
    }
    public function messages()
    {
        return [
            'role.required' => "Tên không được phép để trống",
            'role.max' => "Tên được không phép quá 255 ký tự"
        ];
    }
}
