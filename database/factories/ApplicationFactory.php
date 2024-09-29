<?php

namespace Database\Factories;

use App\Models\StudentInfo;
use App\Models\Internship;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Application>
 */
class ApplicationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'student_id' => StudentInfo::factory()->create()->student_id,
            'internship_id' => Internship::factory(),
        ];
    }
}
