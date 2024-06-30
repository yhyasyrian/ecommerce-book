<?php

namespace App\Http\Controllers;

use App\Classes\InformationHomePage;
use App\Models\Publisher;
use App\Traits\HelperSEO;
use Illuminate\Http\Request;

class PublishersController extends Controller
{
    use HelperSEO;
    const NAME_VIEW_LIST_CATEGORIES = 'pages.publishers';
    public function index()
    {
        return view(self::NAME_VIEW_LIST_CATEGORIES);
    }

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
    public function show(Publisher $publisher)
    {
        $this->SEO('منشورات: ' . $publisher->name)
            ->setDescription('الموقع ' . $publisher->address);
        $homeController = new HomeController();
        $homeController->setInformationHomePage(
            new InformationHomePage(
                title:'منشورات ' . $publisher->name,
                description: 'الموقع '.$publisher->address
            )
        );
        return $homeController->viewPage($publisher->books()->paginate(12));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Publisher $publisher)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Publisher $publisher)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Publisher $publisher)
    {
        //
    }
}
