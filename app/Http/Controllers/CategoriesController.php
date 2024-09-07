<?php

namespace App\Http\Controllers;

use App\Classes\InformationHomePage;
use App\Models\Category;
use App\Traits\HelperSEO;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    use HelperSEO;
    const NAME_VIEW_LIST_CATEGORIES = 'pages.categories';
    /**
     * Display a listing of the resource.
     */
    public function index(): Factory|\Illuminate\Foundation\Application|View|Application
    {
        $this->SEO('التصنيفات')
            ->setDescription('عرض التصنيفات');
        return view(self::NAME_VIEW_LIST_CATEGORIES);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        $this->SEO('قسم ال' . $category->name)
            ->setDescription($category->description);
        $homeController = new HomeController();
        $homeController->setInformationHomePage(
            new InformationHomePage(
                title:'قسم ال' . $category->name,
                description: $category->description
            )
        );
        return $homeController->viewPage($category->books()->paginate(12));
    }
}
