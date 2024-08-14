<?php

namespace Database\Factories;

use App\Models\Team;
use App\Models\User;
use App\Models\Company;
use Illuminate\Support\Str;
use Laravel\Jetstream\Features;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'uuid' => Str::uuid(),
            'company_id' => Company::inRandomOrder()->first()->id,
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'document_number' => $this->faker->unique()->numerify('#########'),
            'password' => Hash::make('password'),
            'phone' => '3013144793',
            'address' => $this->faker->address,
            'qualification' => $this->faker->randomElement(['PhD', 'MD', 'MSc']),
            'specialty' => $this->faker->randomElement(['Cardiology', 'Neurology', 'Dermatology']),
            'license_number' => $this->faker->unique()->bothify('LIC#####'),
            'years_experience' => $this->faker->numberBetween(1, 20),
            'profile_photo_path' => '',
            'status' => 1,
        ];
    }
}
