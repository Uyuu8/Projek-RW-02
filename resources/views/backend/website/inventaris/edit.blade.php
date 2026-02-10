@extends('layouts.backend.app')

@section('title', 'Edit Inventaris')

@section('content')
<form action="{{ route('backend.website.inventaris.update', ['backend_inventari' => $inventari->id]) }}"
      method="POST"
      enctype="multipart/form-data">


    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Nama Barang</label>
        <input type="text"
               name="nama_barang"
               class="form-control"
               value="{{ old('nama_barang', $inventari->nama_barang) }}"
               required>
    </div>

    <div class="mb-3">
        <label>Foto (Opsional)</label>
        <input type="file" name="foto" class="form-control">
    </div>

    @if ($inventari->foto)
        <div class="mb-3">
            <label>Foto Saat Ini</label><br>
            <img src="{{ asset('storage/' . $inventari->foto) }}"
                 width="150"
                 class="img-thumbnail">
        </div>
    @endif

    <button class="btn btn-primary">Update</button>
    <a href="{{ route('backend.website.inventaris.index') }}"
       class="btn btn-secondary">
        Kembali
    </a>
</form>
@endsection
