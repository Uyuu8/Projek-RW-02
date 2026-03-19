@extends('layouts.backend.app')

@section('content')
<div class="container">

<h3>Tambah Penerima MBG</h3>

<form action="{{ route('backend.website.mbg.store') }}" method="POST">
@csrf

<div class="mb-3">
<label>Warga</label>
<select name="warga_id" class="form-control select2">
    <option value="">-- Pilih Warga --</option>
    @foreach($warga as $w)
        <option value="{{ $w->id }}">
            {{ $w->nama_lengkap }} - RT {{ $w->rt }}
        </option>
    @endforeach
</select>
</div>

<div class="mb-3">
<label>Kategori</label>
<select name="kategori" class="form-control">
    <option value="Balita">Balita</option>
    <option value="Ibu Hamil">Ibu Hamil</option>
    <option value="Ibu Menyusui">Ibu Menyusui</option>
</select>
</div>

<div class="mb-3">
<label>Tanggal Mulai</label>
<input type="date" name="tanggal_mulai" class="form-control">
</div>

<div class="mb-3">
<label>Keterangan</label>
<textarea name="keterangan" class="form-control"></textarea>
</div>

<button class="btn btn-success">Simpan</button>

</form>

</div>
@endsection

<script>
$(document).ready(function() {
    $('.select2').select2({
        placeholder: "Cari Warga...",
        allowClear: true
    });
});
</script>