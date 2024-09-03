<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StripePricingPlansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productId = DB::table('stripe_products')->first()->id;

        DB::table('stripe_pricing_plans')->insert([
            [
                'product_id' => $productId,
                'stripe_price_id' => 'price_1PuSKuIt323uYS05Yaf0W2P2', // Replace with your Stripe price ID
                'name' => 'default_lifetime',
                'title' => 'Default Plan - Lifetime',
                'description' => 'Get lifetime access to all features and updates with a one-time payment. Ideal for those who want long-term value without recurring charges.',
                'billing_period' => 'lifetime',
                'currency' => 'usd',
                'price' => 10000, // Amount in cents
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null, // Assuming using soft deletes
            ],
            [
                'product_id' => $productId,
                'stripe_price_id' => 'price_1PuSNkIt323uYS057j1wTsLn', // Replace with your Stripe price ID
                'name' => 'basic_monthly',
                'title' => 'Basic Plan - Monthly',
                'description' => 'A great starter plan for individuals who need basic access to features on a monthly basis. Includes essential tools and support.',
                'billing_period' => 'monthly',
                'currency' => 'usd',
                'price' => 100, // Amount in cents
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ],
            [
                'product_id' => $productId,
                'stripe_price_id' => 'price_1PuSNwIt323uYS05GOBGeeIs', // Replace with your Stripe price ID
                'name' => 'standard_monthly',
                'title' => 'Standard Plan - Monthly',
                'description' => 'Perfect for small businesses, this plan offers access to all features and enhanced support on a monthly basis.',
                'billing_period' => 'monthly',
                'currency' => 'usd',
                'price' => 250, // Amount in cents
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ],
            [
                'product_id' => $productId,
                'stripe_price_id' => 'price_1PuSO8It323uYS05C8DpZ8JW', // Replace with your Stripe price ID
                'name' => 'premium_monthly',
                'title' => 'Premium Plan - Monthly',
                'description' => 'Ideal for growing teams, this plan provides comprehensive access to all features with premium support and custom reporting.',
                'billing_period' => 'monthly',
                'currency' => 'usd',
                'price' => 400, // Amount in cents
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ],
            [
                'product_id' => $productId,
                'stripe_price_id' => 'price_1PuSOFIt323uYS05sjsewBWQ', // Replace with your Stripe price ID
                'name' => 'enterprise_monthly',
                'title' => 'Enterprise Plan - Monthly',
                'description' => 'Designed for large enterprises, this plan offers full access to all features, top-tier support, and a dedicated account manager.',
                'billing_period' => 'monthly',
                'currency' => 'usd',
                'price' => 500, // Amount in cents
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ],
            [
                'product_id' => $productId,
                'stripe_price_id' => 'price_1PuSM3It323uYS050ttRh0Fy', // Replace with your Stripe price ID
                'name' => 'basic_yearly',
                'title' => 'Basic Plan - Yearly',
                'description' => 'Save money by paying yearly for basic access to features. Perfect for those who want reliable, cost-effective access over time.',
                'billing_period' => 'yearly',
                'currency' => 'usd',
                'price' => 500, // Amount in cents
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ],
            [
                'product_id' => $productId,
                'stripe_price_id' => 'price_1PuSMMIt323uYS05fgrIucJv', // Replace with your Stripe price ID
                'name' => 'standard_yearly',
                'title' => 'Standard Plan - Yearly',
                'description' => 'The best value for small businesses that need ongoing access to all features and support, with added savings on a yearly plan.',
                'billing_period' => 'yearly',
                'currency' => 'usd',
                'price' => 1000, // Amount in cents
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ],
            [
                'product_id' => $productId,
                'stripe_price_id' => 'price_1PuSMVIt323uYS05merH1QNX', // Replace with your Stripe price ID
                'name' => 'premium_yearly',
                'title' => 'Premium Plan - Yearly',
                'description' => 'Ideal for teams that need full access to all features with premium support, offered at a discount for annual commitments.',
                'billing_period' => 'yearly',
                'currency' => 'usd',
                'price' => 2000, // Amount in cents
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ],
            [
                'product_id' => $productId,
                'stripe_price_id' => 'price_1PuSMrIt323uYS05p5Li5Cdn', // Replace with your Stripe price ID
                'name' => 'enterprise_yearly',
                'title' => 'Enterprise Plan - Yearly',
                'description' => 'For large organizations, this plan provides full access to all features with enterprise support and a dedicated account manager, at a yearly rate.',
                'billing_period' => 'yearly',
                'currency' => 'usd',
                'price' => 2500, // Amount in cents
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ],
        ]);
    }
}
