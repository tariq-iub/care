<?php

namespace App\Http\Controllers;

use App\Services\PaymentServiceInterface;
use Illuminate\Http\Request;
class PaymentController extends Controller
{
    protected $paymentService;

    public function __construct(PaymentServiceInterface $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    public function createPaymentIntent(Request $request)
    {
        try {
            $data = [
                'amount' => $request->input('amount'),
                'currency' => 'usd',
                'payment_method_types' => ['card'],
            ];
            $paymentIntent = $this->paymentService->createPaymentIntent($data);
            return response()->json(['clientSecret' => $paymentIntent->client_secret]);
        } catch (\Exception $exception) {
            $errorMessage = $this->paymentService->handlePaymentException($exception);
            return response()->json(['error' => $errorMessage], 400);
        }
    }

    public function confirmPayment(Request $request)
    {
        try {
            $paymentData = [
                'payment_method' => $request->input('payment_method_id'),
            ];
            $this->paymentService->confirmPayment($request->input('client_secret'), $paymentData);
            return response()->json(['message' => 'Payment successful']);
        } catch (\Exception $exception) {
            $errorMessage = $this->paymentService->handlePaymentException($exception);
            return response()->json(['error' => $errorMessage], 400);
        }
    }
}
