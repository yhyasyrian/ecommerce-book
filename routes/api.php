<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::prefix('v1')->name('v1.')->group(function () {
    Route::prefix('paypal')->controller(\App\Http\Controllers\Payments\PaypalController::class)->group(function () {
        Route::post('create-order' , 'createOrder')->name('create.order.paypal');
        Route::post('execute-payment', 'executePayment')->name('execute.order.paypal');
    });
});
