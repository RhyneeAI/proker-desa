<?php

namespace Database\Seeders;

use App\Models\Potential;
use Illuminate\Database\Seeder;

class PotentialSeeder extends Seeder
{
    public function run(): void
    {
        Potential::factory()->count(6)->create();
    }
}
