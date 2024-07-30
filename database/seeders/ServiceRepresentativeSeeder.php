<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ServiceRepresentative;

class ServiceRepresentativeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ServiceRepresentative::factory()->count(10)->create();
    }
}
