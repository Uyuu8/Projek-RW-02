@extends('layouts.backend.app')

@section('content')
<div class="container">
    <h3>Data Penerima MBG</h3>

    <a href="{{ route('backend.website.mbg.create') }}" class="btn btn-primary mb-3">Tambah Data</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Rt</th>
                <th>Umur</th>
                <th>Kategori</th>
                <th>Tanggal Mulai</th>
                <th>Keterangan</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @foreach($data as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->warga->nama_lengkap }}</td>
                <td>{{ $item->warga->rt }}</td>
                <td>
                    {{ \Carbon\Carbon::parse($item->warga->tanggal_lahir)->age }} Tahun
                </td>
                <td>{{ $item->kategori }}</td>
                <td>
                    {{ \Carbon\Carbon::parse($item->tanggal_mulai)->translatedFormat('d F Y') }}
                </td>
                <td>{{ $item->keterangan }}</td>

                <td>
                    <a href="{{ route('backend.website.mbg.edit',$item->id) }}" class="btn btn-warning btn-sm">Edit</a>

                    <form action="{{ route('backend.website.mbg.destroy',$item->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')

                        <button class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>
@endsection