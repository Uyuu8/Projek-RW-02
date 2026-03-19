@extends('layouts.backend.app')

@section('content')
<div class="container">

<h3>Edit Penerima MBG</h3>

<form action="{{ route('backend.website.mbg.update',$data->id) }}" method="POST">
@csrf
@method('PUT')

<div class="mb-3">
<label>Warga</label>
<select name="warga_id" class="form-control">
@foreach($warga as $w)
<option value="{{ $w->id }}" 
    {{ $data->warga_id == $w->id ? 'selected' : '' }}>
    {{ $w->nama_lengkap }}
</option>
@endforeach
</select>
</div>

<div class="mb-3">
<label>Kategori</label>
<select name="kategori" class="form-control">
<option value="Balita" {{ $data->kategori == 'Balita' ? 'selected' : '' }}>Balita</option>
<option value="Ibu Hamil" {{ $data->kategori == 'Ibu Hamil' ? 'selected' : '' }}>Ibu Hamil</option>
<option value="Ibu Menyusui" {{ $data->kategori == 'Ibu Menyusui' ? 'selected' : '' }}>Ibu Menyusui</option>
</select>
</div>

<div class="mb-3">
<label>Tanggal Mulai</label>
<input type="date" name="tanggal_mulai" value="{{ $data->tanggal_mulai }}" class="form-control">
</div>

<div class="mb-3">
<label>Keterangan</label>
<textarea name="keterangan" class="form-control">{{ $data->keterangan }}</textarea>
</div>

<button class="btn btn-success">Update</button>

</form>

</div>
@endsection