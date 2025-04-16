<?php

namespace Database\Seeders;

use App\Models\JenisKunjungan;
use App\Models\Obat;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Tindakan;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
            'role' => 'Admin'
        ]);

        User::factory()->create([
            'name' => 'Petugas Daftar Test',
            'email' => 'pendaftaran@gmail.com',
            'password' => bcrypt('password'),
            'role' => 'Petugas Pendaftaran'
        ]);

        User::factory()->create([
            'name' => 'Test Dokter',
            'email' => 'dokter@gmail.com',
            'password' => bcrypt('password'),
            'role' => 'Dokter'
        ]);

        User::factory()->create([
            'name' => 'Test kasir',
            'email' => 'kasir@gmail.com',
            'password' => bcrypt('password'),
            'role' => 'Kasir'
        ]);

        Obat::create([
            'name' => 'Paracetamol',
            'harga' => 2500,
            'stok' => 1000
        ]);

        Obat::create([
            'name' => 'OBH',
            'harga' => 26000,
            'stok' => 1500
        ]);

        Tindakan::create([
            'nama' => 'Cek Darah',
            'harga' => 200000
        ]);

        Tindakan::create([
            'nama' => 'Tambal Gigi',
            'harga' => 50000
        ]);

        JenisKunjungan::create([
            'nama' => 'Konsultasi',
            'harga' => 150000
        ]);

        JenisKunjungan::create([
            'nama' => 'Medical Check-Up',
            'harga' => 600000
        ]);
    }
}
