<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $books = Book::simplePaginate(12);
        $this->SEO();
        return view('pages.home',compact('books'));
    }
    private function SEO():void
    {
        SEOTools::setTitle(__("Home"));
    }
}
