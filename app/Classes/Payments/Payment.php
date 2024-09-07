<?php

namespace App\Classes\Payments;

use App\Models\User;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\DB;

abstract class Payment
{
    private int|float $amount = 0;
    public function __construct(
        private readonly ?User $user = null
    )
    {
        if (!is_null($this->user))
            $this->amount = $this->user->booksInCart()->sum(DB::raw('`books`.`price` * `book_user`.`copies`'));
    }
    public function getAmount(): int|float{
        return $this->amount * (100 - $this->getTax()) / 100;
    }
    protected function getTax():float{
        return 0;
    }
    abstract public function createOrder();
    abstract public function isPaid(mixed $orderId = null): bool;
}
