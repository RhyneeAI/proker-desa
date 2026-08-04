<?php

namespace Database\Seeders;

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
            RolesAndPermissionsSeeder::class,
            UmkmDataSeeder::class,
            FacilityDataSeeder::class,
            WaterPointDataSeeder::class,
        ]);
    }
}
