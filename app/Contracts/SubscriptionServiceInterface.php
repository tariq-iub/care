<?php

namespace App\Contracts;

interface SubscriptionServiceInterface
{
    public function createSubscription($user, $plan);

    public function createCheckoutSession($user, $plan);

    public function cancelSubscription($user);

    public function resumeSubscription($user);

    public function swapSubscription($user, $newPlanId);

    public function getSubscriptionStatus($user);
}
