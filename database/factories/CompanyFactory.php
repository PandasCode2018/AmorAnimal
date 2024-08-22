<?php

namespace Database\Factories;

use Ramsey\Uuid\Uuid;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'uuid' => Uuid::uuid4()->toString(),
            'name_company' => $this->faker->company,
            'nit' => $this->faker->numerify('#########'),
            'email' => $this->faker->unique()->safeEmail,
            'phone' => '3013147893',
            'end_license' => $this->faker->date('Y-m-d', '+2 years'),
            'bool_termino_codiciones' => rand(0, 1)
        ];
    }
}
