<?php

namespace Database\Factories;

use App\Models\Student;
use App\Models\Course;
use App\Models\Resume;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StudentInfo>
 */
class StudentInfoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $student = Student::factory()->create();

        Resume::factory()->create([
            'student_id' => $student->id,
        ]);

        return [
            'registration_number' => fake()->numerify('######'),
            'course_id' => Course::factory(),
            'student_id' => $student->id,
        ];
    }
}
