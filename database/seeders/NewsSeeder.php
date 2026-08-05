<?php

namespace Database\Seeders;

use App\Models\News;
use App\Support\DefaultVillageImages;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class NewsSeeder extends Seeder
{
    public function run(): void
    {
        News::query()->forceDelete();

        $data = [
            [
                'title' => 'Gotong Royong Bersih Desa Sambut HUT Ke-81 Kemerdekaan RI',
                'content' => "Pemerintah Desa Cibulakan bersama warga menggelar kegiatan gotong royong membersihkan lingkungan desa dalam rangka menyambut Hari Ulang Tahun Ke-81 Kemerdekaan Republik Indonesia.\n\nKegiatan dimulai pukul 07.00 WIB dan melibatkan puluhan warga dari berbagai kampung. Mereka bergotong royong membersihkan selokan, memangkas rumput di tepi jalan, serta merapikan area lapangan desa.\n\nKepala Desa Cibulakan menyampaikan apresiasi atas antusiasme warga. \"Semangat gotong royong inilah yang menjadi modal utama kemajuan desa kita,\" ujarnya.\n\nSelain membersihkan lingkungan, warga juga mulai memasang berbagai hiasan dan umbul-umbul merah putih di sepanjang jalan utama desa.",
                'thumbnail' => 'sawah-gunung',
                'thumbnail_alt' => 'Warga bergotong royong di lingkungan Desa Cibulakan',
                'published_at' => now()->subDays(3),
            ],
            [
                'title' => 'Panen Raya Padi Sawah Cibulakan Membawa Harapan Baru',
                'content' => "Musim panen raya padi tiba di sawah Desa Cibulakan. Para petani tampak sumringah karena hasil panen tahun ini cukup melimpah.\n\nKelompok tani Desa Cibulakan mencatat produksi gabah kering panen yang memuaskan. Keberhasilan ini tidak lepas dari pengelolaan irigasi yang baik serta pemupukan yang tepat waktu.\n\nKepala kelompok tani berharap hasil panen ini dapat meningkatkan kesejahteraan petani dan ketahanan pangan desa.\n\nPemerintah desa juga berencana memfasilitasi pemasaran hasil panen agar petani memperoleh harga yang lebih baik.",
                'thumbnail' => 'sawah-terasering',
                'thumbnail_alt' => 'Sawah padi yang siap dipanen di Desa Cibulakan',
                'published_at' => now()->subDays(6),
            ],
            [
                'title' => 'Pembangunan Jalan Desa Cibulakan Terus Berjalan Lancar',
                'content' => "Pembangunan infrastruktur jalan di Desa Cibulakan terus berjalan lancar. Pengerjaan yang meliputi pengaspalan dan perkerasan jalan lingkungan ini ditargetkan selesai akhir bulan.\n\nPembangunan jalan ini merupakan bagian dari program prioritas pemerintah desa untuk mempermudah mobilitas warga, khususnya akses menuju area persawahan dan fasilitas umum.\n\nWarga menyambut baik pembangunan ini. \"Kami berharap jalan yang bagus dapat mempermudah anak-anak sekolah dan kegiatan ekonomi warga,\" tutur salah seorang warga Kampung Garogol.\n\nPemerintah desa berkomitmen terus mengawal kualitas pengerjaan agar sesuai spesifikasi.",
                'thumbnail' => 'lembah-kabut',
                'thumbnail_alt' => 'Jalan desa dengan pemandangan pegunungan',
                'published_at' => now()->subDays(9),
            ],
            [
                'title' => 'Pelatihan Pengolahan Hasil Pertanian untuk Kelompok Tani',
                'content' => "Pemerintah Desa Cibulakan bekerja sama dengan penyuluh pertanian menggelar pelatihan pengolahan hasil pertanian bagi para petani dan ibu-ibu kelompok tani.\n\nPelatihan ini membahas pengolahan hasil panen menjadi produk bernilai tambah, seperti beras kemasan, keripik singkong, serta aneka olahan pisang.\n\nDengan pelatihan ini, diharapkan warga tidak hanya menjual bahan mentah, tetapi juga mampu mengolahnya menjadi produk yang lebih bernilai ekonomi.\n\nPeserta sangat antusias mengikuti setiap sesi, termasuk praktik langsung pengemasan dan penentuan harga jual produk.",
                'thumbnail' => 'petani',
                'thumbnail_alt' => 'Petani sedang memanen hasil pertanian',
                'published_at' => now()->subDays(12),
            ],
            [
                'title' => 'Posyandu Desa Gelar Imunisasi dan Pemeriksaan Rutin',
                'content' => "Posyandu Mawar 1 dan 2 menggelar kegiatan imunisasi dan pemeriksaan kesehatan rutin bagi balita dan ibu hamil di Desa Cibulakan.\n\nKegiatan ini dihadiri oleh kader posyandu, tenaga kesehatan dari puskesmas setempat, serta puluhan orang tua yang membawa buah hatinya.\n\nSelain imunisasi, kegiatan juga dilengkapi dengan penimbangan balita, pemberian makanan tambahan, serta penyuluhan mengenai gizi seimbang.\n\nPemerintah desa mengimbau seluruh warga yang memiliki balita untuk rutin mengunjungi posyandu sesuai jadwal yang telah ditentukan.",
                'thumbnail' => 'sawah-sore',
                'thumbnail_alt' => 'Kegiatan posyandu di Desa Cibulakan',
                'published_at' => now()->subDays(15),
            ],
            [
                'title' => 'Bazar UMKM Desa Cibulakan Ramaikan Peringatan Kemerdekaan',
                'content' => "Dalam rangka memeriahkan peringatan Hari Kemerdekaan, Pemerintah Desa Cibulakan menggelar bazar UMKM yang diikuti puluhan pelaku usaha lokal.\n\nBazar menampilkan beragam produk unggulan warga, mulai dari kuliner khas seperti seblak, gorengan, aneka kerupuk, hingga kerajinan dan busana.\n\nKegiatan ini menjadi ajang promosi sekaligus mendorong pertumbuhan ekonomi warga. Para pelaku UMKM menyambut positif gelaran ini.\n\nBazar berlangsung meriah dan ramai dikunjungi warga dari dalam maupun luar desa.",
                'thumbnail' => 'pasar-tradisional',
                'thumbnail_alt' => 'Suasana bazar UMKM di Desa Cibulakan',
                'published_at' => now()->subDays(18),
            ],
        ];

        foreach ($data as $item) {
            $thumbnail = $item['thumbnail'];
            unset($item['thumbnail']);

            $item['slug'] = Str::slug($item['title']);
            $item['thumbnail'] = DefaultVillageImages::put('news', $thumbnail);
            $item['is_published'] = true;

            News::create($item);
        }
    }
}
