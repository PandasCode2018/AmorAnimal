<?php

namespace Database\Seeders;

use Ramsey\Uuid\Uuid;
use App\Models\Company;
use Faker\Factory as Faker;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        /* $company = Company::create([
            'uuid' => Uuid::uuid4()->toString(),
            'name_company' => 'PandasCode',
            'nit' => '109654896',
            'email' => 'PandasCode2018r@hotmail.com',
            'password' => bcrypt('password'),
            'end_license' => '2025-08-11',
        ]); */

        $this->call(UserSeeder::class);
    }
}
