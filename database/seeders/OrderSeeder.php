<?php

namespace Database\Seeders;

use App\Models\Orders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       Orders::create([
         'book_id' => 1,
         'anggota_id' => 1,
         'tanggal_kembali' => null,
       ]);
    }
}
