<?php

namespace App\Http\Controllers;

use App\Classes\InformationHomePage;
use App\Models\Publisher;
use App\Traits\HelperSEO;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class PublishersController extends Controller
{
    use HelperSEO;

    const NAME_VIEW_LIST_CATEGORIES = 'pages.publishers';

    public function index(): View|Factory|Application
    {
        $this->SEO('الناشرون')
            ->setDescription('عرض الناشرون');
        return view(self::NAME_VIEW_LIST_CATEGORIES);
    }

    /**
     * Display the specified resource.
     */
    public function show(Publisher $publisher)
    {
        $this->SEO('منشورات: ' . $publisher->name)
            ->setDescription('الموقع ' . $publisher->address);
        $homeController = new HomeController();
        $homeController->setInformationHomePage(
            new InformationHomePage(
                title: 'منشورات ' . $publisher->name,
                description: 'الموقع ' . $publisher->address
            )
        );
        return $homeController->viewPage($publisher->books()->paginate(12));
    }
}
