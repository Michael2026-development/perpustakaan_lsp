<?php

namespace Database\Seeders;

use App\Models\anggota;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AnggotaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         anggota::create([
            'nis' => 123456,
            'nama' => 'Rayhan Firdaus',
            'kelas' => 'XI RPL 1',
            'jurusan' => 'RPL',
        ]);
    }
}
