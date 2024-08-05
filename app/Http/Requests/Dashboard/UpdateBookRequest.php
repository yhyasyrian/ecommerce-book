<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBookRequest extends FormRequest
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
            'title' => ['required', 'string'],
            'description' => ['nullable', 'string'],
            'isbn' => ['required', 'numeric'],
            'date_publish' => ['required', 'numeric', 'min:1990'],
            'pages' => ['required', 'numeric','min:1'],
            'copies' => ['required', 'integer','min:1'],
            'price' => ['required', 'integer','min:0.1'],
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'publisher_id' => ['required', 'integer','exists:publishers,id'],
            'thumbnail' => ['image', 'mimes:jpg,png,jpeg', 'max:'.(CreateBookRequest::MAX_SIZE_THUMBNAIL * CreateBookRequest::MEGABYTE_AS_BYTE),'extensions:jpg,png'],
            'authors' => ['required', 'array','min:1'],
        ];
    }
}
