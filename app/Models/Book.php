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
    private array $ratings = ['avg'=>[],'users'=>[]];
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
        'price' => 'decimal:2'
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
    public function ratings(): HasMany{
        return $this->hasMany(Rating::class);
    }
    public function ratingAvg():int
    {
        if (!isset($this->ratings['avg'][$this->id]))
            $this->ratings['avg'][$this->id] = round($this->ratings()->avg('value'));
        return $this->ratings['avg'][$this->id];
    }
    public function isRating():bool{
        if (!auth()->check()) return false;
        if (!isset($this->ratings['exists'][$this->id])) $this->ratings['exists'][$this->id] = $this->ratings()->currentUser()->exists();
        return $this->ratings['exists'][$this->id];
    }
    public function lastRating():int{
        if (!$this->isRating()) return 0;
        if (!isset($this->ratings['users'][$this->id])) $this->ratings['users'][$this->id] = $this->ratings()->currentUser()->value('value');
        return $this->ratings['users'][$this->id];
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
