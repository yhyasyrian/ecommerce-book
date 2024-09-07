<?php

namespace App\Interfaces;
interface PaymentsInterface
{
    public function createOrder():\Illuminate\Http\JsonResponse;
    public function executePayment();
}
