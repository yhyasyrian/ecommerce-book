<?php

namespace App\Livewire\Cart;

use Livewire\Component;
use Livewire\Features\SupportEvents\Event;
use function Livewire\store;

class CartNavigation extends Component
{
    public $listeners = ['refreshCart' => '$refresh'];
    public function render()
    {
        if (auth()->check())
            $countBookInCart = auth()->user()->booksInCart()->sum('book_user.copies');
        else $countBookInCart = 0;
        return view('livewire.cart.cart-navigation',compact('countBookInCart'));
    }
}
