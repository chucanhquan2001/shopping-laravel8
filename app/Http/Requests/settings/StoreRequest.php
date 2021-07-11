<?php

namespace App\Http\Requests\settings;

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
            'config_key' => 'required|unique:settings|max:255',
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