<?php

namespace App\Models;

use App\Traits\ImageUrlTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Author extends Model
{

    use HasFactory,ImageUrlTrait;
    protected string $imageAttribute = 'image';
    protected $fillable = [
        'id',
        'name',
        'description',
        'image'
    ];
    public $timestamps = false;
    public function books(): BelongsToMany|Book
    {
        return $this->belongsToMany(Book::class, 'author_book');
    }
}
