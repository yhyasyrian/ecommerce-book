<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Rating extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'book_id',
        'value'
    ];
    public $timestamps = false;
    public function scopeCurrentUser(Builder $builder){
        return $builder->where('user_id',auth()->id());
    }
}
