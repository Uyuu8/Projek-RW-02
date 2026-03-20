<?php

namespace App\Exports;

use App\Models\Warga;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class WargaExport implements FromCollection, WithHeadings
{
    protected $filters;

    public function __construct($filters = [])
    {
    $this->filters = $filters;
    }

    public function collection()
    {
        $query = Warga::where('rw', '02');

        // 🔍 SEARCH
        if (!empty($this->filters['search'])) {
            $search = $this->filters['search'];
            $query->where(function ($q) use ($search) {
                $q->where('nama_lengkap', 'like', "%{$search}%")
                ->orWhere('nik', 'like', "%{$search}%")
                ->orWhere('no_kk', 'like', "%{$search}%")
                ->orWhere('status_keluarga', 'like', "%{$search}%");
            });
        }

        // RT
        if (!empty($this->filters['rt'])) {
            $query->whereIn('rt', (array) $this->filters['rt']);
        }

        // JENIS KELAMIN
        if (!empty($this->filters['jenis_kelamin'])) {
            $query->whereIn('jenis_kelamin', (array) $this->filters['jenis_kelamin']);
        }

        // STATUS WARGA
        if (!empty($this->filters['status_warga'])) {
            $query->whereIn('status_warga', (array) $this->filters['status_warga']);
        }

        // STATUS RUMAH
        if (!empty($this->filters['status_rumah'])) {
            $query->whereIn('status_rumah', (array) $this->filters['status_rumah']);
        }

        // AGAMA
        if (!empty($this->filters['agama'])) {
            $query->whereIn('agama', (array) $this->filters['agama']);
        }

        return $query->orderBy('rt')
                    ->orderBy('nama_lengkap')
                    ->get([
                        'nik',
                        'no_kk',
                        'nama_lengkap',
                        'jenis_kelamin',
                        'tempat_lahir',
                        'tanggal_lahir',
                        'rt',
                        'rw',
                        'pendidikan',
                        'agama',
                        'status_keluarga',
                        'status_perkawinan',
                        'pekerjaan',
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
            'RT',
            'RW',
            'Pendidikan',
            'Agama',
            'Status Keluarga',
            'Status Kawin',
            'Pekerjaan',
            'Status Warga',
        ];
    }
}
