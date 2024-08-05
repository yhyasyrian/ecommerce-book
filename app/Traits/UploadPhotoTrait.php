<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use function request;

trait UploadPhotoTrait
{
    public const WIDTH_THUMBNAIL = 600;
    public const HEIGHT_THUMBNAIL = 900;
    public const PATH_STORAGE_COVERS = 'covers';

    protected function uploadPhoto(): string
    {
        $path = $this->getPath();
        $this->resizeImage($path);
        return $path;
    }

    protected function getPath(): string
    {
        $path = uniqid(now()->format('Y-m-d')) . '.' . request()->file('thumbnail')->getClientOriginalExtension();
        if (!is_dir($dir = Storage::disk('public')->path(self::PATH_STORAGE_COVERS))) mkdir($dir);
        return self::PATH_STORAGE_COVERS.'/'.$path;
    }

    protected function resizeImage(string $path): void
    {
        $tmpFile = 'app/' . request()->file('thumbnail')->store('tmp');
        $image = ImageManager::imagick()->read(storage_path($tmpFile));
        $image->resize(width: self::WIDTH_THUMBNAIL, height: self::HEIGHT_THUMBNAIL);
        $image->save(Storage::disk('public')->path($path));
        unlink(storage_path($tmpFile));
    }
}
