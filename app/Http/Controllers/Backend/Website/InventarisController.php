<?php

namespace App\Http\Controllers\Backend\Website;

use App\Http\Controllers\Controller; // ⬅️ INI YANG KURANG
use App\Models\Inventaris;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            'foto' => 'image|mimes:jpg,png,jpeg|max:2048'
        ]);

        $prefix = $request->jenis == 'electronic' ? 'A' : 'B';

        $last = Inventaris::where('jenis', $request->jenis)
            ->where('bulan', $request->bulan)
            ->where('tahun', $request->tahun)
            ->count() + 1;

        $nomor = str_pad($last, 3, '0', STR_PAD_LEFT);

        $kode_barang = "{$prefix}-{$request->bulan}-{$request->tahun}-{$nomor}";

        $foto = null;
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto')->store('inventaris', 'public');
        }

        Inventaris::create([
            'kode_barang' => $kode_barang,
            'nama_barang' => $request->nama_barang,
            'jenis' => $request->jenis,
            'bulan' => $request->bulan,
            'tahun' => $request->tahun,
            'foto' => $foto,
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
            'foto' => 'image|mimes:jpg,png,jpeg|max:2048'
        ]);

        if ($request->hasFile('foto')) {
            if ($inventari->foto) {
                Storage::disk('public')->delete($inventari->foto);
            }
            $data['foto'] = $request->file('foto')->store('inventaris', 'public');
        }

        $inventari->update($data);

        return redirect()->route('backend.website.inventaris.index')
            ->with('success', 'Data berhasil diupdate');
    }

    public function destroy(Inventaris $inventari)
    {
        if ($inventari->foto) {
            Storage::disk('public')->delete($inventari->foto);
        }

        $inventari->delete();

        return redirect()->route('backend.website.inventaris.index')
            ->with('success', 'Data berhasil dihapus');
    }
}
