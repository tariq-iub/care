<?php

namespace App\Http\Controllers;

use App\Models\PricingPlanFeature;
use App\Models\StripePricingPlan;
use App\Models\User;
use Illuminate\Http\Request;

class PricingPlansController extends Controller
{
    public function showPricingPlans(Request $request)
    {
        // Retrieve the user ID from the session
        $userId = session('verified_user_id');
        session()->forget('verified_user_id');

        // Fetch the user from the database using the user ID
        $user = User::find($userId);

        // Fetch all plans grouped by billing period
        $yearlyPlans = StripePricingPlan::where('billing_period', 'yearly')->with('features')->get();
        $monthlyPlans = StripePricingPlan::where('billing_period', 'monthly')->with('features')->get();
        $lifetimePlans = StripePricingPlan::where('billing_period', 'lifetime')->with('features')->get();

        // Fetch all available features
        $features = PricingPlanFeature::all();

        return view('admin.pricing.plans',
            compact('yearlyPlans', 'monthlyPlans', 'lifetimePlans', 'features', 'user')
        );
    }
}
