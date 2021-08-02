<?php

namespace App\Http\Requests\products;

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
            'name' => 'required|max:255|unique:products',
            'slug' => 'required|regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/|max:255',
            'price' => 'required|numeric|min:1',
            'discount' => 'numeric|min:0',
            'quantity' => 'required|numeric|min:0',
            'image' => 'required|max:255',
            'content' => 'required',
            'description' => 'required',
            'status' => 'required|integer',
            'category_id' => 'required|integer',
            'tag' => 'required',
            'variant_value_id' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'sku.required' => 'Mã sản phẩm không được để trống !',
            'sku.unique' => 'Mã sản phẩm đã tồn tại !',
            'name.required' => 'Tên sản phẩm không được để trống !',
            'name.unique' => 'Tên sản phẩm đã có trong cơ sở dữ liệu !',
            'name.max' => 'Tên sản phẩm không được vượt quá 255 kí tự',
            'slug.required' => 'Slug không được để trống !',
            'slug.regex' => 'Slug không hợp lệ !',
            'slug.max' => 'Slug không được vượt quá 255 kí tự',
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
            'content.required' => 'Nội dung không được để trống !',
            'description.required' => 'Mô tả không được để trống !',
            'status.required' => 'Trạng thái hiện thị không được để trống!',
            'status.integer' => 'Trạng thái hiện thị không hợp lệ !',
            'category_id.required' => 'Danh mục không được để trống',
            'category_id.integer' => 'Danh mục không hợp lệ !',
            'tag.required' => 'Thẻ tag không được để trống !',
            'variant_value_id.required' => 'Thuộc tính không được để trống !'
        ];
    }
}