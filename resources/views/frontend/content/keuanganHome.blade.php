@extends('layouts.Frontend.page')

@section('title', 'Transparansi Keuangan')

@section('content')

<style>
/* ====== MATIKAN SEMUA ANIMASI YANG BIKIN TIMBUL ====== */
.card,
.card:hover,
.btn,
.btn:hover,
.form-control,
.form-control:focus,
.table,
.table:hover,
select,
select:hover {
    transform: none !important;
    transition: none !important;
    box-shadow: none !important;
}

/* ====== CARD FLAT ====== */
.card {
    border-radius: 12px;
    border: 1px solid #e5e7eb;
}

/* ====== TABLE SIMPLE ====== */
.table thead th {
    background: #f8fafc;
    font-weight: 600;
}

.table tbody tr:hover {
    background: #fafafa; /* hover halus, tidak timbul */
}

/* ====== FILTER BIAR RAPI ====== */
.filter-box {
    background: #ffffff;
    border: 1px solid #e5e7eb;
    border-radius: 12px;
    padding: 20px;
}

.filter-box {
    overflow: visible !important;
}

.card {
    overflow: visible !important;
}

.container,
.container-fluid {
    overflow: visible !important;
}


/* ====== RESPONSIVE ====== */
@media (max-width: 768px) {
    .filter-box .row > div {
        margin-bottom: 10px;
    }
}
</style>

<div class="container mt-5 mb-5">

    {{-- JUDUL --}}
    <h4 class="text-center font-weight-bold mb-4">
        TRANSPARANSI KEUANGAN RT
    </h4>

    {{-- ===== RINGKASAN KEUANGAN ===== --}}
    <div class="row mb-4">

        {{-- TOTAL KESELURUHAN --}}
        <div class="col-md-6 mb-3">
            <div class="card text-center">
                <div class="card-body">
                    <small class="text-muted">Total Pemasukan</small>
                    <h4 class="mb-0 text-success">
                        Rp {{ number_format($totalKeseluruhan ?? 0) }}
                    </h4>
                </div>
            </div>
        </div>

        {{-- TOTAL PER RT --}}
        <div class="col-md-6 mb-3">
            <div class="card text-center">
                <div class="card-body">
                    <small class="text-muted">Total per RT</small>

                    <div class="mt-2">
                        @forelse($totalPerRt as $rtItem => $total)
                            <div>
                                RT {{ $rtItem }} :
                                <strong>Rp {{ number_format($total) }}</strong>
                            </div>
                        @empty
                            <small class="text-muted">Belum ada data</small>
                        @endforelse
                    </div>

                </div>
            </div>
        </div>

    </div>


    {{-- FILTER --}}
    <div class="filter-box mb-4">

        <form method="GET" class="row g-2">

            {{-- FILTER RT --}}
            <div class="col-md-3">
                <select name="rt" class="form-control">
                    <option value="">Semua RT</option>
                    @foreach($listRt as $rtItem)
                        <option value="{{ $rtItem }}"
                            {{ request('rt') == $rtItem ? 'selected' : '' }}>
                            RT {{ $rtItem }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- FILTER BULAN --}}
            {{-- FILTER BULAN --}}
            <div class="col-md-3">
                <select name="bulan" class="form-control">
                    <option value="">Semua Bulan</option>

                    @php
                    $bulanList = [
                        1=>'Januari',2=>'Februari',3=>'Maret',4=>'April',
                        5=>'Mei',6=>'Juni',7=>'Juli',8=>'Agustus',
                        9=>'September',10=>'Oktober',11=>'November',12=>'Desember'
                    ];
                    @endphp

                    @foreach($bulanList as $key => $nama)
                        <option value="{{ $key }}"
                            {{ request('bulan') == $key ? 'selected' : '' }}>
                            {{ $nama }}
                        </option>
                    @endforeach
                </select>
            </div>
            

            <div class="col-md-3">
                <button class="btn btn-primary w-100">
                    Filter
                </button>
            </div>

            <div class="col-md-3">
                <a href="{{ route('frontend.keuanganHome') }}"
                   class="btn btn-secondary w-100">
                    Reset
                </a>
            </div>

        </form>

    </div>

    {{-- TABEL --}}
    <div class="card">

        <div class="card-header bg-white">
            <h5 class="mb-0">Data Pembayaran Warga</h5>
        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered align-middle">

                    <thead class="text-center">
                        <tr>
                            <th style="width:70px;">No</th>
                            <th>Nama Warga</th>
                            <th style="width:100px;">RT</th>
                            <th style="width:140px;">Status</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($wargas as $warga)

                        @php
                            $bayar = $iurans[$warga->id][0] ?? null;

                            $sekarang = date('Y-m-d');
                            $bulanCek = request('bulan') ?? date('m');
                            $jatuhTempo = date('Y') . '-' . sprintf('%02d', $bulanCek) . '-20';
                        @endphp

                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>

                            {{-- NAMA SENSOR --}}
                            <td>{{ $warga->nama_sensor }}</td>

                            <td class="text-center">RT {{ $warga->rt }}</td>

                            <td class="text-center">

                                @if($bayar && $bayar->status == 'Lunas')
                                    <span class="badge bg-success">Lunas</span>
                                @else
                                    @if($sekarang > $jatuhTempo)
                                        <span class="badge bg-danger">Tunggakan</span>
                                    @else
                                        <span class="badge bg-warning text-dark">Belum</span>
                                    @endif
                                @endif

                            </td>
                        </tr>

                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-4">
                                Tidak ada data
                            </td>
                        </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>
    </div>

</div>

@endsection
