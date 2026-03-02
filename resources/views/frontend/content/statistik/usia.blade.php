@extends('layouts.Frontend.page')

@section('content')
<div class="container mt-5 mb-5">

    {{-- ================= JUDUL ================= --}}
    <h4 class="text-center font-weight-bold">
        STATISTIK KELOMPOK USIA
    </h4>
    <p class="text-center">
        RW {{ $rw }} KELURAHAN SUKAPURA<br>
        KECAMATAN KIARACONDONG KOTA BANDUNG
    </p>

    {{-- ================= FILTER RT ================= --}}
    <form method="GET" class="text-center mb-4">
        <label class="font-weight-bold mr-2">Filter RT:</label>
        <select name="rt"
                onchange="this.form.submit()"
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

    {{-- ================= TABEL ================= --}}
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
                @forelse ($statistik as $rt => $row)
                <tr>
                    <td>{{ $rw }}</td>
                    <td>{{ $rt }}</td>
                    <td>{{ $row['jumlah'] ?? 0 }}</td>

                    <td>{{ $row['balita_l'] ?? 0 }}</td>
                    <td>{{ $row['balita_p'] ?? 0 }}</td>

                    <td>{{ $row['anak_l'] ?? 0 }}</td>
                    <td>{{ $row['anak_p'] ?? 0 }}</td>

                    <td>{{ $row['remaja_l'] ?? 0 }}</td>
                    <td>{{ $row['remaja_p'] ?? 0 }}</td>

                    <td>{{ $row['dewasa_l'] ?? 0 }}</td>
                    <td>{{ $row['dewasa_p'] ?? 0 }}</td>

                    <td>{{ $row['lansia_l'] ?? 0 }}</td>
                    <td>{{ $row['lansia_p'] ?? 0 }}</td>
                </tr>
                @empty
                {{-- <tr>
                    <td colspan="13">Data tidak tersedia</td>
                </tr> --}}
                @endforelse

                {{-- ================= TOTAL ================= --}}
                <tr class="font-weight-bold bg-light">
                    <td colspan="2">JUMLAH</td>
                    <td>{{ $total['jumlah'] ?? 0 }}</td>

                    <td>{{ $total['balita_l'] ?? 0 }}</td>
                    <td>{{ $total['balita_p'] ?? 0 }}</td>

                    <td>{{ $total['anak_l'] ?? 0 }}</td>
                    <td>{{ $total['anak_p'] ?? 0 }}</td>

                    <td>{{ $total['remaja_l'] ?? 0 }}</td>
                    <td>{{ $total['remaja_p'] ?? 0 }}</td>

                    <td>{{ $total['dewasa_l'] ?? 0 }}</td>
                    <td>{{ $total['dewasa_p'] ?? 0 }}</td>

                    <td>{{ $total['lansia_l'] ?? 0 }}</td>
                    <td>{{ $total['lansia_p'] ?? 0 }}</td>
                </tr>

            </tbody>
        </table>
    </div>

    <small class="text-muted d-block mt-2">
        Keterangan: Balita (0–5), Anak-anak (6–12), Remaja (13–17),
        Dewasa (18–59), Lansia (≥60 tahun)
    </small>

    {{-- ================= PIE CHART ================= --}}
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
document.addEventListener("DOMContentLoaded", function () {

    const ctx = document.getElementById('usiaChart');

    if (ctx) {
        new Chart(ctx, {
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
                        {{ $total['balita'] ?? 0 }},
                        {{ $total['anak'] ?? 0 }},
                        {{ $total['remaja'] ?? 0 }},
                        {{ $total['dewasa'] ?? 0 }},
                        {{ $total['lansia'] ?? 0 }}
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
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
    }

});
</script>


<style>
.chart-wrapper {
    display: flex;
    justify-content: center;
}

.chart-item {
    width: 200px;
    text-align: center;
}

.chart-item canvas {
    width: 100% !important;
    height: 200px !important;
}

.chart-title {
    margin-top: 8px;
    font-weight: bold;
    font-size: 14px;
}

@media (min-width: 768px) {
    .chart-item {
        width: 260px;
    }

    .chart-item canvas {
        height: 260px !important;
    }
}
</style>

@endpush