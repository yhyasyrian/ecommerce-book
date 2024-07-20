<?php

namespace App\Http\Controllers;

use App\Classes\InformationHomePage;
use App\Models\Author;
use App\Traits\HelperSEO;
use Illuminate\Http\Request;

class AuthorsController extends Controller
{
    use HelperSEO;
    const NAME_VIEW_LIST_CATEGORIES = 'pages.authors';
    /**
     * Display a listing of the resource.
     */
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
    public function show(Author $author)
    {
        $this->SEO('منشورات: ' . $author->name)
            ->setDescription($author->description);
        $homeController = new HomeController();
        $homeController->setInformationHomePage(
            new InformationHomePage(
                title:'منشورات ' . $author->name,
                description: $author->description
            )
        );
        return $homeController->viewPage($author->books()->paginate(12));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Author $author)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Author $author)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Author $author)
    {
        //
    }
}
