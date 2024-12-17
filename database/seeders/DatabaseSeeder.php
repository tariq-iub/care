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
            RolesTableSeeder::class,
            UsersTableSeeder::class,
            MenuTableSeeder::class,
            SensitivityTableSeeder::class,
            TransducerTableSeeder::class,
            UnitTableSeeder::class,
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
            StripeProductsTableSeeder::class,
            StripePricingPlansTableSeeder::class,
            PricingPlanFeaturesTableSeeder::class,
            PricingPlanFeatureAssignmentsTableSeeder::class,
            MidQuestionSeeder::class,
            FaultCodesTableSeeder::class,
//            MidQuestionSeeder::class,
//            MidAnswerSeeder::class,
//            MidQuestionAnswerSeeder::class,
        ]);
    }
}
