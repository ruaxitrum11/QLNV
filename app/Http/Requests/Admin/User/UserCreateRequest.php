<?php

namespace App\Http\Requests\Admin\User;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserCreateRequest extends FormRequest
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
            'password' => [
                'required',
                'min:5',
                'confirmed'
            ]
            //
        ];
    }
//    public function attributes()
//    {
//        return [
//            'username'=>'Công việc cần làm'
//        ];
//    }

    /**
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator $validator
     * @return void
     *
     * @throws HttpResponseException
     */
    protected function failedValidation(Validator $validator) : void
    {
        $errors = (new ValidationException($validator))->errors();
        throw new HttpResponseException(response()->json($errors));
    }
}
