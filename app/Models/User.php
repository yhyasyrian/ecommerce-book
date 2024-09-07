<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enums\RolesEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Cashier\Billable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use Billable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function books(): BelongsToMany
    {
        return $this->belongsToMany(Book::class, 'book_user');
    }
    public function role():RolesEnum
    {
        return RolesEnum::getRole($this->role);
    }
    public function ratings(): HasMany
    {
        return $this->hasMany(Rating::class);
    }
    public function getNameRoleAttribute():string
    {
        return $this->role()->getName();
    }
    public function booksInCart():belongsToMany
    {
        return $this->belongsToMany(Book::class, 'book_user')->withPivot(['copies','bought','price'])->wherePivot('bought', false);
    }
    public function isBookBought(Book $book): bool
    {
        return $this->booksPurchases()
            ->withPivot(['bought'])
            ->where('book_id',$book->id)
            ->exists();
    }
    public function booksPurchases()
    {
        return $this->belongsToMany(Book::class,'book_user')
            ->withPivot(['bought','price','copies','bought_at'])
            ->wherePivot('bought','=',true);
    }
}
