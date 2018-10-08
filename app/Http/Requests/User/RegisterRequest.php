<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterRequest extends FormRequest
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
            'username' => [
                'required',
                'min:5',
                Rule::unique('users', 'username')
            ],
            'name' => [
                'required',
            ],
            'password' => [
                'required',
                'min:5',
                'confirmed'
            ]
            //
        ];
    }
     public function attributes()
     {
         return [
             'username' => 'Tên tài khoản',
             'name' => 'Tên người dùng',
             'password' => 'Mật khẩu'
         ];
     }
}
