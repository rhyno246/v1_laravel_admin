<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestCouponsCreate extends FormRequest
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
            'coupons_key' => 'bail|required|max:255',
            'coupons_cart_value' => 'required|max:10',
            'coupons_price' => 'required|max:10',
        ];
    }
    public function messages()
    {
        return [
            'coupons_key.required' => "mã không được phép để trống",
            'coupons_price.required' => "Tiền hoạc % không được phép để trống",
            'coupons_key.max' => "mã không được phép quá 255 ký tự",
            'coupons_cart_value.required' => "Giá không được phép để trống",
            'coupons_cart_value.max' => "Giá không được phép quá 10 chữ số",
            'coupons_price.max' => 'Giá không được phép quá 10 chữ số',
        ];
    }
}
