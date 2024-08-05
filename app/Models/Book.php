<?php

namespace App\Models;

use App\Traits\ImageUrlTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class Book extends Model
{
    use HasFactory,ImageUrlTrait;
    public const TABLE = 'books';
    protected string $imageAttribute = 'thumbnail';
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
    protected $casts = [
        'date_publish' => 'integer',
    ];

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
    public function getCategoryNameAttribute(): string {
        return $this->category->name;
    }
    public function getAuthorsNameAttribute(): string {
        $result = '';
        $indexAuthor = 0;
        foreach ($this->authors as $author) {
            if ($indexAuthor++ > 0) $result .= ' و ';
            $result .= $author->name;
        }
        return $result;
    }
    public function getPublisherNameAttribute(): string {
        return $this->publisher->name;
    }
    public function getAuthorsNameArrayAttribute(): array {
        $result = [];
        foreach ($this->authors as $author) {
            $result[] = $author->id;
        }
        return $result;
    }
}
