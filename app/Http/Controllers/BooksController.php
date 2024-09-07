<?php

namespace App\Http\Controllers;

use App\Http\Requests\Dashboard\CreateBookRequest;
use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use App\Models\Publisher;
use App\Models\Rating;
use App\Services\CreateBookService;
use App\Services\ResponseApiService;
use App\Traits\HelperSEO;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class BooksController extends Controller
{
    use HelperSEO;
    const NAME_VIEW_SHOW_BOOK = 'pages.book';
    /**
     * Display a listing of the resource.
     */
    public function indexAdmin(): Factory|\Illuminate\Foundation\Application|View|Application
    {
        $books = Book::paginate(10);
        return viewDashboard('books.index',compact('books'));
    }
    /**
     * Display the specified resource.
     */
    public function show(Book $book): Factory|\Illuminate\Foundation\Application|View|Application
    {
        $book->withAvg('ratings','value');
        $this->SEO($book->title)
            ->setDescription(
                mb_substr($book->description,0,140) // you can use also str function or Str Helper Classes
            );
        return view(self::NAME_VIEW_SHOW_BOOK, compact('book'));
    }
}
