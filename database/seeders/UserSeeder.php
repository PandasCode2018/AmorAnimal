<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $faker = Faker::create();

        foreach (range(1, 10) as $index) {
            DB::table('users')->insert([
                'uuid' => Str::uuid(),
                'company_id' => 1,
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'document_number' => $faker->unique()->numerify('#########'),
                'password' => Hash::make('password'),
                'phone' => '3013144793',
                'address' => $faker->address,
                'qualification' => $faker->randomElement(['PhD', 'MD', 'MSc']),
                'specialty' => $faker->randomElement(['Cardiology', 'Neurology', 'Dermatology']),
                'license_number' => $faker->unique()->bothify('LIC#####'),
                'years_experience' => $faker->numberBetween(1, 20),
                'profile_photo_path' => '',
                'status' => 1,
            ]);
        }
    }
}
