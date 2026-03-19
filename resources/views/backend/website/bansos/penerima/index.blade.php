@extends('layouts.backend.app')

@section('content')

<div class="container">

<h4 class="mb-4">
Penerima Bansos : <b>{{ $bansos->uraian_bansos }}</b>
</h4>

<a href="{{ route('backend.website.bansos.penerima.create',$bansos->id) }}" 
class="btn btn-primary mb-3">
Tambah Penerima
</a>

<div class="card">

<div class="card-header">
Daftar Penerima
</div>

<div class="card-body">

<table class="table table-bordered">

<thead>
<tr>
<th>No</th>
<th>Nama</th>
<th>NIK</th>
<th>Aksi</th>
</tr>
</thead>

<tbody>

@forelse($penerima as $p)

<tr>
<td>{{ $loop->iteration }}</td>
<td>{{ $p->warga->nama_lengkap }}</td>
<td>{{ $p->warga->nik }}</td>

<td>

<form action="{{ route('backend.website.bansos.penerima.destroy',[$bansos->id,$p->id]) }}" method="POST">

@csrf
@method('DELETE')

<button class="btn btn-danger btn-sm"
onclick="return confirm('hapus penerima?')">
Hapus
</button>

</form>

</td>

</tr>

@empty

<tr>
<td colspan="4" class="text-center">
Belum ada penerima
</td>
</tr>

@endforelse

</tbody>

</table>

</div>
</div>

</div>

@endsection