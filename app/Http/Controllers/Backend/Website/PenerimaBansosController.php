<?php

namespace App\Http\Controllers\Backend\Website;

use App\Http\Controllers\Controller;
use App\Models\Bansos;
use App\Models\PenerimaBansos;
use App\Models\Warga;
use Illuminate\Http\Request;

class PenerimaBansosController extends Controller
{

    public function index($bansos)
    {
        $bansos = Bansos::findOrFail($bansos);

        $penerima = PenerimaBansos::with('warga')
            ->where('bansos_id',$bansos->id)
            ->get();

        $warga = Warga::all();

        return view(
            'backend.website.bansos.penerima.index',
            compact('bansos','penerima','warga')
        );
    }

    public function create($bansos_id)
    {
    $bansos = Bansos::findOrFail($bansos_id);
    $warga = Warga::all();

    return view('backend.website.bansos.penerima.create', compact('bansos','warga'));
    }



    public function store(Request $request, $bansos)
    {
        PenerimaBansos::create([
            'bansos_id' => $bansos,
            'warga_id' => $request->warga_id
        ]);

        return redirect()->back()
            ->with('success','Penerima berhasil ditambahkan');
    }



    public function destroy($bansos,$penerima)
    {
        PenerimaBansos::findOrFail($penerima)->delete();

        return redirect()->back()
            ->with('success','Penerima berhasil dihapus');
    }

}