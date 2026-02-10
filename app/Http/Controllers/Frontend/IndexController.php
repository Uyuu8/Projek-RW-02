<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\Events;
use App\Models\ImageSlider;
use Illuminate\Http\Request;
use App\Models\KategoriBerita;
use App\Models\User;
use App\Models\Warga;
use Carbon\Carbon;
use App\Models\Inventaris;

class IndexController extends Controller
{
    public function index(Request $request)
    {

        $slider = ImageSlider::where('is_Active','0')->get();
        $event = Events::where('is_active', '0')->orderBy('created_at', 'desc')->get();
        $kategori = KategoriBerita::where('is_active', '0')->orderBy('created_at', 'desc')->get();

        $query = Berita::where('is_active', '0')->orderBy('created_at', 'desc');
        if ($request->has('kategori')) {
            $query->where('kategori_id', $request->kategori);
        }
        // Batasi jumlah berita yang diambil maksimal 8
        $berita = $query->take(8)->get();


        return view('frontend.welcome', compact(
            'slider',
            'event',
            'berita',
            'kategori'
        ));
    }


    public function kontak()
{

    return view('frontend.content.kontak');
}

public function faq()
{

    return view('frontend.content.faq');
}
public function strukturOrganisasi()
{
    return view('frontend.content.strukturOrganisasi');
}

public function kepengurusan()
{

    return view('frontend.content.kepengurusan');
}




    // Berita
    public function berita(Request $request)
    {

    $kategori = KategoriBerita::where('is_active', '0')->orderBy('created_at', 'desc')->get();
    $query = Berita::where('is_active', '0')->orderBy('created_at', 'desc');

    $selectedKategori = null;

    if ($request->has('kategori')) {
        $query->where('kategori_id', $request->kategori);
        $selectedKategori = KategoriBerita::find($request->kategori);
    }

    $berita = $query->paginate(10);

    return view('frontend.content.beritaAll', compact('berita', 'kategori', 'selectedKategori'));
    }

    // Show Detail Berita
    public function detailBerita($slug)
    {
        // Menu

        // Kategori
        $kategori = KategoriBerita::where('is_active','0')->orderBy('created_at','desc')->get();
        
        // Berita
        $beritaOther = Berita::where('is_active','0')->orderBy('created_at','desc')->get();

        $berita = Berita::where('slug',$slug)->first();
        return view('frontend.content.showBerita', compact('berita','kategori','beritaOther'));
    }


    // Events
    public function events()
    {
 
         // Berita
         $berita = Berita::where('is_active','0')->orderBy('created_at','desc')->get();
 
         $event = Events::where('is_active','0')->orderBy('created_at','desc')->get();
         return view('frontend.content.event.eventAll', compact('event','berita'));
    }


    // Detail Event
    public function detailEvent($slug)
    {
 
         // Berita
         $berita = Berita::where('is_active','0')->orderBy('created_at','desc')->get();
 
         $event = Events::where('slug',$slug)->first();
         $eventOther = Events::where('is_active','0')->orderBy('created_at','desc')->get();

         return view('frontend.content.event.detailEvent', compact('event','eventOther','berita'));
    }

    public function statistikWarga(Request $request)
{
    $rw = '02';

    $query = Warga::where('rw', $rw);

    // list RT untuk dropdown
    $listRt = Warga::where('rw', $rw)
                ->select('rt')
                ->distinct()
                ->orderBy('rt')
                ->pluck('rt');

    // filter RT
    if ($request->filled('rt')) {
        $query->where('rt', $request->rt);
    }

    $data = $query->get();

    // tabel statistik (per RT)
    $statistik = $data->groupBy('rt')->map(function ($items) {
        return [
            'jumlah' => $items->count(),
            'laki' => $items->where('jenis_kelamin', 'Laki-laki')->count(),
            'perempuan' => $items->where('jenis_kelamin', 'Perempuan')->count(),
            'tetap' => $items->where('status_warga', 'Aktif')->count(),
            'tidak_tetap' => $items->where('status_warga', 'Pindah')->count(),
        ];
    });

    // 🔥 data KHUSUS untuk chart (hasil filter)
    $chart = [
        'laki' => $data->where('jenis_kelamin', 'Laki-laki')->count(),
        'perempuan' => $data->where('jenis_kelamin', 'Perempuan')->count(),
        'tetap' => $data->where('status_warga', 'Aktif')->count(),
        'tidak_tetap' => $data->where('status_warga', 'Pindah')->count(),
    ];

    // total tabel
    $total = [
        'jumlah' => $data->count(),
        'laki' => $chart['laki'],
        'perempuan' => $chart['perempuan'],
        'tetap' => $chart['tetap'],
        'tidak_tetap' => $chart['tidak_tetap'],
    ];

    return view('frontend.content.statistik.warga', compact(
        'statistik',
        'total',
        'chart',
        'rw',
        'listRt'
    ));
}

public function statistikUsia(Request $request)
{
    $rw = '02';

    // ambil RT unik (01–08 atau dari database)
    $listRt = Warga::where('rw', $rw)
        ->select('rt')
        ->distinct()
        ->orderBy('rt')
        ->pluck('rt');

    // query dasar
    $query = Warga::where('rw', $rw);

    // FILTER RT
    if ($request->filled('rt')) {
        $query->where('rt', $request->rt);
    }

    $data = $query->get();

    // ===============================
    // STATISTIK PER RT
    // ===============================
    $statistik = $data->groupBy('rt')->map(function ($items) {

        $group = function ($from, $to = null) use ($items) {
            return $items->filter(function ($w) use ($from, $to) {
                $usia = Carbon::parse($w->tanggal_lahir)->age;
                return $to
                    ? $usia >= $from && $usia <= $to
                    : $usia >= $from;
            });
        };

        return [
            'jumlah' => $items->count(),

            'balita_l' => $group(0,5)->where('jenis_kelamin','Laki-laki')->count(),
            'balita_p' => $group(0,5)->where('jenis_kelamin','Perempuan')->count(),

            'anak_l' => $group(6,12)->where('jenis_kelamin','Laki-laki')->count(),
            'anak_p' => $group(6,12)->where('jenis_kelamin','Perempuan')->count(),

            'remaja_l' => $group(13,17)->where('jenis_kelamin','Laki-laki')->count(),
            'remaja_p' => $group(13,17)->where('jenis_kelamin','Perempuan')->count(),

            'dewasa_l' => $group(18,59)->where('jenis_kelamin','Laki-laki')->count(),
            'dewasa_p' => $group(18,59)->where('jenis_kelamin','Perempuan')->count(),

            'lansia_l' => $group(60)->where('jenis_kelamin','Laki-laki')->count(),
            'lansia_p' => $group(60)->where('jenis_kelamin','Perempuan')->count(),
        ];
    });

    // ===============================
    // TOTAL (UNTUK PIE CHART)
    // ===============================
    $total = [
        'balita' => $data->filter(fn($w)=>Carbon::parse($w->tanggal_lahir)->age <=5)->count(),
        'anak'   => $data->filter(fn($w)=>Carbon::parse($w->tanggal_lahir)->age >=6 && Carbon::parse($w->tanggal_lahir)->age <=12)->count(),
        'remaja' => $data->filter(fn($w)=>Carbon::parse($w->tanggal_lahir)->age >=13 && Carbon::parse($w->tanggal_lahir)->age <=17)->count(),
        'dewasa' => $data->filter(fn($w)=>Carbon::parse($w->tanggal_lahir)->age >=18 && Carbon::parse($w->tanggal_lahir)->age <=59)->count(),
        'lansia' => $data->filter(fn($w)=>Carbon::parse($w->tanggal_lahir)->age >=60)->count(),
    ];

    return view('frontend.content.statistik.usia', compact(
        'statistik',
        'total',
        'rw',
        'listRt'
    ));
}


public function statistikAgama(Request $request)
{
    $rw = '02';

    $query = Warga::where('rw', $rw);

    // FILTER RT
    if ($request->filled('rt')) {
        $query->where('rt', $request->rt);
    }

    $data = $query->get();

    // list RT untuk dropdown
    $listRt = Warga::where('rw', $rw)
        ->select('rt')
        ->distinct()
        ->orderBy('rt')
        ->pluck('rt');

    // statistik per RT
    $statistik = $data->groupBy('rt')->map(function ($items) {
        return [
            'jumlah'  => $items->count(),
            'islam'   => $items->where('agama','Islam')->count(),
            'kristen' => $items->where('agama','Kristen')->count(),
            'hindu'   => $items->where('agama','Hindu')->count(),
            'buddha'  => $items->where('agama','Buddha')->count(),
            'lainnya' => $items->where('agama','Lainnya')->count(),
        ];
    });

    // total keseluruhan (buat pie chart)
    $total = [
        'jumlah'  => $data->count(),
        'islam'   => $data->where('agama','Islam')->count(),
        'kristen' => $data->where('agama','Kristen')->count(),
        'hindu'   => $data->where('agama','Hindu')->count(),
        'buddha'  => $data->where('agama','Buddha')->count(),
        'lainnya' => $data->where('agama','Lainnya')->count(),
    ];

    return view('frontend.content.statistik.agama', compact(
        'rw','listRt','statistik','total'
    ));
}

public function statistikPendidikan(Request $request)
{
    $rw = '02';

    $query = Warga::where('rw', $rw);

    // FILTER RT
    if ($request->filled('rt')) {
        $query->where('rt', $request->rt);
    }

    $data = $query->get();

    // list RT untuk dropdown
    $listRt = Warga::where('rw', $rw)
        ->select('rt')
        ->distinct()
        ->orderBy('rt')
        ->pluck('rt');

    // statistik per RT
    $statistik = $data->groupBy('rt')->map(function ($items) {
        return [
            'jumlah' => $items->count(),
            'ts'  => $items->where('pendidikan','Tidak Sekolah')->count(),
            'sd'  => $items->where('pendidikan','SD')->count(),
            'smp' => $items->where('pendidikan','SMP')->count(),
            'sma' => $items->where('pendidikan','SMA/SMK')->count(),
            'd3'  => $items->where('pendidikan','D3')->count(),
            's1'  => $items->where('pendidikan','S1')->count(),
            's2'  => $items->where('pendidikan','S2')->count(),
        ];
    });

    // total keseluruhan (pie chart)
    $total = [
        'jumlah' => $data->count(),
        'ts'  => $data->where('pendidikan','Tidak Sekolah')->count(),
        'sd'  => $data->where('pendidikan','SD')->count(),
        'smp' => $data->where('pendidikan','SMP')->count(),
        'sma' => $data->where('pendidikan','SMA/SMK')->count(),
        'd3'  => $data->where('pendidikan','D3')->count(),
        's1'  => $data->where('pendidikan','S1')->count(),
        's2'  => $data->where('pendidikan','S2')->count(),
    ];

    return view('frontend.content.statistik.pendidikan', compact(
        'rw','listRt','statistik','total'
    ));
}
        public function InformasiInventaris()
        {
            $inventaris = Inventaris::orderBy('created_at', 'desc')->get();
            return view('frontend.content.informasi.inventaris', compact('inventaris'));
        }

}
