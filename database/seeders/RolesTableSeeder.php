<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        DB::table('roles')->insert([
            [
                'title' => 'Super Admin',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Admin',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Client',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}
