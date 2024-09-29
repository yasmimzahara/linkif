<?php

namespace Database\Factories;

use App\Models\StudentInfo;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'password' => Hash::make('123456'),
            'email' => fake()->unique()->safeEmail(),
            'type' => 'student',
        ];
    }
}
