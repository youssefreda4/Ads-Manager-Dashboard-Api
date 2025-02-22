<?php

namespace App\Http\Requests\Api\V1;

use App\Helper\ApiResponse;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

class AdRequest extends FormRequest
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
        if ($this->is('api/*')) {
            $response = ApiResponse::sendResponse(422, 'Validation Errors', $validator->errors());
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
            'title' => 'required|string|min:5|max:255',
            'phone' => 'required|numeric|digits:11',
            'text' => 'required|string|min:8|max:1500',
            'category_id' => 'required|numeric|exists:categories,id'
        ];
    }

    public function attributes()
    {
        return [
            'title' => 'Title',
            'phone' => 'Phone',
            'text' => 'Text',
            'category_id' => 'Category',
        ];
    }
}
