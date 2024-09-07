<?php

namespace App\Http\Requests\Cart;

use App\Services\ResponseApiService;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class AddBookToCartRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'id' => ['required', 'integer', 'exists:books,id'],
            'quantity' => ['required', 'integer', 'min:1'],
        ];
    }

    public function attributes(): array
    {
        return [
            'quantity' => 'الكمية',
            'id' => 'معرف الكتاب'
        ];
    }

    public function failedValidation($validator)
    {
        throw new HttpResponseException(
            ResponseApiService::data(data:['errors' => $validator->errors()],status: false,codeHttp: 422)
        );
    }
}
