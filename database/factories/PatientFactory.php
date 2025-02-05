<?php

namespace Database\Factories;

use App\Models\Unit;
use App\Models\Ward;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Patient>
 */
class PatientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'phone_number' => fake()->numerify('##########'),
            'address' => fake()->address(),
            'age' => fake()->numberBetween(1, 100),
            'sex' => fake()->randomElement(['male', 'female']),
            'next_of_kin' => fake()->name(),
            'tribe' => fake()->word(),
            'place_of_origin' => fake()->city(),
            'occupation' => fake()->jobTitle(),
            'religion' => fake()->word(),
            'date_of_birth' => fake()->date(),
            'unit_id' => Unit::factory(),
            'ward_id' => Ward::factory(),
            'is_in_patient' => fake()->boolean(),
            'discharge_date' => fake()->optional()->date(),
        ];
    }
}
