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
                'address' => 'Jl. Raya Cibulakan No. 1, Kecamatan Cianjur, Kabupaten Cianjur, Jawa Barat 43211',
                'phone' => '0263123456',
                'whatsapp' => '081234567890',
                'email' => 'desasukamaju@example.id',
                'office_hours' => 'Senin–Jumat, 08:00–15:00 WIB',
            ]
        );
    }
}
