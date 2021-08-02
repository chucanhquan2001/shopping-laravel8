<?php

namespace App\Http\Requests\posts;

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
            'title' => 'required|max:255|unique:posts,title,' . request()->id,
            'slug' => 'required|regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/|max:255',
            'meta_description' => 'required',
            'content' => 'required',
            'image' => 'max:255',
            'status' => 'required|integer',
            'post_category_id' => 'required|integer'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Tiêu đề không được để trống !',
            'title.unique' => 'Tiêu đề đã có trong cơ sở dữ liệu !',
            'title.max' => 'Tiêu đề không được vượt quá 255 kí tự',
            'slug.required' => 'Slug không được để trống !',
            'slug.regex' => 'Slug không hợp lệ !',
            'slug.max' => 'Slug không được vượt quá 255 kí tự',
            'meta_description.required' => 'Thẻ mô tả ngắn không được để trống !',
            'content.required' => 'Nội dung không được để trống !',
            'image.max' => 'Đường dẫn ảnh không được vượt quá 255 kí tự!',
            'status.required' => 'Trạng thái hiện thị không được để trống!',
            'status.integer' => 'Trạng thái hiện thị không hợp lệ !',
            'post_category_id.required' => 'Danh mục bài viết không được để trống',
            'post_category_id.integer' => 'Danh mục bài viết không hợp lệ !'
        ];
    }
}