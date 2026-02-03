<?php

namespace App\Http\Controllers\Backend\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Warga;
use App\Models\Iuran;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\KeuanganExport;


class KeuanganController extends Controller
{
    public function index($rt)
    {
        $wargas = Warga::where('rt', $rt)
            ->where('status_keluarga', 'Kepala Keluarga')
            ->orderBy('nama_lengkap')
            ->get();

        $iurans = Iuran::where('rt', $rt)->get();

        foreach ($wargas as $warga) {

            $tunggakan = 0;

            for ($bulan = 1; $bulan <= 12; $bulan++) {

                $bayar = $iurans->where('warga_id', $warga->id)
                                ->where('bulan', $bulan)
                                ->first();

                $jatuhTempo = date('Y') . '-' . sprintf('%02d', $bulan) . '-20';
                $sekarang = date('Y-m-d');

                if (!$bayar && $sekarang > $jatuhTempo) {
                    $tunggakan++;
                }
            }

            $warga->total_tunggakan = $tunggakan * 11000;
        }

        $bulan = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember'
        ];

        return view('backend.website.keuangan.index', compact('wargas','rt','iurans','bulan'));
    }


    public function bayar(Request $request)
    {
        Iuran::updateOrCreate(
            [
                'warga_id' => $request->warga_id,
                'bulan'    => $request->bulan,
                'tahun'    => $request->tahun,
                'rt'       => $request->rt,
                'rw'       => '02'
            ],
            [
                'jumlah' => 11000,
                'status' => 'Lunas',
                'tanggal_bayar' => date('Y-m-d')
            ]
        );

        return back()->with('success', 'Pembayaran berhasil disimpan');
    }

    public function hitungTunggakan($warga_id)
    {
        $belum = Iuran::where('warga_id', $warga_id)
            ->where('status', 'Belum')
            ->count();

        return $belum * 11000;
    }

    public function exportPDF(Request $request)
    {
        $rt = $request->rt;
        $bulan = $request->bulan;
        $tahun = $request->tahun ?? date('Y');

        $wargas = Warga::where('rt', $rt)
            ->where('status_keluarga', 'Kepala Keluarga')
            ->get();

        $query = Iuran::where('rt', $rt)
            ->where('tahun', $tahun);

        if ($bulan) {
            $query->where('bulan', $bulan);
        }

        $iurans = $query->get();

        $pdf = PDF::loadView('backend.website.keuangan.export_pdf', 
            compact('wargas','iurans','rt','bulan','tahun'));

        return $pdf->download('Laporan_Keuangan_RT'.$rt.'.pdf');
    }

    public function exportExcel(Request $request)
    {
        return Excel::download(
            new \App\Exports\KeuanganExport(
                $request->rt,
                $request->bulan,
                $request->tahun
            ),
            'Keuangan_RT'.$request->rt.'.xlsx'
        );
    }

}
