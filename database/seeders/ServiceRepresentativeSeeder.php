<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ServiceRepresentative;
use Illuminate\Support\Facades\DB;

class ServiceRepresentativeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    public function run(): void
    {
        ServiceRepresentative::factory()->count(10)->create();
        $serviceReps = [
            [
                'service_rep_name' => 'Service Rep 1',
                'address' => '123 Main St',
                'city' => 'Anytown',
                'state' => 'CA',
                'zip' => '12345',
                'country' => 'USA',
                'contact_name' => 'John Doe',
                'contact_title' => 'Manager',
                'phone_number' => '123-456-7890',
                'alt_phone_number' => '123-456-7890',
                'fax_number' => '123-456-7890',
                'email' => 'test@gmail.com',
            ],
            [
                'service_rep_name' => 'Service Rep 2',
                'address' => '123 Main St',
                'city' => 'Anytown',
                'state' => 'CA',
                'zip' => '12345',
                'country' => 'USA',
                'contact_name' => 'Jane Doe',
                'contact_title' => 'Manager',
                'phone_number' => '123-456-7890',
                'alt_phone_number' => '123-456-7890',
                'fax_number' => '123-456-7890',
                'email' => 'test@gmail.com',
            ],
            ];


        DB::table('service_representatives')->insert($serviceReps);
    }
}
