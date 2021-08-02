<?php

namespace App\Http\Requests\permissions;

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
            'name' => 'required|max:255',
            'display_name' =>  'required:max:255',
            'parent_id' => 'required|integer|not_in:' . request()->id,
            'key_code'  => 'required|unique:permissions,key_code,' . request()->id
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Permission name không được để trống !',
            'name.max' => 'Permission name không được vượt quá 255 kí tự !',
            'display_name.required' => 'Mô tả không được để trống !',
            'display_name.max' => 'Mô tả không được để trống !',
            'parent_id.required' => 'Parent id không được để trống !',
            'parent_id.integer' => 'Parent id không hợp lệ !',
            'parent_id.not_in' => 'Parent id không hợp lệ !',
            'key_code.required' => 'Key code không được để trống !',
            'key_code.unique' => 'Key code đã có trong database !'
        ];
    }
}