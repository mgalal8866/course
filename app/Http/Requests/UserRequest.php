<?php

namespace App\Http\Requests;

use Illuminate\Http\JsonResponse;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'phone' => 'required|unique:users',
        ];
    }
    public function failedValidation(Validator $validator)

    {

        throw new HttpResponseException(Resp($validator->errors(), 'Error', 200, false));
        // throw new HttpResponseException(Resp($validator->errors(),'', 422));

    }
    // public function response(array $errors)
    // {
    //     return new JsonResponse('', 400);
    // }
}
