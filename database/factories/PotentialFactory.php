<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PotentialFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->randomElement([
                'Kebun Teh',
                'Sawah Organik',
                'Kerajinan Anyaman',
                'Kolam Ikan',
                'Wisata Alam Curug',
                'Peternakan Sapi',
                'Perkebunan Kopi',
                'Sentra Batik',
            ]),
            'category' => fake()->randomElement(['Pertanian', 'Pariwisata', 'Kerajinan', 'Peternakan', 'Perkebunan']),
            'description' => fake('id_ID')->paragraph(),
            'photo' => null,
            'photo_alt' => null,
        ];
    }
}
