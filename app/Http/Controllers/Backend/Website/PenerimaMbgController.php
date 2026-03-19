<?php

namespace App\Http\Controllers\Backend\Website;

use App\Http\Controllers\Controller;
use App\Models\PenerimaMbg;
use App\Models\Warga;
use Illuminate\Http\Request;

class PenerimaMbgController extends Controller
{
    public function index()
    {
        $data = PenerimaMbg::with('warga')->get();
        return view('backend.website.mbg.index', compact('data'));
    }

    public function create()
    {
        $warga = Warga::where('status_warga', 'Aktif')->get();
        return view('backend.website.mbg.create', compact('warga'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'warga_id' => 'required',
            'kategori' => 'required',
        ]);

        PenerimaMbg::create([
            'warga_id' => $request->warga_id,
            'kategori' => $request->kategori,
            'tanggal_mulai' => $request->tanggal_mulai,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('backend.website.mbg.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $data = PenerimaMbg::findOrFail($id);
        $warga = Warga::all();

        return view('backend.website.mbg.edit', compact('data', 'warga'));
    }

    public function update(Request $request, $id)
    {
        $data = PenerimaMbg::findOrFail($id);

        $data->update([
            'warga_id' => $request->warga_id,
            'kategori' => $request->kategori,
            'tanggal_mulai' => $request->tanggal_mulai,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('backend.website.mbg.index')->with('success', 'Data berhasil diupdate');
    }

    public function destroy($id)
    {
        $data = PenerimaMbg::findOrFail($id);
        $data->delete();

        return redirect()->route('backend.website.mbg.index')->with('success', 'Data berhasil dihapus');
    }
}