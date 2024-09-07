<?php

namespace App\Http\Controllers;

use App\Classes\InformationHomePage;
use App\Models\Book;
use App\Traits\HelperSEO;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class HomeController extends Controller
{
    use HelperSEO;
    private const NAME_VIEW = "pages.home";
    private ?InformationHomePage $informationHomePage = null;
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $books = Book::with('category')
            ->withAvg('ratings','value')
            ->paginate(10);
        $this->SEO("الرئيسية")
		->setDescription(config('app.description'));
        return $this->viewPage($books);
    }
    public function search(): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $stringSearch = request('search');
        $books = Book::with('category')
            ->where('title', 'like', '%'.$stringSearch.'%')
            ->paginate(10);
        $this->SEO("بحث عن: ".$stringSearch);
        return $this->viewPage($books);
    }
    public function viewPage(LengthAwarePaginator|Book $books): \Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $informationHomePage = $this->informationHomePage;
        return view(self::NAME_VIEW,compact('books','informationHomePage'));
    }
    public function setInformationHomePage(?InformationHomePage $informationHomePage): void
    {
        $this->informationHomePage = $informationHomePage;
    }
}
