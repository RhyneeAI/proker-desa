<?php

namespace Database\Seeders;

use App\Models\Announcement;
use App\Models\Facility;
use App\Models\Gallery;
use App\Models\News;
use App\Models\Official;
use App\Models\PotensiDesa;
use App\Models\Umkm;
use App\Models\WaterPoint;
use App\Models\Wisata;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            AdminUserSeeder::class,
            VillageProfileSeeder::class,
            ContactSeeder::class,
            PotentialSeeder::class,
        ]);

        Official::factory()->count(8)->create();
        News::factory()->count(10)->create();
        Announcement::factory()->count(5)->create();
        Umkm::factory()->count(8)->create();
        Facility::factory()->count(6)->create();
        Gallery::factory()->count(12)->create();
        PotensiDesa::factory()->count(6)->create();
        WaterPoint::factory()->count(8)->create();
        Wisata::factory()->count(6)->create();
    }
}
