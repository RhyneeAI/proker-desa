<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class WaterPointFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake('id_ID')->sentence(3),
            'slug' => 'titik-air-'.fake()->unique()->numberBetween(1000, 999999),
            'description' => fake('id_ID')->paragraph(),
            'address' => fake('id_ID')->address(),
            'start_latitude' => fake()->latitude(-6.832, -6.818),
            'start_longitude' => fake()->longitude(107.080, 107.110),
            'end_latitude' => fake()->latitude(-6.832, -6.818),
            'end_longitude' => fake()->longitude(107.080, 107.110),
            'recommend_latitude' => fake()->latitude(-6.832, -6.818),
            'recommend_longitude' => fake()->longitude(107.080, 107.110),
            'direction' => fake()->randomElement(['Utara', 'Timur Laut', 'Timur', 'Tenggara', 'Selatan', 'Barat Daya', 'Barat', 'Barat Laut']),
            'documentation_photos' => null,
            'interpretation_photos' => null,
        ];
    }
}
