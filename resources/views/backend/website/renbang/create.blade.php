@extends('layouts.backend.app')

@section('content')

<div class="card">
<div class="card-header">
<h4>Tambah Renbang</h4>
</div>

<div class="card-body">

<form action="{{ route('backend.website.renbang.store') }}" method="POST" enctype="multipart/form-data">
@csrf

<div class="mb-3">
<label>Tahun</label>
<input type="number" name="tahun" class="form-control">
</div>

<div class="mb-3">
<label>Upload File PDF</label>
<input type="file" name="file" class="form-control">
</div>

<div class="mb-3">
<label>Keterangan</label>
<textarea name="keterangan" class="form-control"></textarea>
</div>

<button class="btn btn-primary">Simpan</button>

</form>

</div>
</div>

@endsection