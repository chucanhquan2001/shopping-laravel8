<?php

namespace App\Http\Requests\menus;

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
            'name' => 'required|unique:menus|max:255|min:1',
            'slug' => 'required|regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/',
            'parent_id' => 'required|integer|min:0'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên menu không được để trống !',
            'name.unique' => 'Tên menu đã có trong cơ sở dữ liệu !',
            'name.max' => 'Tên menu không được vượt quá 255 kí tự',
            'name.min' => 'Tên menu không được dưới 1 kí tự !',
            'slug.required' => 'Slug không được để trống !',
            'slug.regex' => 'Slug không hợp lệ !',
            'parent_id.required' => 'Menu cha không được để trống !',
            'parent_id.integer' => 'Menu cha phải là số nguyên !',
            'parent_id.min' => 'Menu cha không hợp lệ !'
        ];
    }
}