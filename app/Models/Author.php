<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Author extends Model
{
    use HasFactory;
    protected $fillable = [
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
