<?php

namespace App\Http\Controllers\Backend\Website;

use App\Http\Controllers\Controller;
use App\Models\Inventaris;
use Illuminate\Http\Request;

class InventarisController extends Controller
{
    public function index()
    {
        $inventaris = Inventaris::orderBy('created_at', 'desc')->get();
        return view('backend.website.inventaris.index', compact('inventaris'));
    }

    public function create()
    {
        return view('backend.website.inventaris.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required',
            'jenis' => 'required',
            'bulan' => 'required',
            'tahun' => 'required',
            'foto' => 'nullable|image|mimes:jpg,png,jpeg|max:2048'
        ]);

        //generate kode
        $prefix = $request->jenis == 'electronic' ? 'A' : 'B';

        $last = Inventaris::where('jenis', $request->jenis)
            ->where('bulan', $request->bulan)
            ->where('tahun', $request->tahun)
            ->count() + 1;

        $nomor = str_pad($last, 3, '0', STR_PAD_LEFT);
        $kode_barang = "{$prefix}-{$request->bulan}-{$request->tahun}-{$nomor}";

        //upload foto ke public/images/inventaris
        $fotoName = null;

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $fotoName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/inventaris'), $fotoName);
        }

        Inventaris::create([
            'kode_barang' => $kode_barang,
            'nama_barang' => $request->nama_barang,
            'jenis' => $request->jenis,
            'bulan' => $request->bulan,
            'tahun' => $request->tahun,
            'foto' => $fotoName,
        ]);

        return redirect()->route('backend.website.inventaris.index')
            ->with('success', 'Data inventaris berhasil ditambahkan');
    }

    public function edit(Inventaris $inventari)
    {
        return view('backend.website.inventaris.edit', compact('inventari'));
    }

    public function update(Request $request, Inventaris $inventari)
    {
        $data = $request->validate([
            'nama_barang' => 'required',
            'foto' => 'nullable|image|mimes:jpg,png,jpeg|max:2048'
        ]);

        //update foto
        if ($request->hasFile('foto')) {

            // hapus lama
            if ($inventari->foto && file_exists(public_path('images/inventaris/' . $inventari->foto))) {
                unlink(public_path('images/inventaris/' . $inventari->foto));
            }

            $file = $request->file('foto');
            $fotoName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/inventaris'), $fotoName);

            $data['foto'] = $fotoName;
        }

        $inventari->update($data);

        return redirect()->route('backend.website.inventaris.index')
            ->with('success', 'Data berhasil diupdate');
    }

    public function destroy(Inventaris $inventari)
    {
        if ($inventari->foto && file_exists(public_path('images/inventaris/' . $inventari->foto))) {
            unlink(public_path('images/inventaris/' . $inventari->foto));
        }

        $inventari->delete();

        return redirect()->route('backend.website.inventaris.index')
            ->with('success', 'Data berhasil dihapus');
    }
}
