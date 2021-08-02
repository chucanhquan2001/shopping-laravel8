<?php

namespace App\Http\Requests\productVariants;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'sku' => 'required|unique:product_variants,sku',
            'price' => 'required|numeric|min:1',
            'discount' => 'numeric|min:0',
            'quantity' => 'required|numeric|min:0',
            'image' => 'required|max:255',
            'variant_value_id' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'sku.required' => 'Mã sản phẩm không được để trống !',
            'sku.unique' => 'Mã sản phẩm đã tồn tại !',
            'price.required' => 'Giá sản phẩm không được để trống !',
            'price.numeric' => 'Giá sản phẩm không hợp lệ !',
            'price.min' => 'Giá sản phẩm không hợp lệ !',
            'discount.numeric' => 'Giảm giá không hợp lệ !',
            'discount.min' => 'Giảm giá không hợp lệ',
            'quantity.required' => 'Số lượng sản phẩm không được để trống !',
            'quantity.numeric' => 'Số lượng sản phẩm không hợp lệ',
            'quantity.min' => 'Số lượng sản phẩm không hợp lệ !',
            'image.required' => 'Ảnh không được để trống !',
            'image.max' => 'Đường dẫn ảnh không được vượt quá 255 kí tự!',
            'variant_value_id.required' => 'Thuộc tính không được để trống !'
        ];
    }
}