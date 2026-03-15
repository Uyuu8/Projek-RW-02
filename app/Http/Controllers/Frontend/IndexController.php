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
use App\Models\Iuran;
use App\Models\Renbang;

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

    public function katapengantar()
    {

        return view('frontend.content.katapengantar');
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

        $query = Warga::where('rw', $rw)
                        ->where('status_warga', 'Aktif');;

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
        })
        ->sortKeys(SORT_NATURAL);

        //data KHUSUS untuk chart (hasil filter)
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

        // Ambil RT unik
        $listRt = Warga::where('rw', $rw)
            ->select('rt')
            ->distinct()
            ->orderBy('rt')
            ->pluck('rt');

        // Query dasar
        $query = Warga::where('rw', $rw)->orderBy('rt')
                        ->where('status_warga', 'Aktif');;

        if ($request->filled('rt')) {
            $query->where('rt', $request->rt);
        }

        $data = $query->get();

        // Tambahkan field usia sekali saja (biar tidak hitung Carbon berulang)
        $data->transform(function ($w) {
            $w->usia = Carbon::parse($w->tanggal_lahir)->age;
            return $w;
        });

        // ===============================
        // STATISTIK PER RT
        // ===============================
        $statistik = $data->groupBy('rt')
            ->map(function ($items) {

                $group = function ($from, $to = null) use ($items) {
                    return $items->filter(function ($w) use ($from, $to) {
                        return $to
                            ? $w->usia >= $from && $w->usia <= $to
                            : $w->usia >= $from;
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
            })
            ->sortKeys(SORT_NATURAL);

        // ===============================
        // TOTAL SEMUA (UNTUK BARIS JUMLAH + PIE)
        // ===============================

        $total = [
            'jumlah' => $data->count(),

            'balita_l' => $data->whereBetween('usia',[0,5])->where('jenis_kelamin','Laki-laki')->count(),
            'balita_p' => $data->whereBetween('usia',[0,5])->where('jenis_kelamin','Perempuan')->count(),

            'anak_l' => $data->whereBetween('usia',[6,12])->where('jenis_kelamin','Laki-laki')->count(),
            'anak_p' => $data->whereBetween('usia',[6,12])->where('jenis_kelamin','Perempuan')->count(),

            'remaja_l' => $data->whereBetween('usia',[13,17])->where('jenis_kelamin','Laki-laki')->count(),
            'remaja_p' => $data->whereBetween('usia',[13,17])->where('jenis_kelamin','Perempuan')->count(),

            'dewasa_l' => $data->whereBetween('usia',[18,59])->where('jenis_kelamin','Laki-laki')->count(),
            'dewasa_p' => $data->whereBetween('usia',[18,59])->where('jenis_kelamin','Perempuan')->count(),

            'lansia_l' => $data->where('usia','>=',60)->where('jenis_kelamin','Laki-laki')->count(),
            'lansia_p' => $data->where('usia','>=',60)->where('jenis_kelamin','Perempuan')->count(),
        ];

        // Total khusus untuk PIE
        $total['balita'] = $total['balita_l'] + $total['balita_p'];
        $total['anak']   = $total['anak_l'] + $total['anak_p'];
        $total['remaja'] = $total['remaja_l'] + $total['remaja_p'];
        $total['dewasa'] = $total['dewasa_l'] + $total['dewasa_p'];
        $total['lansia'] = $total['lansia_l'] + $total['lansia_p'];

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

        $query = Warga::where('rw', $rw)
                        ->where('status_warga', 'Aktif');;

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
        $statistik = $data->groupBy('rt')
        ->map(function ($items) {
            return [
                'jumlah'  => $items->count(),
                'islam'   => $items->where('agama','Islam')->count(),
                'kristen' => $items->where('agama','Kristen')->count(),
                'hindu'   => $items->where('agama','Hindu')->count(),
                'buddha'  => $items->where('agama','Buddha')->count(),
                'lainnya' => $items->where('agama','Lainnya')->count(),
            ];
        })
        ->sortKeys(SORT_NATURAL); 

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

        $query = Warga::where('rw', $rw)
                    ->where('status_warga', 'Aktif');;

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
        })
        ->sortKeys(SORT_NATURAL);

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

        public function bansos()
        {
            $bansos = \App\Models\Bansos::orderBy('tahun', 'desc')->get();
            return view('frontend.content.bansos.index', compact('bansos'));
        }

        public function renbang()
        {
            $renbang = Renbang::orderBy('tahun', 'desc')->get();
            return view('frontend.content.renbang.index', compact('renbang'));
        }

    public function keuanganHome(Request $request)
    {
        $rt = $request->rt;
        $bulanFilter = $request->bulan;

        // ================= DATA WARGA =================
        $query = Warga::where('status_keluarga', 'Kepala Keluarga')
            ->where('status_warga', 'Aktif');

        if ($rt) {
            $query->where('rt', $rt);
        }

        $wargas = $query->orderBy('nama_lengkap')->get();


        // ================= IURAN BULAN TERPILIH =================
        $iuransRaw = Iuran::when($rt, function ($q) use ($rt) {
                $q->where('rt', $rt);
            })
            ->when($bulanFilter, function ($q) use ($bulanFilter) {
                $q->where('bulan', $bulanFilter);
            })
            ->get();


        // ================= GROUP IURAN BERDASARKAN WARGA =================
        $iurans = $iuransRaw->groupBy('warga_id');


        // ================= LIST RT =================
        $listRt = Warga::select('rt')
            ->distinct()
            ->orderBy('rt')
            ->pluck('rt');


        // ================= IURAN LUNAS (UNTUK TOTAL UANG MASUK) =================
        $iuranLunas = Iuran::where('status', 'Lunas')
            ->when($rt, function ($q) use ($rt) {
                $q->where('rt', $rt);
            })
            ->when($bulanFilter, function ($q) use ($bulanFilter) {
                $q->where('bulan', $bulanFilter);
            })
            ->get();


        // ================= TOTAL KESELURUHAN =================
        $totalKeseluruhan = $iuranLunas->sum('jumlah');


        // ================= TOTAL PER RT =================
        $totalPerRt = $iuranLunas
            ->groupBy('rt')
            ->map(function ($items) {
                return $items->sum('jumlah');
            });


        return view('frontend.content.keuanganHome', compact(
            'wargas',
            'iurans',
            'listRt',
            'totalKeseluruhan',
            'totalPerRt',
            'bulanFilter'
        ));
    }



}
