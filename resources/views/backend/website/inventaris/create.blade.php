@extends('layouts.backend.app')

@section('title', 'Tambah Inventaris')

@section('content')
<form action="{{ route('backend.website.inventaris.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

<label>Nama Barang</label>
<input type="text" name="nama_barang" class="form-control">

<label>Jenis</label>
<select name="jenis" class="form-control">
    <option value="electronic">Electronic</option>
    <option value="non-electronic">Non Electronic</option>
</select>

<label>Bulan</label>
<input type="text" name="bulan" placeholder="02" class="form-control">

<label>Tahun</label>
<input type="text" name="tahun" placeholder="2026" class="form-control">

<label>Foto</label>
<input type="file" name="foto" class="form-control">

<button class="btn btn-primary mt-3">Simpan</button>
</form>
@endsection