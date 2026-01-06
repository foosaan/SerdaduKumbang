<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Informasi extends Model
{
    protected $fillable = ['judul', 'kategori', 'isi', 'gambar', 'galeri'];

    protected $casts = [
        'galeri' => 'array',
    ];
}
    