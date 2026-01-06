<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StatusForm extends Model
{
        protected $fillable = [
        'status',
        'tanggal_buka',
        'tanggal_tutup',
        'gelombang_aktif'
    ];
}
