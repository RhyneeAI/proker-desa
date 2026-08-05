<?php

namespace Database\Seeders;

use App\Models\HeroSlide;
use App\Support\DefaultVillageImages;
use Illuminate\Database\Seeder;

class HeroSlideSeeder extends Seeder
{
    public function run(): void
    {
        HeroSlide::query()->forceDelete();

        $slides = [
            [
                'title' => 'Selamat Datang di Desa Cibulakan',
                'subtitle' => 'Sumber informasi resmi tentang pemerintahan dan pelayanan desa',
                'image' => 'sawah-terasering',
                'sort_order' => 1,
            ],
            [
                'title' => 'Bersama Membangun Desa',
                'subtitle' => 'Partisipasi warga untuk kemajuan Desa Cibulakan',
                'image' => 'sawah-gunung',
                'sort_order' => 2,
            ],
            [
                'title' => 'Potensi & Produk Unggulan',
                'subtitle' => 'Mengenal lebih dekat potensi desa yang kami miliki',
                'image' => 'pemandangan-gunung',
                'sort_order' => 3,
            ],
        ];

        foreach ($slides as $slide) {
            $image = $slide['image'];
            unset($slide['image']);

            $slide['image'] = DefaultVillageImages::put('heroes', $image);

            HeroSlide::create($slide);
        }
    }
}
