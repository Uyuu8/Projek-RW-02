<?php

namespace App\Http\Controllers\Backend\Website;

use App\Http\Controllers\Controller;
use App\Models\Bansos;
use Illuminate\Http\Request;

class BansosController extends Controller
{
    public function index()
    {
        $bansos = Bansos::orderBy('tahun', 'desc')->get();
        return view('backend.website.bansos.index', compact('bansos'));
    }

    public function create()
    {
        return view('backend.website.bansos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'uraian_bansos' => 'required',
            'jenis_bantuan' => 'required',
            'tahun' => 'required|digits:4',
            'diselenggarakan_oleh' => 'required',
            'disalurkan_melalui' => 'required',
            'kategori_penerima' => 'required',
        ]);

        Bansos::create($request->all());

        return redirect()
            ->route('backend.website.bansos.index')
            ->with('success', 'Data bansos berhasil ditambahkan');
    }

    public function edit($id)
    {
        $bansos = Bansos::findOrFail($id);
        return view('backend.website.bansos.edit', compact('bansos'));
    }

    public function update(Request $request, $id)
    {
        $bansos = Bansos::findOrFail($id);

        $request->validate([
            'uraian_bansos' => 'required',
            'jenis_bantuan' => 'required',
            'tahun' => 'required|digits:4',
            'diselenggarakan_oleh' => 'required',
            'disalurkan_melalui' => 'required',
            'kategori_penerima' => 'required',
        ]);

        $bansos->update($request->all());

        return redirect()
            ->route('backend.website.bansos.index')
            ->with('success', 'Data bansos berhasil diperbarui');
    }

    public function destroy($id)
    {
        Bansos::findOrFail($id)->delete();

        return redirect()
            ->route('backend.website.bansos.index')
            ->with('success', 'Data bansos berhasil dihapus');
    }
}
