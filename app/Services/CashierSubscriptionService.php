<?php

namespace App\Services;

use App\Contracts\SubscriptionServiceInterface;
use Illuminate\Support\Facades\Log;
use Stripe\Stripe;
use Stripe\Checkout\Session as StripeSession;

class CashierSubscriptionService implements SubscriptionServiceInterface
{
    public function createSubscription($user, $plan)
    {
        try {
            // Use Stripe Checkout for subscription management
            $checkoutUrl = $this->createCheckoutSession($user, $plan);
            return $checkoutUrl;
        } catch (\Exception $e) {
            Log::error('Error creating subscription: ' . $e->getMessage());
            throw new \Exception('Unable to create subscription. Please try again.');
        }
    }

    public function createCheckoutSession($user, $plan)
    {
        Stripe::setApiKey(config('stripe.secret'));

        $priceId = $this->getPriceIdFromPlan($plan);

        try {
            $session = StripeSession::create([
                'payment_method_types' => ['card'],
                'line_items' => [[
                    'price' => $priceId,
                    'quantity' => 1,
                ]],
                'mode' => 'subscription',
                'success_url' => route('checkout.success') . '?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('checkout.cancel'),
                'customer_email' => $user->email,
            ]);

            return $session->url;
        } catch (\Exception $e) {
            Log::error('Error creating checkout session: ' . $e->getMessage());
            throw new \Exception('Unable to create checkout session. Please try again.');
        }
    }

    private function getPriceIdFromPlan($plan)
    {
        $planPrices = [
            'monthly' => 'price_monthly_id',
            'yearly' => 'price_yearly_id',
        ];

        return $planPrices[$plan] ?? null;
    }

    public function cancelSubscription($user)
    {
        try {
            $user->subscription('default')->cancel();
            return true;
        } catch (\Exception $e) {
            Log::error('Error canceling subscription: ' . $e->getMessage());
            throw new \Exception('Unable to cancel subscription. Please try again.');
        }
    }

    public function resumeSubscription($user)
    {
        try {
            $user->subscription('default')->resume();
            return true;
        } catch (\Exception $e) {
            Log::error('Error resuming subscription: ' . $e->getMessage());
            throw new \Exception('Unable to resume subscription. Please try again.');
        }
    }

    public function swapSubscription($user, $newPlanId)
    {
        try {
            $user->subscription('default')->swap($newPlanId);
            return true;
        } catch (\Exception $e) {
            Log::error('Error swapping subscription: ' . $e->getMessage());
            throw new \Exception('Unable to swap subscription. Please try again.');
        }
    }

    public function getSubscriptionStatus($user)
    {
        return $user->subscribed('default');
    }
}
