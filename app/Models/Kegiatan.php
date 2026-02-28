<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Kegiatan extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'deskripsi',
        'gambar',
        'dokumentasi',
        'lokasi',
        'tanggal',
        'waktu_mulai',
        'waktu_selesai',
        'jumlah_partisipan',
        'kategori',
    ];

    protected $casts = [
        'tanggal' => 'date',
        'dokumentasi' => 'array',
    ];

    // Auto-calculate status from date
    public function getStatusAttribute()
    {
        $today = Carbon::today();

        if ($this->tanggal->isToday()) {
            return 'Berlangsung';
        } elseif ($this->tanggal->isFuture()) {
            return 'Akan Datang';
        } else {
            return 'Selesai';
        }
    }
}
