<?php

namespace Database\Seeders;

use App\Models\WaterPoint;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class WaterPointDataSeeder extends Seeder
{
    /**
     * Seed data titik air Desa Cibulakan (dari dokumen Rekap Titik Pengukuran).
     * Koordinat Titik Rekomendasi dipakai sebagai marker pada peta.
     */
    public function run(): void
    {
        WaterPoint::query()->forceDelete();

        $data = [
            ['name' => 'Masjid Bambu al-khoir', 'slug' => null, 'start_latitude' => -6.8247031, 'start_longitude' => 107.094577, 'end_latitude' => -6.8246029, 'end_longitude' => 107.0946142, 'recommend_latitude' => -6.8246281, 'recommend_longitude' => 107.0946065, 'direction' => '26° NE', 'debit' => null, 'documentation_photos' => null, 'interpretation_photos' => null],
            ['name' => 'SDN Sukmajaya', 'slug' => null, 'start_latitude' => -6.8257986, 'start_longitude' => 107.094274, 'end_latitude' => -6.8258733, 'end_longitude' => 107.0942575, 'recommend_latitude' => -6.8259048, 'recommend_longitude' => 107.0942618, 'direction' => '203° SW', 'debit' => null, 'documentation_photos' => null, 'interpretation_photos' => null],
            ['name' => 'Masjid Nurul Hidayah', 'slug' => null, 'start_latitude' => -6.8263286, 'start_longitude' => 107.0938394, 'end_latitude' => -6.8262784, 'end_longitude' => 107.0938855, 'recommend_latitude' => -6.8263631, 'recommend_longitude' => 107.0937903, 'direction' => '22° N', 'debit' => null, 'documentation_photos' => null, 'interpretation_photos' => null],
            ['name' => 'Musholla', 'slug' => null, 'start_latitude' => -6.8273503, 'start_longitude' => 107.0936442, 'end_latitude' => -6.8272825, 'end_longitude' => 107.0935903, 'recommend_latitude' => -6.8279014, 'recommend_longitude' => 107.0935991, 'direction' => '321° NW', 'debit' => null, 'documentation_photos' => null, 'interpretation_photos' => null],
            ['name' => 'KDMP (Koperasi Desa Merah Putih) Cibulakan', 'slug' => null, 'start_latitude' => -6.8306448, 'start_longitude' => 107.0919516, 'end_latitude' => -6.8306992, 'end_longitude' => 107.0920368, 'recommend_latitude' => -6.8306802, 'recommend_longitude' => 107.0920286, 'direction' => '121° SE', 'debit' => null, 'documentation_photos' => null, 'interpretation_photos' => null],
            ['name' => 'Ponpes Miftahul Huda', 'slug' => null, 'start_latitude' => -6.8281257, 'start_longitude' => 107.0924231, 'end_latitude' => -6.8281816, 'end_longitude' => 107.092345, 'recommend_latitude' => -6.8281785, 'recommend_longitude' => 107.0923445, 'direction' => '207° SW', 'debit' => null, 'documentation_photos' => null, 'interpretation_photos' => null],
            ['name' => 'SDN Kawung Gading', 'slug' => null, 'start_latitude' => -6.8231463, 'start_longitude' => 107.0955087, 'end_latitude' => -6.8230863, 'end_longitude' => 107.0955225, 'recommend_latitude' => -6.8231412, 'recommend_longitude' => 107.0954913, 'direction' => '12.9° NNE', 'debit' => null, 'documentation_photos' => null, 'interpretation_photos' => null],
            ['name' => 'Masjid Misbahul Muttaqin', 'slug' => null, 'start_latitude' => -6.8240739, 'start_longitude' => 107.0952802, 'end_latitude' => -6.8239637, 'end_longitude' => 107.0953148, 'recommend_latitude' => -6.8239637, 'recommend_longitude' => 107.0953148, 'direction' => '34° NE', 'debit' => null, 'documentation_photos' => null, 'interpretation_photos' => null],
            ['name' => 'Paud Mawar', 'slug' => null, 'start_latitude' => -6.8260708, 'start_longitude' => 107.094683, 'end_latitude' => -6.8260041, 'end_longitude' => 107.0947509, 'recommend_latitude' => -6.8259956, 'recommend_longitude' => 107.0947426, 'direction' => '202° S', 'debit' => null, 'documentation_photos' => null, 'interpretation_photos' => null],
            ['name' => 'Masjid Adzihar', 'slug' => null, 'start_latitude' => -6.8299348, 'start_longitude' => 107.0917215, 'end_latitude' => -6.8299238, 'end_longitude' => 107.0916469, 'recommend_latitude' => -6.8299991, 'recommend_longitude' => 107.0915849, 'direction' => '34° NE', 'debit' => null, 'documentation_photos' => null, 'interpretation_photos' => null],
            ['name' => 'SDN Cibulakan', 'slug' => null, 'start_latitude' => -6.8230971, 'start_longitude' => 107.9129502, 'end_latitude' => -6.8230146, 'end_longitude' => 107.9129552, 'recommend_latitude' => -6.8230463, 'recommend_longitude' => 107.9129971, 'direction' => '17° N', 'debit' => null, 'documentation_photos' => null, 'interpretation_photos' => null],
            ['name' => 'Masjid Miftahul khoer', 'slug' => null, 'start_latitude' => -6.8233199, 'start_longitude' => 107.0975261, 'end_latitude' => -6.8233119, 'end_longitude' => 107.0975387, 'recommend_latitude' => -6.8233615, 'recommend_longitude' => 107.0975295, 'direction' => '189° S', 'debit' => null, 'documentation_photos' => null, 'interpretation_photos' => null],
            ['name' => 'Masjid Al-Barokah', 'slug' => null, 'start_latitude' => -6.8277475, 'start_longitude' => 107.0888477, 'end_latitude' => -6.8277769, 'end_longitude' => 107.0888149, 'recommend_latitude' => -6.8277769, 'recommend_longitude' => 107.0888149, 'direction' => '210° SW', 'debit' => null, 'documentation_photos' => null, 'interpretation_photos' => null],
            ['name' => 'Musholla 3 Rancapicung', 'slug' => null, 'start_latitude' => -6.8261895, 'start_longitude' => 107.0869321, 'end_latitude' => -6.8261755, 'end_longitude' => 107.0869401, 'recommend_latitude' => -6.826187, 'recommend_longitude' => 107.0869297, 'direction' => '14° N', 'debit' => null, 'documentation_photos' => null, 'interpretation_photos' => null],
            ['name' => 'Posyandu Mawar', 'slug' => null, 'start_latitude' => -6.8232524, 'start_longitude' => 107.1043526, 'end_latitude' => -6.8237923, 'end_longitude' => 107.1043412, 'recommend_latitude' => -6.8232769, 'recommend_longitude' => 107.1043212, 'direction' => '206° SW', 'debit' => null, 'documentation_photos' => null, 'interpretation_photos' => null],
            ['name' => 'Posko', 'slug' => null, 'start_latitude' => -6.8236703, 'start_longitude' => 107.1049035, 'end_latitude' => -6.8236696, 'end_longitude' => 107.1049041, 'recommend_latitude' => -6.8236977, 'recommend_longitude' => 107.1049374, 'direction' => '11° N', 'debit' => null, 'documentation_photos' => null, 'interpretation_photos' => null],
            ['name' => 'WC Umum Rancapicung', 'slug' => null, 'start_latitude' => -6.8275926, 'start_longitude' => 107.0896152, 'end_latitude' => -6.827677, 'end_longitude' => 107.089619, 'recommend_latitude' => -6.8276504, 'recommend_longitude' => 107.0896602, 'direction' => '33° NE', 'debit' => null, 'documentation_photos' => null, 'interpretation_photos' => null],
            ['name' => 'Masjid Al-barokah', 'slug' => null, 'start_latitude' => -6.8194244, 'start_longitude' => 107.1029595, 'end_latitude' => -6.8194252, 'end_longitude' => 107.1029742, 'recommend_latitude' => -6.8194144, 'recommend_longitude' => 107.1029713, 'direction' => '344° N', 'debit' => null, 'documentation_photos' => null, 'interpretation_photos' => null],
        ];

        $used = [];
        foreach ($data as $item) {
            $slug = Str::slug($item['name']);
            if (in_array($slug, $used)) {
                $slug .= '-'.(count($used) + 1);
            }
            $used[] = $slug;
            $item['slug'] = $slug;

            WaterPoint::create($item);
        }
    }
}
