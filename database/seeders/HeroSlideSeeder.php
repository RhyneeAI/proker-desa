<?php

namespace Database\Seeders;

use App\Models\HeroSlide;
use Illuminate\Database\Seeder;

class HeroSlideSeeder extends Seeder
{
    public function run(): void
    {
        $slides = [
            [
                'title' => 'Selamat Datang di Desa Cibulakan',
                'subtitle' => 'Sumber informasi resmi tentang pemerintahan dan pelayanan desa',
                'image' => null,
                'sort_order' => 1,
            ],
            [
                'title' => 'Bersama Membangun Desa',
                'subtitle' => 'Partisipasi warga untuk kemajuan Desa Cibulakan',
                'image' => null,
                'sort_order' => 2,
            ],
            [
                'title' => 'Potensi & Produk Unggulan',
                'subtitle' => 'Mengenal lebih dekat potensi desa yang kami miliki',
                'image' => null,
                'sort_order' => 3,
            ],
        ];

        foreach ($slides as $slide) {
            HeroSlide::firstOrCreate(
                ['title' => $slide['title']],
                $slide
            );
        }
    }
}
