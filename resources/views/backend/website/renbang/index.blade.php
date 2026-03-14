@extends('layouts.backend.app')

@section('content')

<div class="card">

<div class="card-header d-flex justify-content-between">
<h4>Data Renbang</h4>

<a href="{{ route('backend.website.renbang.create') }}" class="btn btn-primary">
Tambah Renbang
</a>

</div>

<div class="card-body">

<table class="table table-bordered">

<thead>
<tr>
<th>No</th>
<th>Tahun</th>
<th>File</th>
<th>Keterangan</th>
<th width="150">Aksi</th>
</tr>
</thead>

<tbody>

@foreach ($renbang as $data)

<tr>

<td>{{ $loop->iteration }}</td>

<td>{{ $data->tahun }}</td>

<td>
<a href="{{ asset('files/renbang/'.$data->file) }}" target="_blank" class="btn btn-sm btn-info">
Lihat PDF
</a>
</td>

<td>{{ $data->keterangan }}</td>

<td>

<a href="{{ route('backend.website.renbang.edit',$data->id) }}" class="btn btn-warning btn-sm">
Edit
</a>

<form action="{{ route('backend.website.renbang.destroy',$data->id) }}" method="POST" style="display:inline">

@csrf
@method('DELETE')

<button class="btn btn-danger btn-sm">
Hapus
</button>

</form>

</td>

</tr>

@endforeach

</tbody>

</table>

</div>

</div>

@endsection