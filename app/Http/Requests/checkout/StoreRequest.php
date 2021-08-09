<?php

namespace App\Http\Requests\checkout;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\UniqueEmailCheckout;

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
            'phone' =>  ['required', 'max:255', 'regex:/(^[\+]{0,1}+(84){1}+[0-9]{9})|((^0)(32|33|34|35|36|37|38|39|56|58|59|70|76|77|78|79|81|82|83|84|85|86|88|89|90|92|91|93|94|96|97|98|99)+([0-9]{7}))$/'],
            'email' => ['required', 'email:rfc,dns', 'max:255', new UniqueEmailCheckout],
            'address' => 'required|max:255'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Họ tên không được để trống !',
            'name.max' => 'Họ tên không được vượt quá 255 kí tự',
            'phone.max' => 'Số điện thoại không được vượt quá 255 kí tự',
            'phone.required' => 'Số điện thoại không được để trống !',
            'phone.regex' => 'Số điện thoại không hợp lệ !',
            'email.required' => 'Email không không được để trống !',
            'email.email' => 'Email không hợp lệ !',
            'email.max' => 'Email không được vượt quá 255 kí tự',
            'address.max' => 'Địa chỉ không được vượt quá 255 kí tự',
            'address.required' => 'Địa chỉ không được để trống !'
        ];
    }
}