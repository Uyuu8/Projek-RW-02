@extends('layouts.frontend.page')

@section('content')
<div class="container my-5">

    {{-- JUDUL --}}
    <div class="text-center mb-4">
        <h4 class="font-weight-bold">STATISTIK PENDIDIKAN</h4>
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
                    <th>TS</th>
                    <th>SD</th>
                    <th>SMP</th>
                    <th>SMA/SMK</th>
                    <th>D3</th>
                    <th>S1</th>
                    <th>S2</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($statistik as $rt => $row)
                <tr>
                    <td>{{ $rw }}</td>
                    <td>{{ $rt }}</td>
                    <td>{{ $row['jumlah'] }}</td>
                    <td>{{ $row['ts'] }}</td>
                    <td>{{ $row['sd'] }}</td>
                    <td>{{ $row['smp'] }}</td>
                    <td>{{ $row['sma'] }}</td>
                    <td>{{ $row['d3'] }}</td>
                    <td>{{ $row['s1'] }}</td>
                    <td>{{ $row['s2'] }}</td>
                </tr>
                @endforeach

                <tr class="font-weight-bold bg-light">
                    <td colspan="2">JUMLAH</td>
                    <td>{{ $total['jumlah'] }}</td>
                    <td>{{ $total['ts'] }}</td>
                    <td>{{ $total['sd'] }}</td>
                    <td>{{ $total['smp'] }}</td>
                    <td>{{ $total['sma'] }}</td>
                    <td>{{ $total['d3'] }}</td>
                    <td>{{ $total['s1'] }}</td>
                    <td>{{ $total['s2'] }}</td>
                </tr>
            </tbody>
        </table>
    </div>

    {{-- PIE CHART --}}
    <div class="chart-wrapper mt-4">
        <div class="chart-item">
            <canvas id="pendidikanChart"></canvas>
            <p class="chart-title">Distribusi Pendidikan</p>
        </div>
    </div>

</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
new Chart(document.getElementById('pendidikanChart'), {
    type: 'pie',
    data: {
        labels: ['Tidak Sekolah','SD','SMP','SMA/SMK','D3','S1','S2'],
        datasets: [{
            data: [
                {{ $total['ts'] }},
                {{ $total['sd'] }},
                {{ $total['smp'] }},
                {{ $total['sma'] }},
                {{ $total['d3'] }},
                {{ $total['s1'] }},
                {{ $total['s2'] }}
            ],
            backgroundColor: [
                '#ea5455',
                '#00cfe8',
                '#7367f0',
                '#28c76f',
                '#ff9f43',
                '#1e90ff',
                '#6f42c1'
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
