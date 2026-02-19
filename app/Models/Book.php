<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
      use HasFactory;

    protected $fillable = [
        'nama',
        'pengarang',
        'penerbit',
        'stock',
        'tahun_terbit',
    ];

     public function orders()
    {
        return $this->hasMany(Orders::class);
    }
}
