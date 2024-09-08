<?php

namespace App\Http\Controllers;

use App\Traits\HelperSEO;
use Illuminate\Routing\Controllers\HasMiddleware;

class CartController extends Controller implements HasMiddleware
{
    use HelperSEO;
    public static function middleware(): array
    {
        return ['auth'];
    }
    public function index()
    {
        $this->SEO('عربة التسوق');
        return view('pages.cart');
    }
}
