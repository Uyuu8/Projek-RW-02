@extends('layouts.backend.app')

@section('content')

<div class="card">
<div class="card-header">
    <h4>Data Keuangan RT {{ $rt }}</h4>
</div>

<div class="card-body">

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<div class="table-responsive">
    <div class="card mb-3">
<div class="card-body">

<form method="GET" class="row">

    <div class="col-md-3">
        <select name="bulan" class="form-control">
            <option value="">Semua Bulan</option>

            @foreach($bulan as $key => $nama)
                <option value="{{ $key }}"
                {{ request('bulan') == $key ? 'selected' : '' }}>
                    {{ $nama }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-3">
        <select name="tahun" class="form-control">
            @for($i=date('Y'); $i>=2023; $i--)
                <option value="{{ $i }}"
                {{ request('tahun') == $i ? 'selected' : '' }}>
                    {{ $i }}
                </option>
            @endfor
        </select>
    </div>

    <div class="col-md-3">
        <button class="btn btn-primary">
            Filter
        </button>
    </div>

</form>

<hr>

<a href="{{ route('backend-keuangan.exportPdf', [
        'rt' => $rt,
        'bulan' => request('bulan'),
        'tahun' => request('tahun')
    ]) }}"
    class="btn btn-danger">
    Export PDF
</a>

<a href="{{ route('backend-keuangan.exportExcel', [
        'rt' => $rt,
        'bulan' => request('bulan'),
        'tahun' => request('tahun')
    ]) }}"
    class="btn btn-success">
    Export Excel
</a>

</div>
</div>

<table class="table table-bordered">
<thead>
<tr>
    <th>No</th>
    <th>Nama KK</th>

    @foreach($bulan as $namaBulan)
        <th>{{ $namaBulan }}</th>
    @endforeach

    <th>Total Tunggakan</th>
</tr>
</thead>

<tbody>

@foreach($wargas as $warga)

<tr>
<td>{{ $loop->iteration }}</td>

{{-- PERBAIKAN DISINI --}}
<td>{{ $warga->nama_lengkap }}</td>

@foreach($bulan as $key => $namaBulan)

@php
    $bayar = $iurans->where('warga_id', $warga->id)
                    ->where('bulan', $key)
                    ->first();

    $sekarang = date('Y-m-d');
    $jatuhTempo = date('Y') . '-' . sprintf('%02d', $key) . '-20';
@endphp

<td class="text-center">

@if($bayar && $bayar->status == 'Lunas')

    <span class="badge bg-success">Lunas</span>

@else

    @if($sekarang > $jatuhTempo)
        <span class="badge bg-danger">Tunggakan</span>
    @else
        <span class="badge bg-warning">Belum</span>
    @endif

    <form action="{{ route('backend-keuangan.bayar') }}" method="POST">
        @csrf

        <input type="hidden" name="warga_id" value="{{ $warga->id }}">
        <input type="hidden" name="bulan" value="{{ $key }}">
        <input type="hidden" name="tahun" value="{{ date('Y') }}">
        <input type="hidden" name="rt" value="{{ $rt }}">

        <button class="btn btn-sm btn-primary mt-1">
            Bayar
        </button>
    </form>

@endif

</td>

@endforeach

<td class="text-danger fw-bold">
    Rp {{ number_format($warga->total_tunggakan) }}
</td>


</tr>

@endforeach

</tbody>

</table>
</div>

</div>
</div>

@endsection
