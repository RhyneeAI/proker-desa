<?php

namespace Database\Seeders;

use App\Models\Gallery;
use App\Support\DefaultVillageImages;
use Illuminate\Database\Seeder;

class GallerySeeder extends Seeder
{
    public function run(): void
    {
        Gallery::query()->forceDelete();

        $data = [
            [
                'title' => 'Sawah Terasering Desa Cibulakan',
                'image' => 'sawah-terasering',
                'image_alt' => 'Hamparan sawah terasering di Desa Cibulakan',
                'category' => 'fasilitas',
                'description' => 'Keindahan sawah terasering yang menjadi salah satu pemandangan khas Desa Cibulakan.',
            ],
            [
                'title' => 'Pemandangan Pegunungan dari Desa',
                'image' => 'pemandangan-gunung',
                'image_alt' => 'Pemandangan pegunungan di sekitar desa',
                'category' => 'kegiatan',
                'description' => 'Pemandangan alam pegunungan yang mengelilingi wilayah Desa Cibulakan.',
            ],
            [
                'title' => 'Aktivitas Petani di Sawah',
                'image' => 'petani',
                'image_alt' => 'Petani sedang bekerja di sawah',
                'category' => 'kegiatan',
                'description' => 'Dokumentasi aktivitas para petani yang bekerja keras di sawah desa.',
            ],
            [
                'title' => 'Hutan dan Alam Sekitar Desa',
                'image' => 'hutan-desa',
                'image_alt' => 'Hutan yang masih asri di sekitar desa',
                'category' => 'lainnya',
                'description' => 'Kawasan hutan desa yang masih asri dan menjadi paru-paru lingkungan.',
            ],
            [
                'title' => 'Curug di Wilayah Desa',
                'image' => 'curug',
                'image_alt' => 'Air terjun di wilayah Desa Cibulakan',
                'category' => 'lainnya',
                'description' => 'Salah satu destinasi air terjun yang berada di sekitar wilayah desa.',
            ],
            [
                'title' => 'Suasana Pasar dan UMKM Desa',
                'image' => 'pasar-tradisional',
                'image_alt' => 'Suasana aktivitas jual beli di desa',
                'category' => 'umkm',
                'description' => 'Semarak kegiatan ekonomi warga melalui pasar dan usaha mikro desa.',
            ],
            [
                'title' => 'Senja di Pedalaman Desa',
                'image' => 'senja-pedalaman',
                'image_alt' => 'Suasana senja di pedesaan',
                'category' => 'kegiatan',
                'description' => 'Keindahan senja yang menyapa di penghujung hari di Desa Cibulakan.',
            ],
            [
                'title' => 'Sawah Saat Sore Hari',
                'image' => 'sawah-sore',
                'image_alt' => 'Sawah yang tenang di sore hari',
                'category' => 'fasilitas',
                'description' => 'Ketenteraman hamparan sawah saat sore hari di Desa Cibulakan.',
            ],
        ];

        foreach ($data as $item) {
            $image = $item['image'];
            unset($item['image']);

            $item['image'] = DefaultVillageImages::put('galleries', $image);

            Gallery::create($item);
        }
    }
}
