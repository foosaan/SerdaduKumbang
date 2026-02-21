<?php

namespace App\Exports;

use App\Models\Pendaftaran;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PendaftarExport implements FromCollection, WithHeadings
{
    protected $gelombang;

    public function __construct($gelombang = null)
    {
        $this->gelombang = $gelombang;
    }

    public function collection()
    {
        $query = Pendaftaran::select(
            'nama_lengkap',
            'jenis_kelamin',
            'email',
            'no_hp',
            'alamat',
            'gelombang',
            'status'
        );

        if ($this->gelombang) {
            $query->where('gelombang', $this->gelombang);
        }

        return $query->get();
    }

    public function headings(): array
    {
        return [
            'Nama Lengkap',
            'Jenis Kelamin',
            'Email',
            'No HP',
            'Alamat',
            'Gelombang',
            'Status'
        ];
    }
}
