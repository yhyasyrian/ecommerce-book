<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait ImageUrlTrait
{
    public function getImageUrlAttribute(): string {
        $image = $this->{$this->imageAttribute};
        if (str_starts_with($image,'https'))
            return $image;
        return asset(Storage::url($image));
    }
}
