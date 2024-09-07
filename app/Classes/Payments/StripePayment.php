<?php

namespace App\Classes\Payments;
use Stripe;;
class StripePayment extends Payment
{

    public function createOrder(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application
    {
        return view('pages.stripe',['price'=>$this->getAmount()]);
    }

    public function isPaid(mixed $orderId = null): bool
    {
        try {
            Stripe\Stripe::setApiKey(config('cashier.secret'));
            Stripe\Charge::create([
                "amount" => $this->getAmount() * 100,
                "currency" => "usd",
                "source" => $orderId,
                "description" => "pay ".$this->getAmount().'$ for buy some books'
            ]);
            return true;
        } catch (\Exception $exception) {
            return false;
        }
    }
}
