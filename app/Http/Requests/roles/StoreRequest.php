<?php

namespace App\Http\Requests\roles;

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
            'name' => 'required|max:255',
            'display_name' =>  'required:max:255',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Permission name không được để trống !',
            'name.max' => 'Permission name không được vượt quá 255 kí tự !',
            'display_name.required' => 'Mô tả không được để trống !',
            'display_name.max' => 'Mô tả không được để trống !',
        ];
    }
}