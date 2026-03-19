<?php

namespace App\Http\Controllers\Backend\Website;

use App\Http\Controllers\Controller;
use App\Models\KartuKeluarga;
use Illuminate\Http\Request;

class KartuKeluargaController extends Controller
{
    public function upload(Request $request)
{
    // VALIDASI
    $request->validate([
    'no_kk' => 'required',
    'foto_kk' => 'required|image'
]);

    // AMBIL FILE
    $file = $request->file('foto_kk');

    // BUAT NAMA FILE
    $namaFile = time() . '_' . $file->getClientOriginalName();

    // PATH TUJUAN
    $path = public_path('images/kk');

    // PINDAHKAN FILE
    $file->move($path, $namaFile);

    // SIMPAN KE DATABASE
    $kk = KartuKeluarga::updateOrCreate(
        ['no_kk' => $request->no_kk],
        ['foto_kk' => $namaFile]
    );

    // DEBUG (WAJIB COBA SEKALI)
    // dd($kk);

    return redirect()->back()->with('success', 'Upload berhasil');
}
}