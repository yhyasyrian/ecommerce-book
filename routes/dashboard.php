<?php


use App\Http\Controllers\BooksController;
use App\Http\Controllers\Dashboard\Index;
use Illuminate\Support\Facades\Route;

Route::get('/', Index::class)->name('home');
Route::resource('books', \App\Dashboard\BookResource::class)->middleware('can:update-book');
Route::resource('authors', \App\Dashboard\AuthorResource::class);
Route::resource('categories', \App\Dashboard\CategoryResource::class);
Route::resource('publishers', \App\Dashboard\PublisherResource::class);
Route::resource('shoppings', \App\Dashboard\ShoppingResource::class);
Route::resource('users', \App\Dashboard\UserResource::class)->middleware('can:update-user');
