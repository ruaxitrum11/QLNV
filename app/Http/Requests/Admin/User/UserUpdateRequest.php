<?php

namespace App\Http\Requests\Admin\User;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserUpdateRequest extends FormRequest
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
            'name' => [
                'required',
            ]
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Tên người dùng',

        ];
    }

    protected function failedValidation(Validator $validator) : void
    {
        $errors = (new ValidationException($validator))->errors();
        throw new HttpResponseException(response()->json($errors));
    }
}
