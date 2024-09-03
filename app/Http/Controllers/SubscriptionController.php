<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Contracts\SubscriptionServiceInterface;

class SubscriptionController extends Controller
{
    protected $subscriptionService;

    public function __construct(SubscriptionServiceInterface $subscriptionService)
    {
        $this->subscriptionService = $subscriptionService;
    }

    public function createSubscription(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            // User is not logged in, attempt to fetch the user by email
            $email = $request->input('email');
            $user = User::where('email', $email)->first();

            // Log in the fetched user
            Auth::login($user);
        }

        $plan = $request->input('plan');

        try {
            $checkoutUrl = $this->subscriptionService->createSubscription($user, $plan);
            return redirect($checkoutUrl);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function cancelSubscription()
    {
        $user = Auth::user();

        try {
            $this->subscriptionService->cancelSubscription($user);
            return redirect()->route('dashboard')->with('success', 'Subscription canceled successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function resumeSubscription()
    {
        $user = Auth::user();

        try {
            $this->subscriptionService->resumeSubscription($user);
            return redirect()->route('dashboard')->with('success', 'Subscription resumed successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function swapSubscription(Request $request)
    {
        $user = Auth::user();
        $newPlanId = $request->input('new_plan_id');

        try {
            $this->subscriptionService->swapSubscription($user, $newPlanId);
            return redirect()->route('dashboard')->with('success', 'Subscription swapped successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function getSubscriptionStatus()
    {
        $user = Auth::user();

        $isSubscribed = $this->subscriptionService->getSubscriptionStatus($user);
        return response()->json(['is_subscribed' => $isSubscribed]);
    }

    public function success(Request $request)
    {
        $sessionId = $request->get('session_id');
        $checkoutSession = $this->subscriptionService->retrieveCheckoutSession($sessionId);

        return view('checkout.success', ['checkoutSession' => $checkoutSession]);
    }

    public function cancel()
    {
        return view('checkout.cancel');
    }
}
