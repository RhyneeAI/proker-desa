<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class HeroSlideFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => fake('id_ID')->sentence(3),
            'subtitle' => fake('id_ID')->sentence(),
            'image' => null,
            'image_alt' => fake('id_ID')->sentence(3),
            'active' => true,
            'sort_order' => fake()->numberBetween(0, 10),
        ];
    }
}
