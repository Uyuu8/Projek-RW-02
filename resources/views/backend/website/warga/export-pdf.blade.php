<!DOCTYPE html>
<html>
<head>
    <title>Data Warga</title>
    <style>
        body { font-family: sans-serif; font-size: 10px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #000; padding: 4px; }
        th { background: #eee; }
        h3 { text-align: center; margin-bottom: 10px; }
    </style>
</head>
<body>

<h3>DATA WARGA</h3>

<table>
    <thead>
        <tr>
            <th>No</th>
            <th>NIK</th>
            <th>Nama</th>
            <th>JK</th>
            <th>RT</th>
            <th>RW</th>
            <th>Pendidikan</th>
            <th>Agama</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($wargas as $warga)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $warga->nik }}</td>
            <td>{{ $warga->nama_lengkap }}</td>
            <td>{{ $warga->jenis_kelamin }}</td>
            <td>{{ $warga->rt }}</td>
            <td>{{ $warga->rw }}</td>
            <td>{{ $warga->pendidikan }}</td>
            <td>{{ $warga->agama }}</td>
            <td>{{ $warga->status_warga }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>
