<?php

namespace App\Http\Requests\users;

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
            'password' => 'max:255|confirmed',
            'email' => 'required|email:rfc,dns|unique:users,email,' . request()->id,
            'active' => 'required|integer',
            'role_id' => 'required'
        ];
    }
    function messages()
    {
        return [
            'name.required' => 'Name không được để trống !',
            'name.max' => 'Name không được vượt quá 255 kí tự',
            'password.max' => 'Mật khẩu không được vượt quá 255 kí tự!',
            'password.confirmed' => 'Xác nhận mật khẩu không chính xác !',
            'email.required' => 'Email không được để trống !',
            'email.email' => 'Email không hợp lệ !',
            'email.unique' => 'Email đã tồn tại trong cơ sở dữ liệu !',
            'active.required' => 'Trạng thái hoạt động không được để trống !',
            'active.integer' => 'Trạng thái hoạt động không hợp lệ !',
            'role_id.required' => 'Phân quyền không được để trống !',
        ];
    }
}