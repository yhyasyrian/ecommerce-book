<?php

namespace App\Livewire\Cart;

use App\Models\Book;
use App\Services\CartService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Validator;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\Exceptions\LivewirePageExpiredBecauseNewDeploymentHasSignificantEnoughChanges;

class AddBook extends Component
{
    public Book $book;
    public int $copies = 1;
    public string $error = '';
    public function render(): View|Factory|Application
    {
        return view('livewire.cart.add-book');
    }

    public function addToCart(): void
    {
        $cartService = new CartService($this->copies,$this->book,$this);
        try {
            $cartService->addToCart();
            $this->error = '';
        } catch (\Exception $exception){
            $this->error = $exception->getMessage();
        }
    }
}
