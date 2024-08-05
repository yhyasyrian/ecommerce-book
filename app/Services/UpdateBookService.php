<?php

namespace App\Services;

use App\Models\Book;
use App\Traits\UploadPhotoTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Storage;

class UpdateBookService
{
    use UploadPhotoTrait;
    public function __construct(
        private readonly FormRequest $request,
        private readonly Book $book
    ){}
    public function update(): void
    {
        $keys = array_keys($this->request->rules());
        foreach ($this->attribute() as $key => $value)
            $this->book->{$key} = $value;
        if (request()->has('thumbnail')) {
            dd($this->book->thumbnail);
            Storage::disk('public')->delete($this->book->thumbnail);
            $this->book->thumbnail = $this->uploadPhoto();
        }
        $this->checkIfIsbnIsUnique();
        $this->saveEdit();
    }
    private function checkIfIsbnIsUnique(): void
    {
        if ($this->book->isDirty('isbn'))
            request()->validate(['isbn' => 'unique:books,isbn']);
    }
    private function saveEdit():void
    {
        $this->book->save();
        $this->book->authors()->detach();
        $this->book->authors()->attach(request()->get('authors'));
    }
    private function attribute(): array
    {
        $columnsName = array_keys($this->request->rules());
        unset($columnsName['authors'],$columnsName['thumbnail']);
        $except = ['authors','thumbnail'];
        return request()->only(
            array_filter($columnsName,fn(string $column) => !in_array($column,$except))
        );
    }
}
