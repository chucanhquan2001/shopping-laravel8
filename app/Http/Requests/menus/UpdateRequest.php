<?php

namespace App\Http\Requests\menus;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'name' => 'required|max:255|min:1|unique:menus,name,' . request()->id,
            'slug' => 'required|regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/',
            'parent_id' => 'required|integer|min:0|not_in:' . request()->id
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên danh mục không được để trống !',
            'name.unique' => 'Tên danh mục đã có trong cơ sở dữ liệu !',
            'name.max' => 'Tên danh mục không được vượt quá 255 kí tự',
            'name.min' => 'Tên danh mục không được dưới 1 kí tự !',
            'slug.required' => 'Slug không được để trống !',
            'slug.regex' => 'Slug không hợp lệ !',
            'parent_id.required' => 'Danh mục cha không được để trống !',
            'parent_id.integer' => 'Danh mục cha phải là số nguyên !',
            'parent_id.min' => 'Danh mục cha không hợp lệ !',
            'parent_id.not_in' => 'Danh mục cha không hợp lệ !'
        ];
    }
}