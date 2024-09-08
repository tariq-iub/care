<?php

namespace App\Http\Controllers;

use App\Contracts\SubscriptionServiceInterface;
use App\Models\StripePricingPlan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class CheckoutController extends Controller
{
    protected $subscriptionService;

    public function __construct(SubscriptionServiceInterface $subscriptionService)
    {
        $this->subscriptionService = $subscriptionService;
    }

    public function checkout(Request $request)
    {
        $userId = $request->input('user_id');
        $planId = $request->input('plan_id');

        $user = User::findOrFail($userId);
        $plan = StripePricingPlan::findOrFail($planId);

        return $this->subscriptionService->createSubscription($user, $plan);
    }

    public function success(Request $request)
    {
        $sessionId = $request->get('session_id');
        $hashedUserId = $request->get('user'); // Get the hashed user ID

        // Decrypt the hashed user ID
        $userId = Crypt::decrypt($hashedUserId);

        $user = User::findOrFail($userId); // Fetch the user by ID
        $checkoutSession = $this->subscriptionService->retrieveCheckoutSession($sessionId);

        return view('admin.checkout.success', [
            'checkoutSession' => $checkoutSession,
            'user' => $user,
        ]);
    }

    public function cancel()
    {
        return view('checkout.cancel');
    }
}
