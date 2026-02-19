<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         // ✅ ADMIN (TANPA anggota)
        User::create([
            'username' => 'Admin',
            'password' => Hash::make('admin123'),
            'role' => UserRole::ADMIN,
            'anggota_id' => null, // IMPORTANT
        ]);

        // ✅ SISWA (WAJIB punya anggota)
        User::create([
            'username' => 'siswa',
            'password' => Hash::make('siswa123'),
            'role' => UserRole::SISWA,
            'anggota_id' => 1, // FK ke anggotas
        ]);
    }
}
