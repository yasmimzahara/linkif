<?php

namespace Database\Factories;

use App\Models\Superintendent;
use App\Models\Course;
use App\Models\Address;
use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Internship>
 */
class InternshipFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = \Faker\Factory::create()->jobTitle();

        return [
            'requirements' => fake()->text(),
            'integration_agency' => fake()->word(),
            'course_id' => Course::factory(),
            'title' => $title,
            'workload' => fake()->numberBetween(10, 30),
            'shift' => fake()->randomElement([ 'day', 'afternoon', 'night' ]),
            'description' => $title . '. ' . fake()->text(),
            'wage' => fake()->numberBetween(100, 5_000),
            'address_id' => Address::factory(),
            'company_id' => Company::factory(),
            'expires_at' => fake()->dateTimeBetween('-1 week', '+1 year'),
        ];
    }
}
