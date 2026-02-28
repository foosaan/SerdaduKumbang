<?php

namespace App\Exports;

use App\Models\Pendaftaran;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PendaftarExport implements FromCollection, WithHeadings, WithMapping
{
    protected $gelombang;

    public function __construct($gelombang = null)
    {
        $this->gelombang = $gelombang;
    }

    public function collection()
    {
        $query = Pendaftaran::query();

        if ($this->gelombang) {
            $query->where('gelombang', $this->gelombang);
        }

        return $query->get();
    }

    public function headings(): array
    {
        return [
            'ID pendaftaran',
            'Gelombang',
            'Nama Lengkap',
            'Jenis Kelamin',
            'Tanggal Lahir',
            'Email',
            'No WA',
            'Asal Instansi',
            'Alamat',
            'Pilihan Divisi 1',
            'Alasan Divisi 1',
            'Pilihan Divisi 2',
            'Alasan Divisi 2',
            'Bersedia Divisi Lain',
            'Motivasi Gabung',
            'Sumber Info',
            'Link CV',
            'Link Bukti Follow IG',
            'Link Bukti Follow TikTok',
            'Link Portofolio',
            'Status Berkas',
            'Status Akhir',
            'Alasan Keputusan',
            'Tanggal Daftar'
        ];
    }

    public function map($p): array
    {
        return [
            $p->id,
            $p->gelombang,
            $p->nama_lengkap,
            $p->jenis_kelamin,
            $p->tanggal_lahir ? $p->tanggal_lahir->format('Y-m-d') : '-',
            $p->email,
            $p->no_hp,
            $p->asal_instansi,
            $p->alamat,
            $p->pilihan_1,
            $p->alasan_1,
            $p->pilihan_2,
            $p->alasan_2,
            $p->bersedia_divisi_lain ? 'Ya' : 'Tidak',
            $p->motivasi,
            $p->sumber_info,
            $p->cv ? asset('storage/' . $p->cv) : '-',
            $p->follow_ig ? asset('storage/' . $p->follow_ig) : '-',
            $p->follow_tiktok ? asset('storage/' . $p->follow_tiktok) : '-',
            $p->portofolio ? asset('storage/' . $p->portofolio) : '-',
            $p->berkas ?? 'Menunggu',
            $p->status ?? 'Menunggu',
            $p->alasan ?? '-',
            $p->created_at ? $p->created_at->format('Y-m-d H:i:s') : '-'
        ];
    }
}
