<?php

namespace App\Exports;

use App\Models\Warga;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class WargaExport implements FromCollection, WithHeadings
{
    protected $rt;

    public function __construct($rt = null)
    {
        $this->rt = $rt;
    }

    public function collection()
    {
        return Warga::when($this->rt, function ($query) {
            $query->where('rt', $this->rt);
        })->get([
            'nik',
            'no_kk',
            'nama_lengkap',
            'jenis_kelamin',
            'tempat_lahir',
            'tanggal_lahir',
            'alamat',
            'rt',
            'rw',
            'pendidikan',
            'agama',
            'status_keluarga',
            'status_perkawinan',
            'pekerjaan',
            'no_hp',
            'status_warga'
        ]);
    }

    public function headings(): array
    {
        return [
            'NIK',
            'No KK',
            'Nama Lengkap',
            'Jenis Kelamin',
            'Tempat Lahir',
            'Tanggal Lahir',
            'Alamat',
            'RT',
            'RW',
            'Pendidikan',
            'Agama',
            'Status Keluarga',
            'Status Kawin',
            'Pekerjaan',
            'No HP',
            'Status Warga',
        ];
    }
}
