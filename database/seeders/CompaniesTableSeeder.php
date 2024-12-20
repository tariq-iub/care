<?php

namespace Database\Seeders;

use App\Models\Area;
use App\Models\Company;
use App\Models\Plant;
use Illuminate\Database\Seeder;

class CompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Company::factory(15)->create()->each(function ($company) {
            // For each company, create 10 plants
            Plant::factory(10)->create([
                'company_id' => $company->id,
            ])->each(function ($plant) {
                // For each plant, create 10 areas
                Area::factory(5)->create([
                    'plant_id' => $plant->id,
                ]);
            });
        });
    }
}
