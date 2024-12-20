<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MidSetupsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();

        // Define the number of MID setups to create
        $numberOfMidSetups = 10;

        // Seed MID setups
        for ($i = 1; $i <= $numberOfMidSetups; $i++) {
            DB::table('mid_setups')->insert([
                'title' => $faker->unique()->sentence(3), // Random title with 3 words
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
