<?php

namespace App\Classes\Payments;

use App\Classes\Payments\Payment;
use App\Models\User;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PaypalPayment extends Payment
{
    private PayPalClient $client;
    private $paymentOrder;
    public function __construct(?User $user = null)
    {
        parent::__construct($user);
        $this->client = new PayPalClient;
        $this->client->setApiCredentials(config('paypal'));
        $this->client->setAccessToken($this->client->getAccessToken());
    }
    public function createOrder(): \Psr\Http\Message\StreamInterface|array|string
    {
        return $this->client->createOrder([
            "intent" => "CAPTURE",
            "purchase_units" => [
                "amount" => [
                    "currency_code" => "USD",
                    "value" => $this->getAmount()
                ]
            ]
        ]);
    }
    public function isPaid(mixed $orderId = null): bool
    {
        if (is_null($orderId)) throw new \Exception('Order id is null');
        $this->paymentOrder = $this->client->capturePaymentOrder($orderId);
        return $this->paymentOrder['status'] === "COMPLETED";
    }
    public function getPaymentOrder()
    {
        return $this->paymentOrder;
    }
}
