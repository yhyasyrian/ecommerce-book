<?php

namespace App\Services;

use App\Mail\SuccessfulOrderMail;
use App\Models\Book;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use function Symfony\Component\Translation\t;

class BuyBookService
{
    public function __construct(private readonly User $user)
    {}
    public function acceptBook(): void
    {
        Mail::to($this->user->email)->send(new SuccessfulOrderMail($this->user));
        foreach ($this->user->booksInCart() as $book) {
            $bookPrice = $book->price;
            $this->user->booksInCart()->updateExistingPivot($book->id, ['price' => $bookPrice,'bought' => true,'bought_at' => now()]);
        }
    }
}
