<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class OfficialFactory extends Factory
{
    public function definition(): array
    {
        static $order = 1;

        $positions = [
            'Kepala Desa',
            'Sekretaris Desa',
            'Kaur Keuangan',
            'Kaur Perencanaan',
            'Kaur Umum',
            'Kasi Pemerintahan',
            'Kasi Kesejahteraan',
            'Kasi Pelayanan',
            'Kepala Dusun 1',
            'Kepala Dusun 2',
        ];

        return [
            'name' => fake('id_ID')->name(),
            'position' => fake()->unique()->randomElement($positions),
            'photo' => null,
            'photo_alt' => null,
            'display_order' => $order++,
        ];
    }
}
