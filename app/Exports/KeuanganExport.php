<?php

namespace App\Exports;

use App\Models\Warga;
use App\Models\Iuran;
use Maatwebsite\Excel\Concerns\FromCollection;

class KeuanganExport implements FromCollection
{
    protected $rt, $bulan, $tahun;

    public function __construct($rt, $bulan = null, $tahun = null)
    {
        $this->rt = $rt;
        $this->bulan = $bulan;
        $this->tahun = $tahun ?? date('Y');
    }

    public function collection()
    {
        $data = [];

        $wargas = Warga::where('rt', $this->rt)
            ->where('status_keluarga', 'Kepala Keluarga')
            ->get();

        $totalSemua = 0;

        foreach ($wargas as $warga) {

            $query = Iuran::where('warga_id', $warga->id)
                ->where('status', 'Lunas')
                ->where('tahun', $this->tahun);

            if ($this->bulan) {
                $query->where('bulan', $this->bulan);
            }

            $total = $query->sum('jumlah');

            $totalSemua += $total;

            $data[] = [
                'Nama Warga' => $warga->nama_lengkap,
                'RT' => $warga->rt,
                'Total Bayar' => $total
            ];
        }

        $data[] = [
            'Nama Warga' => 'TOTAL',
            'RT' => '',
            'Total Bayar' => $totalSemua
        ];

        return collect($data);
    }
}
