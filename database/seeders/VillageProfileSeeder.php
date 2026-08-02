<?php

namespace Database\Seeders;

use App\Models\VillageProfile;
use Illuminate\Database\Seeder;

class VillageProfileSeeder extends Seeder
{
    public function run(): void
    {
        VillageProfile::updateOrCreate(
            ['id' => 1],
            [
                'village_name' => 'Desa Cibulakan',
                'history' => 'Desa Cibulakan berdiri sejak tahun 1945 sebagai kawasan pertanian yang subur di kaki pegunungan Jawa Barat. Seiring berjalannya waktu, desa ini berkembang menjadi desa mandiri dengan berbagai potensi ekonomi lokal.',
                'vision' => 'Mewujudkan Desa Cibulakan yang mandiri, sejahtera, dan berbudaya.',
                'mission' => 'Meningkatkan pelayanan publik yang prima, mendorong pertumbuhan ekonomi lokal, dan menjaga kelestarian lingkungan hidup.',
                'address' => 'Jl. Raya Cibulakan No. 1, Kecamatan Cianjur, Kabupaten Cianjur, Jawa Barat 43211',
                'area_size' => 12.50,
                'population' => 4520,
                'map_embed' => null,
                'border_north' => 'Desa Sukajadi',
                'border_south' => 'Desa Mekarjaya',
                'border_east' => 'Desa Ciputri',
                'border_west' => 'Desa Nagrak',
                'org_chart_image' => null,
                'bpd_chart_image' => null,
            ]
        );
    }
}
