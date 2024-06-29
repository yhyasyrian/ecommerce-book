<?php

use App\Http\Controllers\BooksController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CateoriesController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/search', [HomeController::class, 'search'])->name('search');
Route::view('/categories', 'welcome')->name('categories.index');
Route::view('/publishers', 'welcome')->name('publishers.index');
Route::view('/authors', 'welcome')->name('authors.index');
Route::view('/myOrder', 'welcome')->name('orders.index');
Route::get('/book/{book}', [BooksController::class, 'show'])->name('show.book');

Route::get('/category/{category:slug}', [CateoriesController::class, 'show'])->name('categories.show');
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
