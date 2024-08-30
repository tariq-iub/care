<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            Sensitivity::class,
            Transducer::class,
            Unit::class,
            RolesTableSeeder::class,
            UsersTableSeeder::class,
            ServiceRepresentativesTableSeeder::class,
            CompaniesTableSeeder::class,
            PlantsTableSeeder::class,
            AreasTableSeeder::class,
            DevicesTableSeeder::class,
            ComponentsTableSeeder::class,
            PlantServiceRepsTableSeeder::class,
            InspectionsTableSeeder::class,
            NotesTableSeeder::class,
            DataFileSeeder::class,
            UserRegistrationSeeder::class,
            MidQuestionSeeder::class,
        ]);
    }
}
