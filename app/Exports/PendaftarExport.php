<?php

namespace App\Exports;

use App\Models\Pendaftaran;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PendaftarExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Pendaftaran::select(
            'nama_lengkap',
            'jenis_kelamin',
            'email',
            'no_hp',
            'alamat',
            'status'
        )->get();
    }

    public function headings(): array
    {
        return [
            'Nama Lengkap',
            'Jenis Kelamin',
            'Email',
            'No HP',
            'Alamat',
            'Status'
        ];
    }
}
