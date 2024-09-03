<?php

namespace App\Http\Controllers;

use App\Models\PricingPlanFeature;
use App\Models\StripePricingPlan;

class PricingPlansController extends Controller
{
    public function showPricingPlans()
    {
        // Fetch all plans grouped by billing period
        $yearlyPlans = StripePricingPlan::where('billing_period', 'yearly')->with('features')->get();
        $monthlyPlans = StripePricingPlan::where('billing_period', 'monthly')->with('features')->get();
        $lifetimePlans = StripePricingPlan::where('billing_period', 'lifetime')->with('features')->get();

        // Fetch all available features
        $features = PricingPlanFeature::all();

        return view('admin.pricing.plans', compact('yearlyPlans', 'monthlyPlans', 'lifetimePlans', 'features'));
    }
}
