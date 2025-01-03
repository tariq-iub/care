<?php

namespace Database\Factories;

use App\Models\DataFile;
use App\Models\Device;
use App\Models\Machine;
use App\Models\MachineVibrationLocation;
use Illuminate\Database\Eloquent\Factories\Factory;

class DataFileFactory extends Factory
{
    protected $model = DataFile::class;

    public function definition()
    {
        return [
            'file_name' => $this->faker->word . '.csv',
            'file_path' => $this->faker->filePath(),
            'device_id' => Device::inRandomOrder()->first()->id,
            'machine_id' => Machine::inRandomOrder()->first()->id,
            'vibration_location_id' => MachineVibrationLocation::inRandomOrder()->first()->id,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
