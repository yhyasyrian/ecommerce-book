<?php

use App\Http\Controllers\BooksController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriesController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/search', [HomeController::class, 'search'])->name('search');
Route::view('/authors', 'welcome')->name('authors.index');
Route::view('/myOrder', 'welcome')->name('orders.index');
Route::get('/book/{book}', [BooksController::class, 'show'])->name('show.book');

Route::get('/category/{category:slug}', [CategoriesController::class, 'show'])->name('categories.show');
Route::get('/categories', [CategoriesController::class,'index'])->name('categories.index');

Route::view('/publisher/{publisher}', 'welcome')->name('publishers.show');
Route::get('/publishers', [\App\Http\Controllers\PublishersController::class,'index'])->name('publishers.index');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
