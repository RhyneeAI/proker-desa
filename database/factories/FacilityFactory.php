<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class FacilityFactory extends Factory
{
    public function definition(): array
    {
        static $names = [
            'Balai Desa',
            'Puskesmas Pembantu',
            'Sekolah Dasar Negeri',
            'Posyandu',
            'Lapangan Olahraga',
            'Masjid Jami',
        ];

        return [
            'name' => fake()->unique()->randomElement($names),
            'description' => fake('id_ID')->paragraph(),
            'address' => fake('id_ID')->address(),
            'photo' => null,
            'photo_alt' => null,
            'latitude' => fake()->latitude(-8, -6),
            'longitude' => fake()->longitude(106, 108),
        ];
    }
}
