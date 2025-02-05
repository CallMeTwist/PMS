<?php

namespace Database\Factories;

use App\Models\Patient;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Documentation>
 */
class DocumentationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'patient_id' => Patient::factory(),
            'unit_id' => Unit::factory(),
            'user_id' => User::factory(),
            'notes' => fake()->paragraph(),
        ];
    }
}
