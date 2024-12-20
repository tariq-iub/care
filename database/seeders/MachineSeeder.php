<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MachineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();

        // Define the number of entries
        $numberOfMachines = 10;
        $processPointsPerMachine = 3;
        $vibrationLocationsPerMachine = 3;

        // Seed machines
        for ($i = 1; $i <= $numberOfMachines; $i++) {
            $machineId = DB::table('machines')->insertGetId([
                'machine_name' => $faker->unique()->word . ' Machine',
                'mid_setup_id' => $faker->numberBetween(1, 5), // Assuming mid_setups have IDs from 1 to 5
                'plant_id' => $faker->numberBetween(1, 3),    // Assuming plants have IDs from 1 to 3
                'area_id' => $faker->numberBetween(1, 3),     // Assuming areas have IDs from 1 to 3
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Seed machine process points
            for ($j = 1; $j <= $processPointsPerMachine; $j++) {
                DB::table('machine_process_points')->insert([
                    'machine_id' => $machineId,
                    'point_name' => $faker->unique()->word . " Point",
                    'id_tag' => strtoupper(Str::random(8)),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            // Seed machine vibration locations
            for ($k = 1; $k <= $vibrationLocationsPerMachine; $k++) {
                DB::table('machine_vibration_locations')->insert([
                    'machine_id' => $machineId,
                    'location_name' => $faker->word . " Location",
                    'position' => $faker->randomElement(['Top', 'Bottom', 'Side']),
                    'id_tag' => strtoupper(Str::random(8)),
                    'orientation' => $faker->randomElement(['Horizontal', 'Vertical']),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
