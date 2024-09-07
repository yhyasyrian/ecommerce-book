<?php

namespace App\Services;

use App\Models\Book;

class CartService
{
    private const MAX_COUNT_BOOK = 100;
    private const MIN_COUNT_BOOK = 1;
    private int $newCopies = 0;
    public function __construct(
        private readonly int $copies,
        private readonly Book $book,
        private readonly \Livewire\Component $component
    ){}
    public function addToCart(): void
    {
        if (!auth()->check())
            throw new \Exception('عذراً عليك تسجيل الدخول أولاً');
        if ($this->copies < self::MIN_COUNT_BOOK or $this->copies > self::MAX_COUNT_BOOK)
            throw new \Exception('عذراً القيمة كبيرة جداً');
        $this->addBookToDatabase();
        $this->refersh();
    }
    private function addBookToDatabase(): void
    {
        if (auth()->user()->booksInCart->contains($this->book)) {
            $this->newCopies = auth()->user()->booksInCart()->where('book_id', $this->book->id)->first()->pivot->copies + $this->copies;
            if ($this->newCopies > $this->book->copies) {
                $bookCanBuy = $this->book->copies + $this->copies - $this->newCopies;
                throw new \Exception('عذراً الكمية المتاحة هي فقط: ' . $bookCanBuy);
            }
            auth()->user()->booksInCart()->updateExistingPivot($this->book->id, ['copies' => $this->newCopies]);
            return;
        }
        if ($this->copies > $this->book->copies)
            throw new \Exception('عذراً الكمية المتاحة هي فقط: ' . $this->book->copies);
        $this->newCopies = $this->copies;
        auth()->user()->booksInCart()->attach($this->book->id, ['copies' => $this->newCopies,'price'=>$this->book->price]);
    }
    private function refersh(): void
    {
        $this->component->dispatch('refreshCart');
        $this->component->dispatch('setData', 'تمت الإضافة للسلة', "عدد الكتب في السلة أصبح {$this->newCopies}");
    }
}
