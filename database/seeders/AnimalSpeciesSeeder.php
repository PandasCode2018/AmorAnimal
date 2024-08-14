<?php

namespace Database\Seeders;

use App\Models\AnimalSpecies;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AnimalSpeciesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AnimalSpecies::factory(30)->create();
    }
}
