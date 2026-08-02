<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PotensiDesaFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake('id_ID')->sentence(2),
            'category' => fake()->randomElement(['pertanian', 'wisata', 'alam', 'ekonomi', 'budaya', 'lainnya']),
            'image' => null,
            'image_alt' => null,
            'description' => fake('id_ID')->paragraph(),
            'display_order' => fake()->numberBetween(0, 10),
        ];
    }
}
