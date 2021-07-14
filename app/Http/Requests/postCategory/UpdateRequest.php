<?php

namespace App\Http\Requests\postCategory;

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
            'name' => 'required|max:255|unique:post_categories,name,' . request()->id,
            'slug' => 'required|regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/|max:255',
            'status' => 'required',
        ];
    }

    function messages()
    {
        return [
            'name.required' => 'Post category name không được để trống !',
            'name.unique' => 'Post category name đã có trong cơ sở dữ liệu !',
            'config_keyname.max' => 'Post category name không được vượt quá 255 kí tự',
            'slug.required' => 'Slug không được để trống !',
            'slug.regex' => 'Slug không hợp lệ !',
            'slug.max' => 'Slug không được vượt quá 255 kí tự',
            'status.required' => 'Status không được để trống !'
        ];
    }
}