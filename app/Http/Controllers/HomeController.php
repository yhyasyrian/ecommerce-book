<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    private const NAME_VIEW = "pages.home";
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $books = Book::with('category')->paginate(10);
        $this->SEO();
        return view(self::NAME_VIEW,compact('books'));
    }
    public function search(): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $stringSearch = request('search');
        $books = Book::with('category')
            ->where('title', 'like', '%'.$stringSearch.'%')
            ->paginate(10);
        $this->SEO("بحث عن: ".$stringSearch);
        return view(self::NAME_VIEW,compact('books'));
    }
    private function SEO(?string $search = null):void
    {
        SEOTools::setTitle($search ?? __("Home"));
    }
}
