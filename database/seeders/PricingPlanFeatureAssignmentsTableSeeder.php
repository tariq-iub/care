<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\StripePricingPlan;
use App\Models\PricingPlanFeature;

class PricingPlanFeatureAssignmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Fetch all features
        $features = PricingPlanFeature::all();

        // Define available features for each plan type with correct naming
        $plansWithFeatures = [
            'default_lifetime' => 4,
            'basic_monthly' => 1,
            'standard_monthly' => 2,
            'premium_monthly' => 3,
            'enterprise_monthly' => 4,
            'basic_yearly' => 1,
            'standard_yearly' => 2,
            'premium_yearly' => 3,
            'enterprise_yearly' => 4,
        ];

        // Assign features to each plan
        foreach ($plansWithFeatures as $planName => $availableFeatures) {
            $plan = StripePricingPlan::where('name', $planName)->first();

            if ($plan) {
                foreach ($features as $index => $feature) {
                    $isAvailable = $index < $availableFeatures; // Set available based on the number of features for the plan

                    // Attach feature to the plan with 'is_available' status
                    $plan->features()->attach($feature->id, [
                        'is_available' => $isAvailable,
                    ]);
                }
            }
        }
    }
}
