<?php

namespace Database\Seeders;

use App\Models\Official;
use Illuminate\Database\Seeder;

class OfficialDataSeeder extends Seeder
{
    public function run(): void
    {
        $officials = [
            ['name' => 'H. Ujang Sobarna, S.Sos., M.Si.', 'position' => 'Kepala Desa', 'display_order' => 1],
            ['name' => 'Dedi Mulyadi, S.E.', 'position' => 'Sekretaris Desa', 'display_order' => 2],
            ['name' => 'Asep Saepudin', 'position' => 'Kasi Pemerintahan', 'display_order' => 3],
            ['name' => 'Iis Sumiati, S.Pd.', 'position' => 'Kasi Kesejahteraan', 'display_order' => 4],
            ['name' => 'Yayan Suryana', 'position' => 'Kasi Pelayanan', 'display_order' => 5],
            ['name' => 'Rina Marlina', 'position' => 'Kaur Umum', 'display_order' => 6],
            ['name' => 'Tedi Setiawan, A.Md.', 'position' => 'Kaur Keuangan', 'display_order' => 7],
            ['name' => 'Agus Salim', 'position' => 'Kaur Perencanaan', 'display_order' => 8],
            ['name' => 'Hj. Nurhayati', 'position' => 'Kepala Dusun Cibulakan', 'display_order' => 9],
            ['name' => 'Bambang Priyono', 'position' => 'Kepala Dusun Cibukas', 'display_order' => 10],
        ];

        foreach ($officials as $official) {
            Official::updateOrCreate(
                ['name' => $official['name']],
                [
                    'position' => $official['position'],
                    'display_order' => $official['display_order'],
                ]
            );
        }
    }
}
