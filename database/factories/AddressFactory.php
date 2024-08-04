<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Address>
 */
class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'street' => fake()->streetName(),
            'number' => fake()->buildingNumber(),
            'zip_code' => fake()->postcode(),
            'neighborhood' => fake()->streetSuffix(),
            'city' => fake()->city(),
            'country' => fake()->country(),
            'state' => fake()->state(),
        ];
    }
}
