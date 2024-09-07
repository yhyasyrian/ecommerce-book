<?php

namespace App\Livewire\Cart;

use App\Models\Book;
use App\Services\CartService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ShowBooks extends Component
{
    public function render()
    {
        $books = Auth()->user()->booksInCart()->get();
        return view('livewire.cart.show-books',compact('books'));
    }
    public function minus(int $idBook):void
    {
        $book = auth()->user()->booksInCart()->where('book_id', $idBook)->first();
        if ($book->pivot->copies == 1){
            $this->delete($idBook);
            return;
        }
        auth()->user()->booksInCart()->updateExistingPivot($idBook,['copies' => $book->pivot->copies - 1]);
        $this->refreshData('تم الإزالة بنجاح','تمت إزالة كتاب من السلة بنجاح');
    }
    public function delete(int $idBook):void
    {
        auth()->user()->booksInCart()->detach($idBook);
        $this->refreshData('تم الحذف بنجاح','تمت إزالة الكتب من السلة بنجاح');
    }
    public function add(int $idBook):void
    {
        $cartService = new CartService(1,Book::find($idBook),$this);
        try {
            $cartService->addToCart();
            $this->error = '';
        } catch (\Exception $exception){
            $this->error = $exception->getMessage();
        }
    }
    private function refreshData(string $title,string $description): void
    {
        $this->dispatch('refreshCart');
        $this->dispatch('setData',$title,$description);
    }
}
