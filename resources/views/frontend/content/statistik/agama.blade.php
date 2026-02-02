@extends('layouts.frontend.page')

@section('content')
<div class="container my-5">

    {{-- JUDUL --}}
    <div class="text-center mb-4">
        <h4 class="font-weight-bold">STATISTIK AGAMA</h4>
        <h6>RW {{ $rw }} KELURAHAN SUKAPURA</h6>
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
                    <th>Islam</th>
                    <th>Kristen</th>
                    <th>Hindu</th>
                    <th>Buddha</th>
                    <th>Lainnya</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($statistik as $rt => $row)
                <tr>
                    <td>{{ $rw }}</td>
                    <td>{{ $rt }}</td>
                    <td>{{ $row['jumlah'] }}</td>
                    <td>{{ $row['islam'] }}</td>
                    <td>{{ $row['kristen'] }}</td>
                    <td>{{ $row['hindu'] }}</td>
                    <td>{{ $row['buddha'] }}</td>
                    <td>{{ $row['lainnya'] }}</td>
                </tr>
                @endforeach

                <tr class="font-weight-bold bg-light">
                    <td colspan="2">JUMLAH</td>
                    <td>{{ $total['jumlah'] }}</td>
                    <td>{{ $total['islam'] }}</td>
                    <td>{{ $total['kristen'] }}</td>
                    <td>{{ $total['hindu'] }}</td>
                    <td>{{ $total['buddha'] }}</td>
                    <td>{{ $total['lainnya'] }}</td>
                </tr>
            </tbody>
        </table>
    </div>

    {{-- PIE CHART --}}
    <div class="chart-wrapper mt-4">
        <div class="chart-item">
            <canvas id="agamaChart"></canvas>
            <p class="chart-title">Distribusi Agama</p>
        </div>
    </div>

</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
new Chart(document.getElementById('agamaChart'), {
    type: 'pie',
    data: {
        labels: ['Islam','Kristen','Hindu','Buddha','Lainnya'],
        datasets: [{
            data: [
                {{ $total['islam'] }},
                {{ $total['kristen'] }},
                {{ $total['hindu'] }},
                {{ $total['buddha'] }},
                {{ $total['lainnya'] }}
            ],
            backgroundColor: [
                '#28c76f',
                '#7367f0',
                '#ff9f43',
                '#00cfe8',
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
.chart-wrapper {
    display: flex;
    justify-content: center;
}

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
