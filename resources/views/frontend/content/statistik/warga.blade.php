@extends('layouts.Frontend.page')

@section('content')
<div class="container my-5">

    {{-- JUDUL --}}
    <div class="text-center mb-4">
        <h4 class="font-weight-bold">STATISTIK WARGA</h4>
        <h6 class="mt-2">RW {{ $rw }} KELURAHAN SUKAPURA</h6>
        <small>KECAMATAN KIARACONDONG KOTA BANDUNG</small>
    </div>

    {{-- FILTER RT --}}
    <form method="GET" class="text-center mb-3">
        <label class="font-weight-bold mr-2">Filter RT:</label>
        <select name="rt" onchange="this.form.submit()" class="form-control d-inline-block w-auto">
            <option value="">Semua RT</option>
            @foreach ($listRt as $rt)
                <option value="{{ $rt }}" {{ request('rt') == $rt ? 'selected' : '' }}>
                    RT {{ $rt }}
                </option>
            @endforeach
        </select>
    </form>

    {{-- TABEL --}}
    <div class="table-responsive">
        <table class="table table-bordered text-center">
            <thead style="background:#FFD700">
                <tr>
                    <th>RW</th>
                    <th>RT</th>
                    <th>Jumlah</th>
                    <th>L</th>
                    <th>P</th>
                    <th>Tetap</th>
                    <th>Tidak Tetap</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($statistik as $rt => $row)
                <tr>
                    <td>{{ $rw }}</td>
                    <td>{{ $rt }}</td>
                    <td>{{ $row['jumlah'] }}</td>
                    <td>{{ $row['laki'] }}</td>
                    <td>{{ $row['perempuan'] }}</td>
                    <td>{{ $row['tetap'] }}</td>
                    <td>{{ $row['tidak_tetap'] }}</td>
                </tr>
                @endforeach

                <tr class="font-weight-bold bg-light">
                    <td colspan="2">JUMLAH</td>
                    <td>{{ $total['jumlah'] }}</td>
                    <td>{{ $total['laki'] }}</td>
                    <td>{{ $total['perempuan'] }}</td>
                    <td>{{ $total['tetap'] }}</td>
                    <td>{{ $total['tidak_tetap'] }}</td>
                </tr>
            </tbody>
        </table>
    </div>

    {{-- PIE CHART --}}
    <div class="chart-wrapper mt-4">

        <div class="chart-item">
            <canvas id="genderChart"></canvas>
            <p class="chart-title">Jenis Kelamin</p>
        </div>

        <div class="chart-item">
            <canvas id="statusChart"></canvas>
            <p class="chart-title">Status Warga</p>
        </div>

    </div>

</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {

    // ===== DATA AMAN =====
    const laki = {{ $total['laki'] ?? 0 }};
    const perempuan = {{ $total['perempuan'] ?? 0 }};
    const tetap = {{ $total['tetap'] ?? 0 }};
    const tidakTetap = {{ $total['tidak_tetap'] ?? 0 }};

    // ===== CHART GENDER =====
    new Chart(document.getElementById('genderChart'), {
        type: 'pie',
        data: {
            labels: ['Laki-laki', 'Perempuan'],
            datasets: [{
                data: [laki, perempuan],
                backgroundColor: ['#00cfe8', '#7367f0']
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

    // ===== CHART STATUS =====
    new Chart(document.getElementById('statusChart'), {
        type: 'pie',
        data: {
            labels: ['Warga Tetap', 'Warga Tidak Tetap'],
            datasets: [{
                data: [tetap, tidakTetap],
                backgroundColor: ['#28c76f', '#ea5455']
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

});
</script>

<style>
.chart-wrapper {
    display: flex;
    justify-content: center;
    gap: 20px;
    flex-wrap: nowrap; /* HP tetap sejajar */
}

.chart-item {
    width: 160px;
    text-align: center;
}

.chart-item canvas {
    width: 160px !important;
    height: 160px !important;
}

.chart-title {
    margin-top: 6px;
    font-weight: bold;
    font-size: 14px;
}

/* DESKTOP */
@media (min-width: 768px) {
    .chart-item {
        width: 250px;
    }

    .chart-item canvas {
        width: 250px !important;
        height: 250px !important;
    }
}
</style>
@endpush
