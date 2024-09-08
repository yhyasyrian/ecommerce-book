<?php

use App\Http\Controllers\AuthorsController;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Payments\StripeController;
use App\Http\Controllers\PublishersController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/search', [HomeController::class, 'search'])->name('search');
Route::get('/book/{book}', [BooksController::class, 'show'])->name('show.book');

Route::get('/category/{category:slug}', [CategoriesController::class, 'show'])->name('categories.show');
Route::get('/categories', [CategoriesController::class, 'index'])->name('categories.index');

Route::get('/publisher/{publisher}', [PublishersController::class, 'show'])->name('publishers.show');
Route::get('/publishers', [PublishersController::class, 'index'])->name('publishers.index');

Route::get('/authors/{author}', [AuthorsController::class, 'show'])->name('authors.show');
Route::get('/authors', [AuthorsController::class, 'index'])->name('authors.index');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
])->group(function () {
    Route::view('/my-purchases', [HomeController::class,'myPurchases'])->name('my.purchases');
    Route::get('/cart', [CartController::class, 'index'])->name('cart');
    Route::get('/stripe', [StripeController::class, 'index'])->name('show.stripe');
    Route::post('/stripe', [StripeController::class, 'store'])->name('store.stripe');
});
