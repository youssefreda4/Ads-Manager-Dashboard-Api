<?php

namespace App\Http\Requests\Api\V1\Auth;

use App\Helper\ApiResponse;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function failedValidation(Validator $validator)
    {
        if ($this->is('api/*')) {
            $response = ApiResponse::sendResponse(422, 'Register Validation Errors', $validator->errors());
            throw new ValidationException($validator, $response);
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|min:8|max:35|unique:users,name',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|confirmed',
            Password::default(),
        ];
    }
}
