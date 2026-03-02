<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Warga;
use App\Models\User;
use App\Models\Inventaris;
use App\Models\Berita;
use App\Models\Iuran;

class HomeController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $role = $user->role;

        // Statistik dashboard
        $totalWarga = Warga::count();
        $totalUser = User::count();
        $totalInventaris = Inventaris::count();
        $totalBerita = Berita::count();
        $totalKas = Iuran::where('status','Lunas')->sum('jumlah');

        return view('backend.website.home', compact(
            'role',
            'totalWarga',
            'totalUser',
            'totalInventaris',
            'totalBerita',
            'totalKas'
        ));
    }
}