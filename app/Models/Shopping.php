<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shopping extends Model
{
    use HasFactory;
    protected $table = 'book_user';
    public $fillable = [
        'user_id',
        'book_id',
        'price',
        'bought_at',
        'copies',
        'bought'
    ];
    protected $casts = [
        'bought_at' => 'datetime',
        'price' => 'decimal:2',
    ];
    public $timestamps = false;
    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function book():\Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Book::class);
    }
    public function getTotalPriceAttribute():string
    {
        return ($this->price * $this->copies).'.00';
    }
    public function getUserNameAttribute():string
    {
        return $this->user->name ?? "";
    }
    public function getBookTitleAttribute():string
    {
        return $this->book->title ?? "";
    }
    public function getBoughtAtDiffAttribute():string
    {
        return $this->bought_at->diffForHumans();
    }
}
