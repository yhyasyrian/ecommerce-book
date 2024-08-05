<?php

namespace App\Services;

use App\Models\Book;
use App\Traits\UploadPhotoTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Storage;
use function request;

class CreateBookService
{
    use UploadPhotoTrait;
    public function __construct(
        private readonly FormRequest $request
    ){}
    public function create(): void
    {
        $book = Book::create($this->attribute());
        $book->authors()->attach(request()->get('authors'));
    }

    private function attribute(): array
    {
        $columnsName = array_keys($this->request->rules());
        unset($columnsName['authors']);
        $attribute = request()->only($columnsName);
        $attribute['thumbnail'] = $this->uploadPhoto();
        return $attribute;
    }
}
