<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AnimalSpecies>
 */
class AnimalSpeciesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'company_id' => Company ::inRandomOrder()->first()->id,
            'name' => $this->faker->name,
            'status' => $this->faker->randomElement([0,1]),
        ];
    }
}
