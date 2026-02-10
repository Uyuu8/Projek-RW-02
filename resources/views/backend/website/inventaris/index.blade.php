@extends('layouts.backend.app')


@section('title', 'Data Warga')

@section('content')
<a href="{{ route('backend.website.inventaris.create') }}" class="btn btn-success">Tambah</a>

<table class="table mt-3">
<tr>
    <th>Kode</th>
    <th>Nama</th>
    <th>Foto</th>
    <th>Aksi</th>
</tr>

@foreach($inventaris as $i)
<tr>
    <td>{{ $i->kode_barang }}</td>
    <td>{{ $i->nama_barang }}</td>
    <td>
        @if($i->foto)
        <img src="{{ asset('storage/'.$i->foto) }}" width="80">
        @endif
    </td>
    <td>
        <a href="{{ route('backend.website.inventaris.edit',$i->id) }}" class="btn btn-warning">Edit</a>
        <form action="{{ route('backend.website.inventaris.destroy',$i->id) }}" method="POST" style="display:inline">
            @csrf @method('DELETE')
            <button class="btn btn-danger">Hapus</button>
        </form>
    </td>
</tr>
@endforeach
</table>
@endsection