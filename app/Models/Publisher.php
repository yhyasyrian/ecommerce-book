<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Publisher extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'address',
    ];
    public $timestamps = false;
    public function books() :HasMany
    {
        return $this->hasMany(Book::class);
    }
}
