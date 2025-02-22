<?php

namespace App\Http\Requests\Api\V1;

use App\Helper\ApiResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class MessageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function failedValidation(Validator $validator)
    {
        if($this->is('api/*')){
            $response = ApiResponse::sendResponse(422 , 'Validation Errors' , $validator->errors());
            throw new ValidationException($validator,$response);
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
            'name' => 'required|string',
            'email' => 'required|string|email|unique:messages,email',
            'phone' => 'required|numeric|digits:11',
            'message' => 'required|string|max:1500|min:8'
        ];
    }
}
