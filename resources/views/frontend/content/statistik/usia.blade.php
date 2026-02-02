@extends('layouts.frontend.page')

@section('content')
<div class="container mt-5 mb-5">

    {{-- JUDUL --}}
    <h4 class="text-center font-weight-bold">
        STATISTIK KELOMPOK USIA
    </h4>
    <p class="text-center">
        RW {{ $rw }} KELURAHAN SUKAPURA<br>
        KECAMATAN KIARACONDONG KOTA BANDUNG
    </p>

    {{-- FILTER RT --}}
    <form method="GET" class="text-center mb-4">
        <label class="font-weight-bold mr-2">Filter RT:</label>
        <select name="rt" onchange="this.form.submit()"
            class="form-control d-inline-block w-auto">
            <option value="">Semua RT</option>
            @foreach ($listRt as $rt)
                <option value="{{ $rt }}"
                    {{ request('rt') == $rt ? 'selected' : '' }}>
                    RT {{ $rt }}
                </option>
            @endforeach
        </select>
    </form>

    {{-- TABEL --}}
    <div class="table-responsive mt-4">
        <table class="table table-bordered text-center">
            <thead style="background:#FFD700;">
                <tr>
                    <th rowspan="2">RW</th>
                    <th rowspan="2">RT</th>
                    <th rowspan="2">Jumlah Warga</th>
                    <th colspan="2">Balita</th>
                    <th colspan="2">Anak-anak</th>
                    <th colspan="2">Remaja</th>
                    <th colspan="2">Dewasa</th>
                    <th colspan="2">Lansia</th>
                </tr>
                <tr>
                    <th>L</th><th>P</th>
                    <th>L</th><th>P</th>
                    <th>L</th><th>P</th>
                    <th>L</th><th>P</th>
                    <th>L</th><th>P</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($statistik as $rt => $row)
                <tr>
                    <td>{{ $rw }}</td>
                    <td>{{ $rt }}</td>
                    <td>{{ $row['jumlah'] }}</td>

                    <td>{{ $row['balita_l'] }}</td>
                    <td>{{ $row['balita_p'] }}</td>

                    <td>{{ $row['anak_l'] }}</td>
                    <td>{{ $row['anak_p'] }}</td>

                    <td>{{ $row['remaja_l'] }}</td>
                    <td>{{ $row['remaja_p'] }}</td>

                    <td>{{ $row['dewasa_l'] }}</td>
                    <td>{{ $row['dewasa_p'] }}</td>

                    <td>{{ $row['lansia_l'] }}</td>
                    <td>{{ $row['lansia_p'] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <small class="text-muted d-block mt-2">
        Keterangan: Balita (0–5), Anak-anak (6–12), Remaja (13–17),
        Dewasa (18–59), Lansia (≥60 tahun)
    </small>

    {{-- PIE CHART --}}
    <div class="chart-wrapper mt-5">
        <div class="chart-item">
            <canvas id="usiaChart"></canvas>
            <p class="chart-title">Distribusi Kelompok Usia</p>
        </div>
    </div>

</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
new Chart(document.getElementById('usiaChart'), {
    type: 'pie',
    data: {
        labels: [
            'Balita',
            'Anak-anak',
            'Remaja',
            'Dewasa',
            'Lansia'
        ],
        datasets: [{
            data: [
                {{ $total['balita'] }},
                {{ $total['anak'] }},
                {{ $total['remaja'] }},
                {{ $total['dewasa'] }},
                {{ $total['lansia'] }}
            ],
            backgroundColor: [
                '#00cfe8',
                '#28c76f',
                '#ff9f43',
                '#7367f0',
                '#ea5455'
            ]
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false
    }
});
</script>

<style>
/* wrapper center */
.chart-wrapper {
    display: flex;
    justify-content: center;
}

/* ukuran konsisten */
.chart-item {
    width: 180px;
    text-align: center;
}

.chart-item canvas {
    width: 180px !important;
    height: 180px !important;
}

.chart-title {
    margin-top: 6px;
    font-weight: bold;
    font-size: 14px;
}

/* tablet & desktop */
@media (min-width: 768px) {
    .chart-item {
        width: 260px;
    }
    .chart-item canvas {
        width: 260px !important;
        height: 260px !important;
    }
}
</style>
@endpush
