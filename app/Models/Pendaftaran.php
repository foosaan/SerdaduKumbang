<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nama_lengkap',
        'jenis_kelamin',
        'email',
        'no_hp',
        'asal_instansi',
        'tanggal_lahir',
        'alamat',
        // Dokumen
        'cv',
        'follow_ig',
        'follow_tiktok',
        'portofolio',
        // Divisi
        'sumber_info',
        'motivasi',
        'pilihan_1',
        'alasan_1',
        'pilihan_2',
        'alasan_2',
        'bersedia_divisi_lain',
        // Status
        'berkas',
        'status',
        'alasan',
        'gelombang',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'bersedia_divisi_lain' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
