<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Responsible>
 */
class ResponsibleFactory extends Factory
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
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'phone' => '3013147896',
            'address' => $this->faker->address,
            'document_number' => $this->faker->unique()->numerify('#########'),
            'password' => Hash::make('password'), // You can replace 'password' with any default password
        ];
    }
}
