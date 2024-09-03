<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StripeProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('stripe_products')->insert([
            'name' => 'Power Eye', // Replace with your product name
            'stripe_product_id' => 'prod_Qm0LcIy8bMgiUJ', // Replace with your Stripe product ID
            'description' => 'This is a description of your product.',
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null, // Assuming using soft deletes
        ]);
    }
}
