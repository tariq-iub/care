<?php

namespace Database\Seeders;

use App\Models\Area;
use App\Models\Machine;
use App\Models\MachineProcessPoint;
use App\Models\MachineVibrationLocation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Factory;

class MachineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();

        $processPointsPerMachine = 1;
        $vibrationLocationsPerMachine = 2;

        Area::all()->each(function ($area) use ($faker, $processPointsPerMachine, $vibrationLocationsPerMachine) {
            $plant = $area->plant;
            $numberOfMachines = 3;

            for ($i = 1; $i <= $numberOfMachines; $i++) {
                $machineId = Machine::create([
                    'machine_name' => $faker->word . ' Machine ' . $area->id . '-' . uniqid(),
                    'mid_setup_id' => $faker->numberBetween(1, 5),
                    'plant_id' => $plant->id,
                    'area_id' => $area->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ])->id;

                for ($j = 1; $j <= $processPointsPerMachine; $j++) {
                    MachineProcessPoint::create([
                        'machine_id' => $machineId,
                        'point_name' => $faker->word . ' Point ' . $j,
                        'id_tag' => strtoupper(Str::random(8)),
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }

                for ($k = 1; $k <= $vibrationLocationsPerMachine; $k++) {
                    MachineVibrationLocation::create([
                        'machine_id' => $machineId,
                        'location_name' => $faker->word . ' Location ' . $k,
                        'position' => $faker->randomElement(['Top', 'Bottom', 'Side']),
                        'id_tag' => strtoupper(Str::random(8)),
                        'orientation' => $faker->randomElement(['Horizontal', 'Vertical']),
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }

            // Reset Faker's unique generator cache
            $faker->unique(true);
        });
    }
}
