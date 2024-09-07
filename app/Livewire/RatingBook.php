<?php

namespace App\Livewire;

use App\Models\Book;
use App\Models\Rating;
use Livewire\Component;

class RatingBook extends Component
{
    public Book $book;

    public function render()
    {
        return view('livewire.rating-book');
    }

    public function rating(int $value): void
    {
        if ($value < 0 or $value > 5 or !auth()->check()) return;
        $rating = auth()->user()->ratings()->where('book_id', '=', $this->book->id);
        if (!$rating->exists()) {
            $rating = new Rating();
            $rating->book_id = $this->book->id;
            $rating->user_id = auth()->id();
            $rating->value = $value;
            $rating->save();
        } else {
            $rating->update(['value' => $value]);
        }
        $this->dispatch('setData', 'تم التقيم بنجاح', "لقد قيمت الكتاب ب {$value} نجوم");
    }
}
