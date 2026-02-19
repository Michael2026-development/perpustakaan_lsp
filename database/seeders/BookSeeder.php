<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         Book::create([
            'nama' => 'Laravel Untuk Pemula',
            'pengarang' => 'Taylor Otwell',
            'penerbit' => 'Laravel Press',
            'stock' => 10,
            'tahun_terbit' => 2023,
        ]);
    }
}
