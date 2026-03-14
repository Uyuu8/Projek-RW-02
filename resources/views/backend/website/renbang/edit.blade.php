@extends('layouts.backend.app')

@section('content')

<div class="card">

<div class="card-header">
<h4>Edit Renbang</h4>
</div>

<div class="card-body">

<form action="{{ route('backend-renbang.update',$renbang->id) }}" method="POST" enctype="multipart/form-data">

@csrf
@method('PUT')

<div class="mb-3">
<label>Tahun</label>
<input type="number" name="tahun" class="form-control" value="{{ $renbang->tahun }}">
</div>

<div class="mb-3">
<label>File PDF</label>
<br>

<a href="{{ asset('files/renbang/'.$renbang->file) }}" target="_blank" class="btn btn-info btn-sm mb-2">
Lihat File Lama
</a>

<input type="file" name="file" class="form-control" accept="application/pdf">
</div>

<div class="mb-3">
<label>Keterangan</label>
<textarea name="keterangan" class="form-control">{{ $renbang->keterangan }}</textarea>
</div>

<button class="btn btn-primary">
Update
</button>

<a href="{{ route('backend-renbang.index') }}" class="btn btn-secondary">
Kembali
</a>

</form>

</div>

</div>

@endsection