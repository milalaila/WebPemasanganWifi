<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            ProvinceSeeder::class,
            RegencySeeder::class,
            DistrictSeeder::class,
        ]);
    }
}
