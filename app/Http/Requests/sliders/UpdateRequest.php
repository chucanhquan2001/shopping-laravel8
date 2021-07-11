<?php

namespace App\Http\Requests\sliders;

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
            'name' => 'required|max:255|unique:sliders,name,' . request()->id,
            'title' => 'required|max:255',
            'description' => 'required|max:255',
            'post_link' => 'required|max:255',
            'image_path' => 'max:255',
            'status' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên slider không được để trống !',
            'name.unique' => 'Tên slider đã có trong cơ sở dữ liệu !',
            'name.max' => 'Tên slider không được vượt quá 255 kí tự',
            'title.required' => 'Tiêu đề không được để trống !',
            'title.max' => 'Tiêu đề không được vượt quá 255 kí tự!',
            'description.required' => 'Mô tả không được để trống !',
            'description.max' => 'Mô tả không được vượt quá 255 kí tự!',
            'post_link.required' => 'Link bài viết không được để trống !',
            'post_link.max' => 'Link bài viết không được vượt quá 255 kí tự!',
            'image_path.max' => 'Đường dẫn ảnh không được vượt quá 255 kí tự!',
            'status.required' => 'Trạng thái hiện thị không được để trống!',
        ];
    }
}