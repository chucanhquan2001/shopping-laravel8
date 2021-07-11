<?php

namespace App\Http\Requests\settings;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function rules()
    {
        return [
            'config_key' => 'required|max:255|unique:settings,config_key,' . request()->id,
            'config_value' => 'required',
        ];
    }

    function messages()
    {
        return [
            'config_key.required' => 'Config key không được để trống !',
            'config_key.unique' => 'Config key đã có trong cơ sở dữ liệu !',
            'config_key.max' => 'Config key không được vượt quá 255 kí tự',
            'config_value.required' => 'Config value không được để trống !',
        ];
    }
}