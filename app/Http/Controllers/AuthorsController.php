<?php

namespace App\Http\Controllers;

use App\Classes\InformationHomePage;
use App\Models\Author;
use App\Traits\HelperSEO;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class AuthorsController extends Controller
{
    use HelperSEO;

    const NAME_VIEW_LIST_CATEGORIES = 'pages.authors';

    /**
     * Display a listing of the resource.
     */
    public function index(): View|Factory|\Illuminate\Foundation\Application
    {
        $this->SEO('المؤلفون')
            ->setDescription('عرض المؤلفون');
        return view(self::NAME_VIEW_LIST_CATEGORIES);
    }

    public function show(Author $author): View|Application
    {
        $this->SEO('منشورات: ' . $author->name)
            ->setDescription($author->description);
        $homeController = new HomeController();
        $homeController->setInformationHomePage(
            new InformationHomePage(
                title: 'منشورات ' . $author->name,
                description: $author->description
            )
        );
        return $homeController->viewPage($author->books()->paginate(12));
    }
}
