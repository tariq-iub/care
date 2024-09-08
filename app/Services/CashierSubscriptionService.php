<?php

namespace App\Services;

use App\Contracts\SubscriptionServiceInterface;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;
use Stripe\Checkout\Session as StripeSession;
use Stripe\Stripe;
use Exception;

class CashierSubscriptionService implements SubscriptionServiceInterface
{
    public function __construct()
    {
        Stripe::setApiKey(config('cashier.secret'));
    }
    /**
     * Create a new subscription for the given user and plan.
     *
     * @param \App\Models\User $user
     * @param \App\Models\StripePricingPlan $plan
     * @return \Laravel\Cashier\Checkout
     * @throws \Exception
     */
    public function createSubscription($user, $plan)
    {
        // Hash the user ID
        $hashedUserId = Crypt::encrypt($user->id);

        // Create a new subscription using Cashier
        return $user->newSubscription($plan->name, $plan->stripe_price_id)
            ->checkout([
                'success_url' => url('/checkout/success?session_id={CHECKOUT_SESSION_ID}&user=' . $hashedUserId),
                'cancel_url' => route('checkout.cancel'),
            ]);
    }

    /**
     * Cancel the user's active subscription.
     *
     * @param \App\Models\User $user
     * @return bool
     * @throws \Exception
     */
    public function cancelSubscription($user)
    {
        try {
            $subscription = $user->subscription('default');
            if (!$subscription) {
                throw new Exception('No active subscription found.');
            }

            $subscription->cancel();
            return true;
        } catch (Exception $e) {
            Log::error('Error canceling subscription: ' . $e->getMessage());
            throw new Exception('Unable to cancel subscription. Please try again.');
        }
    }

    /**
     * Resume a canceled subscription.
     *
     * @param \App\Models\User $user
     * @return bool
     * @throws \Exception
     */
    public function resumeSubscription($user)
    {
        try {
            $subscription = $user->subscription('default');
            if (!$subscription || !$subscription->onGracePeriod()) {
                throw new Exception('No grace period or active subscription to resume.');
            }

            $subscription->resume();
            return true;
        } catch (Exception $e) {
            Log::error('Error resuming subscription: ' . $e->getMessage());
            throw new Exception('Unable to resume subscription. Please try again.');
        }
    }

    /**
     * Swap the current subscription to a new plan.
     *
     * @param \App\Models\User $user
     * @param string $newPlanId
     * @return bool
     * @throws \Exception
     */
    public function swapSubscription($user, $newPlanId)
    {
        try {
            $subscription = $user->subscription('default');
            if (!$subscription) {
                throw new Exception('No active subscription to swap.');
            }

            $subscription->swap($newPlanId);
            return true;
        } catch (Exception $e) {
            Log::error('Error swapping subscription: ' . $e->getMessage());
            throw new Exception('Unable to swap subscription. Please try again.');
        }
    }

    /**
     * Get the subscription status of the user.
     *
     * @param \App\Models\User $user
     * @return bool
     */
    public function getSubscriptionStatus($user)
    {
        return $user->subscribed('default');
    }

    /**
     * Retrieve a checkout session by its ID.
     *
     * @param string $sessionId
     * @return \Stripe\Checkout\Session
     */
    public function retrieveCheckoutSession($sessionId)
    {
        return StripeSession::retrieve($sessionId);
    }
}
