<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PricingPlanFeaturesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $features = [
            ['name' => 'Feature 1', 'description' => 'Description for feature 1'],
            ['name' => 'Feature 2', 'description' => 'Description for feature 2'],
            ['name' => 'Feature 3', 'description' => 'Description for feature 3'],
            ['name' => 'Feature 4', 'description' => 'Description for feature 4'],
        ];

        DB::table('pricing_plan_features')->insert($features);
    }
}
