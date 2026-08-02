<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class UmkmFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake('id_ID')->company(),
            'owner_name' => fake('id_ID')->name(),
            'category' => fake()->randomElement(['Kuliner', 'Kerajinan', 'Jasa', 'Pertanian']),
            'description' => fake('id_ID')->paragraph(),
            'phone' => fake('id_ID')->phoneNumber(),
            'address' => fake('id_ID')->address(),
            'latitude' => fake()->latitude(-6.832, -6.818),
            'longitude' => fake()->longitude(107.080, 107.110),
            'photo' => null,
            'photo_alt' => null,
        ];
    }
}
