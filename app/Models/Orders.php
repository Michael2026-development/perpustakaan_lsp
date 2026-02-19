<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;

    protected $fillable = [
        'book_id',
        'anggota_id',
        'tanggal_pinjam',
        'tanggal_kembali'
    ];

    public function book(){
        return $this->belongsTo(Book::class);
    }

    public function anggota(){
        return $this->belongsTo(anggota::class);
    }


}
