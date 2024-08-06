<?php

namespace App\Http\Controllers\Dashboard;

use App\Enums\RolesEnum;
use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use App\Models\Publisher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class Index extends Controller
{
    private const TIME_CACHE = 120;
    public function __invoke(Request $request){
        $countBook = $this->countBook();
        $countCategories = $this->countCategories();
        $countPublishers = $this->countPublishers();
        $countAuthors = $this->countAuthors();
        return viewDashboard('index', compact('countBook', 'countCategories', 'countPublishers', 'countAuthors'));
    }
    private function countBook():int
    {
        return Cache::remember(__FUNCTION__,self::TIME_CACHE,fn() => Book::count());
    }
    private function countCategories():int
    {
        return Cache::remember(__FUNCTION__,self::TIME_CACHE,fn() => Category::count());
    }
    private function countAuthors():int{
        return Cache::remember(__FUNCTION__,self::TIME_CACHE,fn() => Author::count());
    }
    private function countPublishers():int{
        return Cache::remember(__FUNCTION__,self::TIME_CACHE,fn() => Publisher::count());
    }
}
