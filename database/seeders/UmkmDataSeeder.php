<?php

namespace Database\Seeders;

use App\Models\Umkm;
use Illuminate\Database\Seeder;

class UmkmDataSeeder extends Seeder
{
    /**
     * Seed data UMKM Desa Cibulakan (dari dokumen survei).
     */
    public function run(): void
    {
        Umkm::query()->forceDelete();

        $data = [
            ['name' => 'Warung Nasi Goreng Tanjakan & Aneka Gorengan', 'owner_name' => 'Warung Nasi Goreng Tanjakan & Aneka Gorengan', 'category' => 'Kuliner', 'description' => 'Nasi Goreng, Mie Goreng, Mie Rebus Telor, Gorengan, Es Campur, Kopi Seduh.', 'address' => 'Jalan Gatot Mangkupraja Cibulakan, Kecamatan Cugenang, Kabupaten Cianjur, Jawa Barat.', 'latitude' => -6.8220783, 'longitude' => 107.1010983, 'photo' => null, 'photo_alt' => null],
            ['name' => 'Dkriuk', 'owner_name' => 'Dkriuk', 'category' => 'Lainnya', 'description' => 'Chiken', 'address' => 'Jalan Gatot Mangkupraja Cibulakan, Kecamatan Cugenang, Kabupaten Cianjur, Jawa Barat.', 'latitude' => -6.82212, 'longitude' => 107.10127, 'photo' => null, 'photo_alt' => null],
            ['name' => 'Seblak Teh Nadia', 'owner_name' => 'Seblak Teh Nadia', 'category' => 'Kuliner', 'description' => 'Aneka Seblak dan Mie Jebew', 'address' => 'Jalan Gatot Mangkupraja Cibulakan, Kecamatan Cugenang, Kabupaten Cianjur, Jawa Barat.', 'latitude' => -6.8221667, 'longitude' => 107.1014283, 'photo' => null, 'photo_alt' => null],
            ['name' => 'Cutting Stiker', 'owner_name' => 'Cutting Stiker', 'category' => 'Fashion & Jasa', 'description' => 'Jasa Kaca Film/Mobil', 'address' => 'Jalan Gatot Mangkupraja Cibulakan, Kecamatan Cugenang, Kabupaten Cianjur, Jawa Barat.', 'latitude' => -6.8198583, 'longitude' => 107.1025833, 'photo' => null, 'photo_alt' => null],
            ['name' => 'Warung Mamah Zulfan', 'owner_name' => 'Warung Mamah Zulfan', 'category' => 'Kuliner', 'description' => 'Menyediakan beberapa makanan dan minuman ringan serta sayuran', 'address' => 'Jalan Gatot Mangkupraja Cibulakan, Kecamatan Cugenang, Kabupaten Cianjur, Jawa Barat.', 'latitude' => -6.8199983, 'longitude' => 107.10276, 'photo' => null, 'photo_alt' => null],
            ['name' => 'Masakan Padang Sari Minang', 'owner_name' => 'Masakan Padang Sari Minang', 'category' => 'Kuliner', 'description' => 'Masakan Padang', 'address' => 'Jalan Gatot Mangkupraja Cibulakan, Kecamatan Cugenang, Kabupaten Cianjur, Jawa Barat.', 'latitude' => -6.8224355, 'longitude' => 107.1017719, 'photo' => null, 'photo_alt' => null],
            ['name' => 'SM Collection', 'owner_name' => 'SM Collection', 'category' => 'Fashion & Jasa', 'description' => 'Seragam Sekolah, Gamis Muslim, Kemeja Kantor', 'address' => 'No.8 Jalan Gatot Mangkupraja Cibulakan, Kecamatan Cugenang, Kabupaten Cianjur, Jawa Barat.', 'latitude' => -6.8225784, 'longitude' => 107.1019961, 'photo' => null, 'photo_alt' => null],
            ['name' => 'Material ibu deede', 'owner_name' => 'Material ibu deede', 'category' => 'Toko & Pangan', 'description' => 'Berbagai jenis perabotan', 'address' => 'Jalan Gatot Mangkupraja Cibulakan, Kecamatan Cugenang, Kabupaten Cianjur, Jawa Barat.', 'latitude' => -6.82278, 'longitude' => 107.10247, 'photo' => null, 'photo_alt' => null],
            ['name' => 'Konter', 'owner_name' => 'Konter', 'category' => 'Jasa & Layanan', 'description' => 'Kartu, Pulsa, Data, dan Token.', 'address' => 'Jalan Gatot Mangkupraja Cibulakan, Kecamatan Cugenang, Kabupaten Cianjur, Jawa Barat.', 'latitude' => -6.8227583, 'longitude' => 107.10233, 'photo' => null, 'photo_alt' => null],
            ['name' => 'Bakso dan Mie Ayam Nampol', 'owner_name' => 'Bakso dan Mie Ayam Nampol', 'category' => 'Kuliner', 'description' => 'Berbagai Jenis Bakso dan Mie Ayam', 'address' => 'Jalan Gatot Mangkupraja Cibulakan, Kecamatan Cugenang, Kabupaten Cianjur, Jawa Barat.', 'latitude' => -6.822845, 'longitude' => 107.10254, 'photo' => null, 'photo_alt' => null],
            ['name' => 'Kios Beras Lebak Wangi', 'owner_name' => 'Kios Beras Lebak Wangi', 'category' => 'Toko & Pangan', 'description' => 'Macam-macam Beras Grosir dan Eceran', 'address' => 'Jalan Gatot Mangkupraja Cibulakan, Kecamatan Cugenang, Kabupaten Cianjur, Jawa Barat.', 'latitude' => -6.8230667, 'longitude' => 107.1028817, 'photo' => null, 'photo_alt' => null],
            ['name' => 'Soto Ayam Panumbangan', 'owner_name' => 'Soto Ayam Panumbangan', 'category' => 'Kuliner', 'description' => 'Nasi Rames, Soto Ayam dan berbagai masakan lainnya.', 'address' => 'Jalan Gatot Mangkupraja Cibulakan, Kecamatan Cugenang, Kabupaten Cianjur, Jawa Barat.', 'latitude' => -6.823035, 'longitude' => 107.1029383, 'photo' => null, 'photo_alt' => null],
            ['name' => 'Bakso dan Mie Ayam Mas Solor', 'owner_name' => 'Bakso dan Mie Ayam Mas Solor', 'category' => 'Kuliner', 'description' => 'Berbagai jenis bakso dan mie ayam', 'address' => 'Jalan Gatot Mangkupraja Cibulakan, Kecamatan Cugenang, Kabupaten Cianjur, Jawa Barat.', 'latitude' => -6.8231667, 'longitude' => 107.1031817, 'photo' => null, 'photo_alt' => null],
            ['name' => 'Toko Assyifa', 'owner_name' => 'Toko Assyifa', 'category' => 'Kuliner', 'description' => 'Fotokopi, Alat Tulis, Perabotan, Kebutuhan Sekolah dan Bensin.', 'address' => 'Jalan Gatot Mangkupraja Cibulakan, Kecamatan Cugenang, Kabupaten Cianjur, Jawa Barat.', 'latitude' => -6.8235867, 'longitude' => 107.1032683, 'photo' => null, 'photo_alt' => null],
            ['name' => 'Toko Buah', 'owner_name' => 'Toko Buah', 'category' => 'Kuliner', 'description' => 'Berbagai Jenis Buah', 'address' => 'Jalan Gatot Mangkupraja Cibulakan, Kecamatan Cugenang, Kabupaten Cianjur, Jawa Barat.', 'latitude' => -6.8233, 'longitude' => 107.1035333, 'photo' => null, 'photo_alt' => null],
            ['name' => 'Martabak', 'owner_name' => 'Martabak', 'category' => 'Kuliner', 'description' => 'Martabak dengan berbagai  jenis rasa', 'address' => 'Jalan Gatot Mangkupraja Cibulakan, Kecamatan Cugenang, Kabupaten Cianjur, Jawa Barat.', 'latitude' => -6.82338, 'longitude' => 107.10359, 'photo' => null, 'photo_alt' => null],
            ['name' => 'Warung Nasi Mah Eti', 'owner_name' => 'Warung Nasi Mah Eti', 'category' => 'Kuliner', 'description' => 'ayam goreng, usus goreng, ati ampela goreng, lotek, karedok, petis banci dan masakan sunda lainnya.', 'address' => 'Jalan Gatot Mangkupraja Cibulakan, Kecamatan Cugenang, Kabupaten Cianjur, Jawa Barat.', 'latitude' => -6.8234117, 'longitude' => 107.1038233, 'photo' => null, 'photo_alt' => null],
            ['name' => 'Tiko Food', 'owner_name' => 'Tiko Food', 'category' => 'Kuliner', 'description' => 'Macam-macam Kue Basah, Seblak, dan Gorengan', 'address' => 'Jalan Gatot Mangkupraja Cibulakan, Kecamatan Cugenang, Kabupaten Cianjur, Jawa Barat.', 'latitude' => -6.8234117, 'longitude' => 107.1038233, 'photo' => null, 'photo_alt' => null],
            ['name' => 'Toko Kerupuk Panumbangan', 'owner_name' => 'Toko Kerupuk Panumbangan', 'category' => 'Kuliner', 'description' => 'Cap dua ikan, raginang, regining, kutu mayang, kicimpring, dll.', 'address' => 'Cibulakan, Kecamatan Cugenang,  Kabupaten Cianjur, Jawa Barat.', 'latitude' => -6.8234217, 'longitude' => 107.1039183, 'photo' => null, 'photo_alt' => null],
            ['name' => 'Toko Sayur Panumbangan', 'owner_name' => 'Toko Sayur Panumbangan', 'category' => 'Kuliner', 'description' => 'Berbagai sayur dan daging ayam.', 'address' => 'Cibulakan, Kecamatan Cugenang,  Kabupaten Cianjur, Jawa Barat.', 'latitude' => -6.82347, 'longitude' => 107.104105, 'photo' => null, 'photo_alt' => null],
            ['name' => 'Seblak Prasmanan Teh Eneng', 'owner_name' => 'Seblak Prasmanan Teh Eneng', 'category' => 'Kuliner', 'description' => 'Seblak prasmanan', 'address' => 'Cibulakan, Kecamatan Cugenang,  Kabupaten Cianjur, Jawa Barat.', 'latitude' => -6.8234967, 'longitude' => 107.1042267, 'photo' => null, 'photo_alt' => null],
            ['name' => 'Warung Mamah Rida', 'owner_name' => 'Warung Mamah Rida', 'category' => 'Lainnya', 'description' => 'Berbagai Aneka Jajajan', 'address' => 'Jalan Gatot Mangkupraja Cibulakan, Kecamatan Cugenang, Kabupaten Cianjur, Jawa Barat.', 'latitude' => -6.823665, 'longitude' => 107.1045367, 'photo' => null, 'photo_alt' => null],
            ['name' => 'Warung Bapak Elan', 'owner_name' => 'Warung Bapak Elan', 'category' => 'Kuliner', 'description' => 'Batagor, Culen, Cemilan', 'address' => 'Kp Cibulakan, Kecamatan Cugenang, Kabupaten Cianjur, Jawa Barat 43252', 'latitude' => -6.8266521, 'longitude' => 107.0940248, 'photo' => null, 'photo_alt' => null],
            ['name' => 'Bubur Ayam Bi Santi', 'owner_name' => 'Bubur Ayam Bi Santi', 'category' => 'Kuliner', 'description' => 'Bubur Ayam, Lotek, Karedok', 'address' => 'Kp Kawung gading Desa Cibulakan, Kecamatan Cugenang, Kabupaten Cianjur Jawa barat 43252', 'latitude' => -6.8293608, 'longitude' => 107.09301, 'photo' => null, 'photo_alt' => null],
            ['name' => 'Rumah Makan Padang', 'owner_name' => 'Rumah Makan Padang', 'category' => 'Kuliner', 'description' => 'Nasi Padang', 'address' => 'Kp Cibulakan, Kecamatan Cugenang, Kabupaten Cianjur, Jawa Barat 43252', 'latitude' => -6.8228084, 'longitude' => 107.0959659, 'photo' => null, 'photo_alt' => null],
            ['name' => 'Toko Buah Kembar Jaya', 'owner_name' => 'Toko Buah Kembar Jaya', 'category' => 'Kuliner', 'description' => 'Buah dan Jus', 'address' => 'Kp Koleberes, Desa Cibulakan, Kecamatan Cugenang, Kabupaten Cianjur, Jawa Barat 43252', 'latitude' => -6.8230898, 'longitude' => 107.0968864, 'photo' => null, 'photo_alt' => null],
            ['name' => 'Mi Ayam Mang Engkus, Warung Nasi Ibu Ani', 'owner_name' => 'Mi Ayam Mang Engkus, Warung Nasi Ibu Ani', 'category' => 'Kuliner', 'description' => 'Mi Ayam, Warung Nasi', 'address' => 'Kp Cibulakan, Kecamatan Cugenang, Kabupaten Cianjur, Jawa Barat 4325', 'latitude' => -6.8231221, 'longitude' => 107.0967038, 'photo' => null, 'photo_alt' => null],
            ['name' => 'Warung Teh Isum', 'owner_name' => 'Warung Teh Isum', 'category' => 'Kuliner', 'description' => 'Warung Cemilan,Depot Air', 'address' => 'Kp Cibulakan, Kecamatan Cugenang, Kabupten Cianjur, Jawa Barat 43252', 'latitude' => null, 'longitude' => null, 'photo' => null, 'photo_alt' => null],
        ];

        foreach ($data as $item) {
            Umkm::create($item);
        }
    }
}
