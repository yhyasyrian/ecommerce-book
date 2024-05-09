<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Book extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'category_id',
        'publisher_id',
        'isbn',
        'date_publish',
        'pages',
        'copies',
        'price',
        'thumbnail'
    ];
    public $timestamps = false;
    public function authors(): BelongsToMany
    {
        return $this->belongsToMany(Author::class, 'author_book');
    }
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'book_user');
    }
    public function category(): BelongsTo|Category
    {
        return $this->belongsTo(Category::class);
    }
    public function publisher(): BelongsTo|Publisher
    {
        return $this->belongsTo(Publisher::class);
    }
}
