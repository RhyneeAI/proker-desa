<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class WaterPointFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake('id_ID')->sentence(3),
            'category' => fake()->randomElement(['Sumur', 'Pompa Air', 'Mata Air', 'Hidran Umum', 'Embung', 'PAM']),
            'status' => fake()->randomElement(['Berfungsi', 'Rusak', 'Pemeliharaan']),
            'description' => fake('id_ID')->paragraph(),
            'address' => fake('id_ID')->address(),
            'latitude' => fake()->latitude(-6.832, -6.818),
            'longitude' => fake()->longitude(107.080, 107.110),
            'photo' => null,
            'photo_alt' => null,
        ];
    }
}
