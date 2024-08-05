<?php


use App\Http\Controllers\BooksController;
use App\Http\Controllers\Dashboard\Index;
use Illuminate\Support\Facades\Route;

Route::get('/', Index::class)->name('home');
Route::resource('books', \App\Dashboard\BookResource::class);
Route::resource('authors', \App\Dashboard\AuthorResource::class);
Route::resource('categories', \App\Dashboard\CategoryResource::class);
Route::resource('publishers', \App\Dashboard\PublisherResource::class);
Route::resource('users', \App\Dashboard\UserResource::class);
//Route::get('/books', [BooksController::class, 'indexAdmin'])->name('books.index');
//Route::get('/books', [BooksController::class, 'indexAdmin'])->name('books.index');
//Route::get('/books/create', [BooksController::class, 'create'])->name('books.create');
//Route::post('/books', [BooksController::class, 'store'])->name('books.store');
//Route::get('/books/{book}', [BooksController::class, 'showAdmin'])->name('books.show');
