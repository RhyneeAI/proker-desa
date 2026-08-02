<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class GalleryFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => fake('id_ID')->sentence(3),
            'image' => 'galleries/placeholder.jpg',
            'image_alt' => fake('id_ID')->sentence(3),
            'category' => fake()->randomElement(['kegiatan', 'fasilitas', 'umkm', 'lainnya']),
            'description' => fake('id_ID')->sentence(),
        ];
    }
}
