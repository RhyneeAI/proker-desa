<?php

namespace Database\Seeders;

use App\Models\Facility;
use Illuminate\Database\Seeder;

class FacilityDataSeeder extends Seeder
{
    /**
     * Seed data Fasilitas Umum Desa Cibulakan (dari dokumen survei).
     */
    public function run(): void
    {
        Facility::query()->forceDelete();

        $data = [
            ['name' => 'Posyandu Mawar 2', 'description' => 'Jam operasional: 08.00 – 11.00', 'address' => 'Pangkalan Ojeg Panumbangan, Kp, Jl. Gatot Mangkupraja, Cibulakan, Kec. Cugenang, Kabupaten Cianjur, Jawa Barat 43252', 'photo' => null, 'photo_alt' => null, 'latitude' => -6.8219123, 'longitude' => 107.1015243],
            ['name' => 'SD Negri Griharja', 'description' => 'Jam operasional: 08.00 – 11.00', 'address' => 'Pangkalan Ojeg Panumbangan, Kp, Jl. Gatot Mangkupraja, Cibulakan, Kec. Cugenang, Kabupaten Cianjur, Jawa Barat 43252', 'photo' => null, 'photo_alt' => null, 'latitude' => -6.8196699, 'longitude' => 107.1010707],
            ['name' => 'Posyandu Mawar 1', 'description' => 'Jam operasional: 08.00 – 11.00', 'address' => 'Cibulakan, Kec. Cugenang, Kabupaten Cianjur, Jawa Barat', 'photo' => null, 'photo_alt' => null, 'latitude' => -6.8232296, 'longitude' => 107.1043547],
            ['name' => 'Paud Al – Istiqomah', 'description' => null, 'address' => 'Dekat Cibulakan, Cugenang, Kabupaten, Jawa Barat', 'photo' => null, 'photo_alt' => null, 'latitude' => -6.8230937, 'longitude' => 107.1023682],
            ['name' => 'Madrasah Diniyah Takmiliyah Awaliyah (MDTA) Tarbiyatul Athfal', 'description' => null, 'address' => 'Dekat 54G3+HCX, Cibulakan, Cugenang, Kabupaten Cianjur, Jawa 43252', 'photo' => null, 'photo_alt' => null, 'latitude' => -6.8235472, 'longitude' => 107.1035946],
            ['name' => 'Masjid Subulunnajat', 'description' => null, 'address' => 'Jl. Gatot Mangkupraja, Cibulakan, Kec. Cugenang, Kabupaten Cianjur, Jawa Barat 43252', 'photo' => null, 'photo_alt' => null, 'latitude' => -6.822313, 'longitude' => 107.10151],
            ['name' => 'Masjid Nurulfalah', 'description' => null, 'address' => 'Kp Jl. Gatot Mangkupraja, Cibulakan, Kec. Cugenang, Kabupaten Cianjur, Jawa Barat 43252', 'photo' => null, 'photo_alt' => null, 'latitude' => -6.821402, 'longitude' => 107.101868],
            ['name' => 'Masjid Al Mubarok', 'description' => null, 'address' => 'Jl. Gatot Mangkupraja, Cibulakan, Kec. Cugenang, Kabupaten Cianjur, Jawa Barat 43252', 'photo' => null, 'photo_alt' => null, 'latitude' => -6.822313, 'longitude' => 107.10151],
            ['name' => 'Kantor Desa Cibulakan', 'description' => 'Jam operasional: Senin – Jumat -> 08.00 – 16.00', 'address' => 'Kp. Garogol, Cibulakan, Kec. Cugenang, Kabupaten Cianjur, Jawa Barat 43215', 'photo' => null, 'photo_alt' => null, 'latitude' => -6.8230404, 'longitude' => 107.0972199],
            ['name' => 'SD Negeri Cibulakan', 'description' => 'Jam operasional: Senin - Kamis -> 06.30 - 13.30, Jumat -> 06.30 - 10.27', 'address' => 'Cibulakan, Kec. Cugenang, Kabupaten Cianjur, Jawa Barat 43252', 'photo' => null, 'photo_alt' => null, 'latitude' => -6.8231167, 'longitude' => 107.0967019],
            ['name' => 'SD Negeri Kawung Gading', 'description' => 'Jam operasional: Senin - Kamis -> 06.30 - 13.30, Jumat -> 06.30 - 10.27', 'address' => 'Jl. Gatot Mangkupraja, Cibulakan, Kec. Cugenang, Kabupaten Cianjur, Jawa Barat 43215', 'photo' => null, 'photo_alt' => null, 'latitude' => -6.8225002, 'longitude' => 107.0957565],
            ['name' => 'SD Negeri Sukmajaya', 'description' => 'Jam operasional: Senin - Kamis -> 06.30 - 13.30, Jumat -> 06.30 - 10.27', 'address' => 'Cibulakan, Kec. Cugenang, Kabupaten Cianjur, Jawa Barat 43252', 'photo' => null, 'photo_alt' => null, 'latitude' => -6.8244071, 'longitude' => 107.0949717],
            ['name' => 'Yayasan Miftahul Huda Al Maarif', 'description' => 'Jam operasional: Senin – Kamis -> 07.00 – 12.00 , Sabtu -> 07.00 – 12.00', 'address' => 'Jl. Kp. Kawung Gading, RT.. 001/RW.006, Cibulakan, Kec. Cugenang, Kabupaten Cianjur, Jawa Barat 43252', 'photo' => null, 'photo_alt' => null, 'latitude' => -6.8226726, 'longitude' => 107.095944],
            ['name' => 'Lapangan Cibulakan / Posyandu', 'description' => null, 'address' => 'kec. Cibulakan, Kabupaten Cianjur, Jawa Barat 43252', 'photo' => null, 'photo_alt' => null, 'latitude' => -6.8233561, 'longitude' => 107.096243],
            ['name' => 'RA Al – Adzkiya 02', 'description' => null, 'address' => 'kec. Cibulakan, Kabupaten Cianjur, Jawa Barat 43252', 'photo' => null, 'photo_alt' => null, 'latitude' => -6.8234799, 'longitude' => 107.0954781],
            ['name' => 'Kopdes Cibulakan', 'description' => null, 'address' => 'Cibulakan, Kabupaten Cianjur, Jawa Barat', 'photo' => null, 'photo_alt' => null, 'latitude' => -6.8304304, 'longitude' => 107.09219],
            ['name' => 'Yayasan Al-Ikhlas Cibulakan', 'description' => 'Jam operasional: Setiap Hari 24 jam', 'address' => 'Jl. Gatot Mangkupraja Km.05, Cibulakan Cugenang Kabupaten Cianjur, Jawa Barat kode pos, Cibulakan, Kec. Cugenang, Kabupaten Cianjur, Jawa Barat 43252', 'photo' => null, 'photo_alt' => null, 'latitude' => -6.8243575, 'longitude' => 107.0958839],
            ['name' => 'MBG', 'description' => null, 'address' => 'RA Al - Adzkiya 02, Cibulakan, Cugenang, Cianjur Regency, West Java 43252', 'photo' => null, 'photo_alt' => null, 'latitude' => -6.8235548, 'longitude' => 107.0954246],
        ];

        foreach ($data as $item) {
            Facility::create($item);
        }
    }
}
