<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PaketWifi;

class PaketWifiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PaketWifi::create([
            'nama_paket' => 'Paket Hemat',
            'kecepatan' => '10 Mbps',
            'harga' => 150000
        ]);

        PaketWifi::create([
            'nama_paket' => 'Paket Keluarga',
            'kecepatan' => '30 Mbps',
            'harga' => 250000
        ]);

        PaketWifi::create([
            'nama_paket' => 'Paket Gaming',
            'kecepatan' => '50 Mbps',
            'harga' => 350000
        ]);
    }
}

