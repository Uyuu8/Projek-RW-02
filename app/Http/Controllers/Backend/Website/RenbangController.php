<?php

namespace App\Http\Controllers\Backend\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Renbang;

class RenbangController extends Controller
{

    public function index()
    {
        $renbang = Renbang::orderBy('tahun', 'desc')->get();
        return view('backend.website.renbang.index', compact('renbang'));
    }


    public function create()
    {
        return view('backend.website.renbang.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'tahun' => 'required|numeric',
            'file' => 'required|mimes:pdf|max:2048',
            'keterangan' => 'nullable'
        ]);

        $fileName = null;

        if ($request->hasFile('file')) {

            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();

            $file->move(public_path('files/renbang'), $fileName);
        }

        Renbang::create([
            'tahun' => $request->tahun,
            'file' => $fileName,
            'keterangan' => $request->keterangan
        ]);

        return redirect()->route('backend.website.renbang.index')
            ->with('success', 'Data Renbang berhasil ditambahkan');
    }


    public function edit($id)
    {
        $renbang = Renbang::findOrFail($id);
        return view('backend.website.renbang.edit', compact('renbang'));
    }


    public function update(Request $request, $id)
    {
        $renbang = Renbang::findOrFail($id);

        $request->validate([
            'tahun' => 'required|numeric',
            'file' => 'nullable|mimes:pdf|max:2048',
            'keterangan' => 'nullable'
        ]);

        $data = [
            'tahun' => $request->tahun,
            'keterangan' => $request->keterangan
        ];

        if ($request->hasFile('file')) {

            // Hapus file lama
            if ($renbang->file && file_exists(public_path('files/renbang/' . $renbang->file))) {
                unlink(public_path('files/renbang/' . $renbang->file));
            }

            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();

            $file->move(public_path('files/renbang'), $fileName);

            $data['file'] = $fileName;
        }

        $renbang->update($data);

        return redirect()->route('backend.website.renbang.index')
            ->with('success', 'Data Renbang berhasil diupdate');
    }


    public function destroy($id)
    {
        $renbang = Renbang::findOrFail($id);

        if ($renbang->file && file_exists(public_path('files/renbang/' . $renbang->file))) {
            unlink(public_path('files/renbang/' . $renbang->file));
        }

        $renbang->delete();

        return redirect()->route('backend.website.renbang.index')
            ->with('success', 'Data Renbang berhasil dihapus');
    }
}