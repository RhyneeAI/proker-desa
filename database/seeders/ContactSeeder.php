<?php

namespace Database\Seeders;

use App\Models\Contact;
use Illuminate\Database\Seeder;

class ContactSeeder extends Seeder
{
    public function run(): void
    {
        Contact::updateOrCreate(
            ['id' => 1],
            [
                'address' => 'Desa Cibulakan, Kecamatan Cugenang, Kabupaten Cianjur, Jawa Barat 43252',
                'phone' => '0263123456',
                'whatsapp' => '0878-9147-2177',
                'email' => 'desacibulakan@example.com',
                'office_hours' => 'Senin–Jumat, 08:00–15:00 WIB',
            ]
        );
    }
}
