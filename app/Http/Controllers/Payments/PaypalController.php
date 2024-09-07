<?php

namespace App\Http\Controllers\Payments;

use App\Classes\Payments\PaypalPayment;
use App\Http\Controllers\Controller;
use App\Interfaces\PaymentsInterface;
use App\Livewire\Cart\CartNavigation;
use App\Models\User;
use App\Services\BuyBookService;
use App\Services\ResponseApiService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Livewire;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PaypalController extends Controller implements PaymentsInterface
{
    private PaypalPayment $paypalPayment;
    private Request $request;
    private User $user;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->validate(['user_id' => 'required|integer|exists:users,id']);
        $this->user = User::find($this->request->get('user_id'));
        $this->paypalPayment = new PaypalPayment($this->user);
    }

    public function createOrder(): JsonResponse
    {
        try {
            return ResponseApiService::responseOnly($this->paypalPayment->createOrder());
        } catch (\Throwable $exception) {
            Log::error($exception->__toString());
            return ResponseApiService::response(message: "Error!",status: false,codeHttp: 500);
        }
    }

    public function executePayment()
    {
        $this->validate(['orderId' => 'required']);
        try {
            DB::beginTransaction();
            if (!$this->paypalPayment->isPaid($this->request->get('orderId')))
                throw new \Exception("Error! Payment failed");
            $buyBookService = new BuyBookService($this->user);
            $buyBookService->acceptBook();
            DB::commit();
        } catch (\Throwable $exception) {
            DB::rollBack();
        } finally {
            return ResponseApiService::responseOnly(data:$this->paypalPayment->getPaymentOrder(),codeHttp: 400);
        }
    }

    private function validate(array $rules): void
    {
        $this->request->validate($rules);
    }
}
