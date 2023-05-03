<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateRoleRequest extends FormRequest
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
            'name' => 'bail|required',
            'display_name' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Tên vai trò không được phép để trống',
            'display_name.required' => 'Vai trò hiển thị không được phép để trống',
        ];
    }
}
