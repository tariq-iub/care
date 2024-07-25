<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Unit extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        DB::table('units')->insert([
            [
                'title' => 'in',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'in/s',
                'created_at' => $now,
                'updated_at' => $now,
            ]
        ]);
    }
}
