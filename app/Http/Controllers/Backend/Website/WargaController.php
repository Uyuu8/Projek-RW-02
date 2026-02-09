<?php

namespace App\Http\Controllers\Backend\Website;

use App\Http\Controllers\Controller;
use App\Models\Warga;
use Illuminate\Http\Request;
use PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\WargaExport;
use App\Imports\WargaImport;

class WargaController extends Controller
{
    public function index(Request $request)
    {
        // list RT tetap 01–08
        $listRt = collect(range(1, 8))->map(function ($i) {
            return sprintf('%02d', $i);
        });

        $query = Warga::where('rw', '02');

        // 🔍 SEARCH
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_lengkap', 'like', "%{$search}%")
                  ->orWhere('nik', 'like', "%{$search}%")
                  ->orWhere('no_kk', 'like', "%{$search}%");
            });
        }

        // 🏘️ FILTER RT
        if ($request->filled('rt')) {
            $query->where('rt', $request->rt);
        }

        $wargas = $query->orderBy('rt')
                        ->orderBy('nama_lengkap')
                        ->paginate(10)
                        ->withQueryString();

        return view('backend.website.warga.index', compact('wargas', 'listRt'));
    }

    public function create()
    {
        return view('backend.website.warga.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nik'             => 'required|unique:wargas,nik',
            'nama_lengkap'    => 'required',
            'tempat_lahir'    => 'required',
            'tanggal_lahir'   => 'required|date',
            'jenis_kelamin'   => 'required|in:Laki-laki,Perempuan',
            'rt'              => 'required|in:01,02,03,04,05,06,07,08',
            'status_rumah'    => 'required',
            'status_warga'    => 'required|in:Aktif,Pindah,Meninggal',
        ]);

        Warga::create([
            'nik'               => $request->nik,
            'nama_lengkap'      => $request->nama_lengkap,
            'tempat_lahir'      => $request->tempat_lahir,
            'tanggal_lahir'     => $request->tanggal_lahir,
            'jenis_kelamin'     => $request->jenis_kelamin,
            'alamat'            => $request->alamat,
            'rt'                => $request->rt,
            'rw'                => '02', // 🔒 AUTO
            'no_kk'             => $request->no_kk,
            'pendidikan'        => $request->pendidikan,
            'agama'             => $request->agama,
            'status_keluarga'   => $request->status_keluarga,
            'status_perkawinan' => $request->status_perkawinan,
            'pekerjaan'         => $request->pekerjaan,
            'no_hp'             => $request->no_hp,
            'status_rumah'      => $request->status_rumah,
            'status_warga'      => $request->status_warga,
        ]);

        return redirect()
            ->route('backend-warga.index')
            ->with('success', 'Data warga berhasil ditambahkan');
    }

    public function edit(Warga $warga)
    {
        return view('backend.website.warga.edit', compact('warga'));
    }

    public function update(Request $request, Warga $warga)
    {
        $request->validate([
            'nik'             => 'required|unique:wargas,nik,' . $warga->id,
            'nama_lengkap'    => 'required',
            'tempat_lahir'    => 'required',
            'tanggal_lahir'   => 'required|date',
            'jenis_kelamin'   => 'required|in:Laki-laki,Perempuan',
            'rt'              => 'required|in:01,02,03,04,05,06,07,08',
            'status_rumah'    => 'required',
            'status_warga'    => 'required|in:Aktif,Pindah,Meninggal',
        ]);

        $warga->update([
            'nik'               => $request->nik,
            'nama_lengkap'      => $request->nama_lengkap,
            'tempat_lahir'      => $request->tempat_lahir,
            'tanggal_lahir'     => $request->tanggal_lahir,
            'jenis_kelamin'     => $request->jenis_kelamin,
            'alamat'            => $request->alamat,
            'rt'                => $request->rt,
            'rw'                => '02', // 🔒 TETAP
            'no_kk'             => $request->no_kk,
            'pendidikan'        => $request->pendidikan,
            'agama'             => $request->agama,
            'status_keluarga'   => $request->status_keluarga,
            'status_perkawinan' => $request->status_perkawinan,
            'pekerjaan'         => $request->pekerjaan,
            'no_hp'             => $request->no_hp,
            'status_rumah'      => $request->status_rumah,
            'status_warga'      => $request->status_warga,
        ]);

        return redirect()
            ->route('backend-warga.index')
            ->with('success', 'Data warga berhasil diperbarui');
    }

    public function destroy(Warga $warga)
    {
        $warga->delete();

        return redirect()
            ->route('backend-warga.index')
            ->with('success', 'Data warga berhasil dihapus');
    }

    // ================= EXPORT =================

    public function exportPdf(Request $request)
    {
        $wargas = Warga::where('rw', '02')
            ->when($request->rt, function ($query) use ($request) {
                $query->where('rt', $request->rt);
            })
            ->orderBy('rt')
            ->orderBy('nama_lengkap')
            ->get();

        $pdf = PDF::loadView(
            'backend.website.warga.export-pdf',
            compact('wargas')
        )->setPaper('A4', 'landscape');

        return $pdf->download('data-warga-rw-02.pdf');
    }

    public function exportExcel(Request $request)
    {
        return Excel::download(
            new WargaExport($request->rt),
            'data-warga-rw-02.xlsx'
        );
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls'
        ]);

        Excel::import(new WargaImport, $request->file('file'));

        return redirect()->back()->with('success','Data warga berhasil diimport');
    }

    public function iurans()
    {
        return $this->hasMany(Iuran::class);
    }
}
