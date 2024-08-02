<?php

namespace App\Http\Controllers;

use App\Http\Requests\Dashboard\CreateBookRequest;
use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use App\Models\Publisher;
use App\Services\CreateBookService;
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
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all(['id', 'name']);
        $publishers = Publisher::all(['id', 'name']);
        $authors = Author::all(['id','name']);
        return viewDashboard('books.create',compact('categories','publishers','authors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateBookRequest $request)
    {
        $createBookService = new CreateBookService($request);
        $createBookService->create();
        session()->flash('success','تم الحفظ بنجاح');
        return $this->indexAdmin();
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
     * Display the specified resource.
     */
    public function showAdmin(int $book): Factory|\Illuminate\Foundation\Application|View|Application
    {
        $book = Book::where('id',$book)->firstOrFail();
        return viewdashboard('books.show',compact('book'));
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
