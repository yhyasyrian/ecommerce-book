<?php

namespace App\Http\Controllers;

use App\Http\Requests\Cart\AddBookToCartRequest;
use App\Models\Book;
use App\Services\ResponseApiService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;

class CartController extends Controller implements HasMiddleware
{

    public static function middleware(): array
    {
        return ['auth'];
    }
    public function index()
    {
        return view('pages.cart');
    }
}
