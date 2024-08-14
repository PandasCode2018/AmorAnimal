<?php

namespace Database\Factories;

use App\Models\AnimalSpecies;
use App\Models\Company;
use App\Models\Responsible;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Animal>
 */
class AnimalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'company_id' => Company::inRandomOrder()->first()->id,
            'code_animal' => $this->faker->unique()->bothify('AN-###-###'),
            'responsible_id' => Responsible::inRandomOrder()->first()->id ?? 1, 
            'name' => $this->faker->name,
            'color' => $this->faker->colorName,
            'animal_species_id' => AnimalSpecies::inRandomOrder()->first()->id,
            'animal_race' => $this->faker->randomElement(['Siamese', 'Bulldog', 'Persian']),
            'weight' => $this->faker->randomFloat(2, 1, 100),
            'sex' => $this->faker->randomElement(['Male', 'Female']),
            'age' => $this->faker->numberBetween(1, 15),
            'blood_type' => $this->faker->randomElement(['A', 'B', 'AB', 'O']),
            'microchip_code' => $this->faker->unique()->bothify('MC-###-###'),
            'photo' => $this->faker->imageUrl(640, 480, 'animals', true, 'Faker'),
            'user_id' => User::inRandomOrder()->first()->id,
        ];
    }
}
