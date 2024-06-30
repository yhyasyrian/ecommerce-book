<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Traits\HelperSEO;
use Illuminate\Http\Request;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class BooksController extends Controller
{
    use HelperSEO;
    const NAME_VIEW_SHOW_BOOK = 'pages.book';
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book): Factory|\Illuminate\Foundation\Application|View|Application
    {
        $this->SEO($book->title)
            ->setDescription(
                mb_substr($book->description,0,140) // you can use also str function or Str Helper Classes
            );
        return view(self::NAME_VIEW_SHOW_BOOK, compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        //
    }
}
