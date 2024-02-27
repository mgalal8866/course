<?php

namespace App\Http\Requests;

use Illuminate\Http\JsonResponse;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
class LoginUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'phone' => 'required|exists:users',
        ];
    }
    public function failedValidation(Validator $validator)

    {
        throw new HttpResponseException(Resp($validator->errors(), 'Error', 200, false));
        // throw new HttpResponseException(Resp($validator->errors(),'', 422));
    }
    public function messages()
    {
        return [
            'phone.exists' => 'الهاتف غير موجود',

        ];
    }
    // public function response(array $errors)
    // {
    //     return new JsonResponse('', 400);
    // }
}
