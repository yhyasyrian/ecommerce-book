<?php

namespace App\Http\Controllers\Payments;

use App\Classes\Payments\StripePayment;
use App\Http\Controllers\Controller;
use App\Services\BuyBookService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Support\Facades\Log;
use Stripe;

class StripeController extends Controller implements HasMiddleware
{
    private StripePayment $payment;
    public function __construct(){
        $this->payment = new StripePayment(auth()->user());
    }
    public function index(): View|Factory|Application
    {
        return $this->payment->createOrder();
    }
    public function store(): \Illuminate\Http\RedirectResponse
    {
        if ($this->payment->isPaid()) {
            $buyBookService = new BuyBookService(auth()->user());
            $buyBookService->acceptBook();
            Log::notice('Payment success.');
            return back()
                ->with('success', 'Payment successful!');
        }
        Log::notice('Payment failed.');
        return back()
            ->with('fail', 'Payment fail ):');
    }

    public static function middleware(): array
    {
        return ['auth'];
    }
}
