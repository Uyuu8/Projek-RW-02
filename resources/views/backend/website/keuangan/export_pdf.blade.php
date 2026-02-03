<!DOCTYPE html>
<html>
<head>
    <title>Laporan Keuangan Iuran</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 10px;
        }

        th, td {
            border: 1px solid black;
            padding: 6px;
            text-align: center;
        }

        h2 {
            margin-bottom: 5px;
        }

        .text-left {
            text-align: left;
        }

        .bold {
            font-weight: bold;
        }
    </style>
</head>
<body>

@php
$namaBulan = [
    1 => 'Januari',
    2 => 'Februari',
    3 => 'Maret',
    4 => 'April',
    5 => 'Mei',
    6 => 'Juni',
    7 => 'Juli',
    8 => 'Agustus',
    9 => 'September',
    10 => 'Oktober',
    11 => 'November',
    12 => 'Desember'
];
@endphp


<h2 style="text-align:center">
Laporan Keuangan Iuran RT {{ $rt }}

@if($bulan)
    - {{ $namaBulan[$bulan] }} {{ $tahun }}
@else
    Tahun {{ $tahun }}
@endif

</h2>


<p>
Filter:
@if($bulan)
    Bulan: {{ $namaBulan[$bulan] }}
@else
    Semua Bulan
@endif

- Tahun: {{ $tahun }}
</p>


<table>

<tr>
    <th>No</th>
    <th>Nama Kepala Keluarga</th>
    <th>Total Pembayaran</th>
</tr>

@php 
$no = 1; 
$totalSemua = 0;
@endphp


@foreach($wargas as $warga)

@php
    $total = $iurans->where('warga_id', $warga->id)
                    ->where('status','Lunas')
                    ->sum('jumlah');

    $totalSemua += $total;
@endphp

<tr>
    <td>{{ $no++ }}</td>
    <td class="text-left">{{ $warga->nama_lengkap }}</td>
    <td>Rp {{ number_format($total,0,',','.') }}</td>
</tr>

@endforeach


<tr class="bold">
    <td colspan="2">TOTAL SELURUH PEMASUKAN</td>
    <td>Rp {{ number_format($totalSemua,0,',','.') }}</td>
</tr>

</table>


<br><br>

<table style="border:none; width:100%">
<tr style="border:none">
    <td style="border:none; text-align:right">
        Sukapura, {{ date('d') }} {{ $namaBulan[(int)date('m')] }} {{ date('Y') }}
        <br>
        Bendahara RW 02
        <br><br><br><br>

        (__________________________)
    </td>
</tr>
</table>

</body>
</html>
