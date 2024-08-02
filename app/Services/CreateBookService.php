<?php

namespace App\Services;

use App\Models\Book;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
class CreateBookService
{
    private const WIDTH_THUMBNAIL = 600;
    private const HEIGHT_THUMBNAIL = 900;
    private const PATH_STORAGE_COVERS = 'covers';
    private const PATH_STORAGE_PUBLIC = 'app/public';
    public function __construct(
        private readonly FormRequest $request
    ){}
    public function create():void
    {
        $book = Book::create($this->attribute());
        $book->authors()->attach(\request()->get('authors'));
    }
    private function attribute():array
    {
        $columnsName = array_keys($this->request->rules());
        unset($columnsName['authors']);
        $attribute = \request()->only($columnsName);
        $attribute['thumbnail'] = Storage::disk()->url($this->uploadPhoto());
        return $attribute;
    }
    private function uploadPhoto():string
    {
        $path = $this->getPath();
        $this->resizeImage($path);
        return $path;
    }
    private function getPath():string
    {
        $path = self::PATH_STORAGE_COVERS.'/'.uniqid(now()->format('Y-m-d')).'.'.\request()->file('thumbnail')->getClientOriginalExtension();
        if (!is_dir(storage_path(self::PATH_STORAGE_COVERS))) mkdir(storage_path(self::PATH_STORAGE_COVERS));
        return $path;
    }
    private function resizeImage(string $path):void
    {
        $tmpFile = 'app/'.\request()->file('thumbnail')->store('tmp');
        $image = ImageManager::imagick()->read(storage_path($tmpFile));
        $image->resize(width: self::WIDTH_THUMBNAIL, height: self::HEIGHT_THUMBNAIL);
        $image->save(storage_path(self::PATH_STORAGE_PUBLIC.'/'.$path));
        unlink(storage_path($tmpFile));
    }
}
