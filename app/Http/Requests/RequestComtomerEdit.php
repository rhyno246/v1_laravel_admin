<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestComtomerEdit extends FormRequest
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
            'name' => 'bail|required|max:255|min:2',
            'email' => 'required',
            'password' => 'required|max:100|min:4',
            'phone' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Tên không được phép để trống',
            'name.max' => 'Tên không được phép quá 255 kí tự',
            'name.min' => 'Tên phải trên 2 kí tự',
            'email.required' => 'Email không được phép để trống',
            'password.required' => 'Mật khẩu không được phép để trống',
            'password.max' => 'Mật khẩu không được phép quá 100 kí tự',
            'password.min' => 'Mật khẩu phải trên 2 kí tự',
            'phone.required' => 'phone không được phép để trống',
        ];
    }
}
