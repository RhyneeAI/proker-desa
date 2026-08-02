<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class WisataFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake('id_ID')->company().' '.fake()->randomElement(['Hutan Pinus', 'Curug', 'Situ', 'Pemandian', 'Kebun Teh', 'Kampung Budaya']),
            'category' => fake()->randomElement(['Alam', 'Budaya', 'Religi', 'Kuliner', 'Edukasi', 'Lainnya']),
            'description' => fake('id_ID')->paragraph(),
            'address' => fake('id_ID')->address(),
            'opening_hours' => '08.00 - 17.00 WIB',
            'ticket_price' => fake()->randomElement(['Gratis', 'Rp 5.000', 'Rp 10.000', 'Rp 15.000']),
            'latitude' => fake()->latitude(-8, -6),
            'longitude' => fake()->longitude(106, 108),
            'photo' => null,
            'photo_alt' => null,
        ];
    }
}
