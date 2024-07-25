<?php


use App\Http\Controllers\Dashboard\Index;
use Illuminate\Support\Facades\Route;

Route::get('/', Index::class)->name('home');
Route::get('/books', Index::class)->name('books.show');
