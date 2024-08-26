<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserRegistrationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        DB::table('user_registrations')->insert([
            [
                'username' => $faker->userName,
                'email' => "abdullah.me.2003@gmail.com",
                'phone_no' => $faker->phoneNumber,
                'company_name' => $faker->company,
                'company_address' => $faker->address,
                'company_city' => $faker->city,
                'company_state' => $faker->state,
                'company_zip' => $faker->postcode,
                'company_country' => $faker->country,
                'responder_id' => null,
                'remarks' => null,
                'user_created_at' => null,
                'company_registration_date' => null,
                'client_emailed' => null,
                'client_registered' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => $faker->userName,
                'email' => "abdullah.abid.02468@gmail.com",
                'phone_no' => $faker->phoneNumber,
                'company_name' => $faker->company,
                'company_address' => $faker->address,
                'company_city' => $faker->city,
                'company_state' => $faker->state,
                'company_zip' => $faker->postcode,
                'company_country' => $faker->country,
                'responder_id' => null,
                'remarks' => null,
                'user_created_at' => null,
                'company_registration_date' => null,
                'client_emailed' => null,
                'client_registered' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

//        // Insert the first 10 entries
//        for ($i = 0; $i < 10; $i++) {
//            DB::table('user_registrations')->insert([
//                'username' => $faker->userName,
//                'email' => "abdullah.abid.02468@gmail.com",
//                'phone_no' => $faker->phoneNumber,
//                'company_name' => $faker->company,
//                'company_address' => $faker->address,
//                'company_city' => $faker->city,
//                'company_state' => $faker->state,
//                'company_zip' => $faker->postcode,
//                'company_country' => $faker->country,
//                'responder_id' => null,
//                'remarks' => null,
//                'user_created_at' => null,
//                'company_registration_date' => null,
//                'client_emailed' => null,
//                'client_registered' => false,
//                'created_at' => now(),
//                'updated_at' => now(),
//            ]);
//        }
//
//        // Insert the next 10 entries
//        for ($i = 0; $i < 10; $i++) {
//            DB::table('user_registrations')->insert([
//                'username' => $faker->userName,
//                'email' => $faker->unique()->safeEmail,
//                'phone_no' => $faker->phoneNumber,
//                'company_name' => $faker->company,
//                'company_address' => $faker->address,
//                'company_city' => $faker->city,
//                'company_state' => $faker->state,
//                'company_zip' => $faker->postcode,
//                'company_country' => $faker->country,
//                'responder_id' => $faker->numberBetween(1, 50),
//                'remarks' => $faker->sentence,
//                'user_created_at' => $faker->dateTimeThisYear,
//                'company_registration_date' => null,
//                'client_emailed' => null,
//                'client_registered' => false,
//                'created_at' => now(),
//                'updated_at' => now(),
//            ]);
//        }
//
//        // Insert the next 10 entries
//        for ($i = 0; $i < 10; $i++) {
//            DB::table('user_registrations')->insert([
//                'username' => $faker->userName,
//                'email' => $faker->unique()->safeEmail,
//                'phone_no' => $faker->phoneNumber,
//                'company_name' => $faker->company,
//                'company_address' => $faker->address,
//                'company_city' => $faker->city,
//                'company_state' => $faker->state,
//                'company_zip' => $faker->postcode,
//                'company_country' => $faker->country,
//                'responder_id' => $faker->numberBetween(1, 50),
//                'remarks' => $faker->sentence,
//                'user_created_at' => $faker->dateTimeThisYear,
//                'company_registration_date' => $faker->dateTimeThisYear,
//                'client_emailed' => null,
//                'client_registered' => false,
//                'created_at' => now(),
//                'updated_at' => now(),
//            ]);
//        }
//
//        // Insert the next 10 entries
//        for ($i = 0; $i < 10; $i++) {
//            DB::table('user_registrations')->insert([
//                'username' => $faker->userName,
//                'email' => $faker->unique()->safeEmail,
//                'phone_no' => $faker->phoneNumber,
//                'company_name' => $faker->company,
//                'company_address' => $faker->address,
//                'company_city' => $faker->city,
//                'company_state' => $faker->state,
//                'company_zip' => $faker->postcode,
//                'company_country' => $faker->country,
//                'responder_id' => $faker->numberBetween(1, 50),
//                'remarks' => $faker->sentence,
//                'user_created_at' => $faker->dateTimeThisYear,
//                'company_registration_date' => $faker->dateTimeThisYear,
//                'client_emailed' => $faker->dateTimeThisYear,
//                'client_registered' => false,
//                'created_at' => now(),
//                'updated_at' => now(),
//            ]);
//        }
//
//        // Insert the next 10 entries
//        for ($i = 0; $i < 10; $i++) {
//            DB::table('user_registrations')->insert([
//                'username' => $faker->userName,
//                'email' => $faker->unique()->safeEmail,
//                'phone_no' => $faker->phoneNumber,
//                'company_name' => $faker->company,
//                'company_address' => $faker->address,
//                'company_city' => $faker->city,
//                'company_state' => $faker->state,
//                'company_zip' => $faker->postcode,
//                'company_country' => $faker->country,
//                'responder_id' => $faker->numberBetween(1, 50),
//                'remarks' => $faker->sentence,
//                'user_created_at' => $faker->dateTimeThisYear,
//                'company_registration_date' => $faker->dateTimeThisYear,
//                'client_emailed' => $faker->dateTimeThisYear,
//                'client_registered' => $faker->boolean,
//                'created_at' => now(),
//                'updated_at' => now(),
//            ]);
//        }
    }
}
