<?php

namespace Database\Seeders;

use App\Models\Wisata;
use App\Support\DefaultVillageImages;
use Illuminate\Database\Seeder;

class WisataDataSeeder extends Seeder
{
    public function run(): void
    {
        Wisata::query()->forceDelete();

        $data = [
            [
                'name' => 'Curug Cibulakan',
                'category' => 'Alam',
                'description' => "Air terjun dengan ketinggian sekitar 20 meter yang dikelilingi pepohonan rindang. Suasana yang sejuk dan asri menjadikan curug ini cocok untuk bersantai bersama keluarga.\n\nFasilitas yang tersedia berupa area parkir dan warung minuman sederhana. Disarankan membawa alas kaki yang nyaman karena medan menuju lokasi cukup menanjak.",
                'address' => 'Wilayah Desa Cibulakan, Kecamatan Cugenang, Kabupaten Cianjur, Jawa Barat',
                'opening_hours' => '08.00 - 17.00',
                'ticket_price' => 'Rp 5.000',
                'latitude' => -6.8264000,
                'longitude' => 107.0938000,
                'photo' => 'curug',
                'photo_alt' => 'Air terjun Curug Cibulakan',
            ],
            [
                'name' => 'Sawah Terasering Cibulakan',
                'category' => 'Alam',
                'description' => "Hamparan sawah berundak yang hijau dan indah, sangat cocok untuk menikmati pemandangan alam sambil menikmati udara segar pegunungan.\n\nArea ini juga menjadi lokasi favorit untuk berfoto, terutama saat pagi dan sore hari saat cahaya matahari sedang indah-indahnya.",
                'address' => 'Dusun Kampung Cibulakan, Kecamatan Cugenang, Kabupaten Cianjur, Jawa Barat',
                'opening_hours' => '24 Jam',
                'ticket_price' => 'Gratis',
                'latitude' => -6.8271000,
                'longitude' => 107.0952000,
                'photo' => 'sawah-terasering',
                'photo_alt' => 'Hamparan sawah terasering Cibulakan',
            ],
            [
                'name' => 'Pemandangan Lembah Kabut',
                'category' => 'Alam',
                'description' => "Titik pandang yang menyuguhkan panorama lembah dan perbukitan yang kerap diselimuti kabut tipis pada pagi hari. Cocok untuk menikmati ketenangan alam.\n\nLokasi ini berjarak dekat dari permukiman warga sehingga mudah dijangkau dengan kendaraan roda dua maupun roda empat.",
                'address' => 'Kampung Garogol, Desa Cibulakan, Kecamatan Cugenang, Kabupaten Cianjur, Jawa Barat',
                'opening_hours' => '24 Jam',
                'ticket_price' => 'Gratis',
                'latitude' => -6.8249000,
                'longitude' => 107.0961000,
                'photo' => 'lembah-kabut',
                'photo_alt' => 'Pemandangan lembah berkabut di Cibulakan',
            ],
            [
                'name' => 'Agrowisata Kebun Warga',
                'category' => 'Wisata Edukasi',
                'description' => "Wisata edukasi pertanian yang mengajak pengunjung mengenal berbagai tanaman perkebunan dan cara pengolahannya secara langsung bersama warga.\n\nPengunjung dapat belajar menanam, memanen, hingga mencicipi hasil olahan kebun seperti keripik dan aneka jajanan khas desa.",
                'address' => 'Kampung Kawung Gading, Desa Cibulakan, Kecamatan Cugenang, Kabupaten Cianjur, Jawa Barat',
                'opening_hours' => '08.00 - 16.00',
                'ticket_price' => 'Rp 10.000',
                'latitude' => -6.8226000,
                'longitude' => 107.0959000,
                'photo' => 'petani',
                'photo_alt' => 'Aktivitas pertanian di kebun warga',
            ],
        ];

        foreach ($data as $item) {
            $photo = $item['photo'];
            unset($item['photo']);

            $item['photo'] = DefaultVillageImages::put('wisatas', $photo);

            Wisata::create($item);
        }
    }
}
