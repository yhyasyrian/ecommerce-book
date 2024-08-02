<?php

namespace App\Http\Requests\Dashboard;

use App\Interfaces\RequestDashboardInterface;
use Illuminate\Foundation\Http\FormRequest;

class CreateBookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    private const MAX_SIZE_THUMBNAIL = 4; // as Mg
    private const MEGABYTE_AS_BYTE = 1024;
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
            'isbn' => ['required', 'numeric', 'unique:books,isbn'],
            'date_publish' => ['required', 'numeric', 'min:1990'],
            'pages' => ['required', 'numeric','min:1'],
            'copies' => ['required', 'integer','min:1'],
            'price' => ['required', 'integer','min:0.1'],
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'publisher_id' => ['required', 'integer','exists:publishers,id'],
            'thumbnail' => ['required', 'image', 'mimes:jpg,png,jpeg', 'max:'.(self::MAX_SIZE_THUMBNAIL * self::MEGABYTE_AS_BYTE),'extensions:jpg,png'],
            'authors' => ['required', 'array','min:1'],
        ];
    }
}
