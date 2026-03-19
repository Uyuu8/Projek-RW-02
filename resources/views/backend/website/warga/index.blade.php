@extends('layouts.backend.app')

@section('title', 'Data Warga')

@section('content')
<div class="container-fluid">

<div class="card shadow mb-4">

{{-- HEADER --}}
<div class="card-header py-3 d-flex justify-content-between align-items-center">
    <h6 class="m-0 font-weight-bold text-primary">Data Warga</h6>

    <a href="{{ route('backend-warga.create') }}" class="btn btn-primary btn-sm">
        Tambah Warga
    </a>
</div>


<div class="card-body">

{{-- ALERT --}}
@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif


{{-- SEARCH & FILTER --}}
<div class="mb-3 d-flex gap-2">

<input type="text"
       name="search"
       form="filterForm"
       class="form-control w-25"
       placeholder="Cari nama / NIK / KK..."
       value="{{ request('search') }}">


<button class="btn btn-primary"
        data-bs-toggle="modal"
        data-bs-target="#filterModal">

🔎 Filter
</button>


<a href="{{ route('backend-warga.index') }}"
   class="btn btn-secondary">
Reset
</a>

</div>


{{-- ACTION BUTTON --}}
<div class="mb-3 d-flex gap-2">

<a href="{{ route('backend-warga.export.pdf', request()->query()) }}"
   class="btn btn-danger btn-sm">
Export PDF
</a>

<a href="{{ route('backend-warga.export.excel', request()->query()) }}"
   class="btn btn-success btn-sm">
Export Excel
</a>

<button class="btn btn-info btn-sm"
        data-bs-toggle="modal"
        data-bs-target="#importModal">
Import Excel
</button>

</div>


{{-- TABLE --}}
<div class="table-responsive">

<table class="table table-bordered table-sm table-hover">

<thead class="table-light text-center">
<tr>
<th>No</th>
<th>NIK</th>
<th>No KK</th>
<th>Nama</th>
<th>JK</th>
<th>TTL</th>
<th>RT</th>
<th>RW</th>
<th>Pendidikan</th>
<th>Agama</th>
<th>Status</th>
<th>Foto KK</th>
<th>Aksi</th>
</tr>
</thead>


<tbody>

@forelse ($wargas as $warga)

<tr>

<td class="text-center">
{{ ($wargas->currentPage()-1)*$wargas->perPage()+$loop->iteration }}
</td>

<td>{{ $warga->nik }}</td>

<td>{{ $warga->no_kk }}</td>

<td>{{ $warga->nama_lengkap }}</td>

<td class="text-center">{{ $warga->jenis_kelamin }}</td>

<td>
{{ $warga->tempat_lahir }},
{{ \Carbon\Carbon::parse($warga->tanggal_lahir)->format('d-m-Y') }}
</td>

<td class="text-center">{{ $warga->rt }}</td>

<td class="text-center">{{ $warga->rw }}</td>

<td>{{ $warga->pendidikan }}</td>

<td>{{ $warga->agama }}</td>

<td class="text-center">
<span class="badge bg-info">
{{ $warga->status_warga }}
</span>
</td>

{{-- FOTO KK --}}
<td class="text-center">
@if($warga->kartuKeluarga && $warga->kartuKeluarga->foto_kk)
    <a href="{{ asset('images/kk/' . $warga->kartuKeluarga->foto_kk) }}" 
       target="_blank" 
       class="btn btn-info btn-sm">
       Lihat
    </a>
@else
    <span class="text-muted">Belum ada</span>
@endif
</td>

<td class="text-center">

<a href="{{ route('backend-warga.edit', $warga->id) }}"
class="btn btn-warning btn-sm">
Edit
</a>

<form action="{{ route('backend-warga.destroy', $warga->id) }}"
method="POST"
class="d-inline">

@csrf
@method('DELETE')

<button class="btn btn-danger btn-sm"
onclick="return confirm('Hapus data warga ini?')">

Hapus
</button>

</form>

{{-- BUTTON UPLOAD KK --}}
<button class="btn btn-info btn-sm"
    data-bs-toggle="modal"
    data-bs-target="#uploadKK{{ $warga->id }}">
    Upload KK
</button>

</td>

</tr>

{{-- MODAL UPLOAD KK --}}
<div class="modal fade" id="uploadKK{{ $warga->id }}" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">

      <form action="{{ route('backend.website.kartu_keluarga.upload') }}" 
            method="POST" 
            enctype="multipart/form-data">

        @csrf

        <div class="modal-header">
          <h5 class="modal-title">Upload KK</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body">

            <div class="mb-3">
                <label>No KK</label>
                <input type="text" name="no_kk" 
                       value="{{ $warga->no_kk }}" 
                       class="form-control" readonly>
            </div>

            <div class="mb-3">
                <label>Foto KK</label>
                <input type="file" name="foto_kk" class="form-control" required>
            </div>

        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Upload</button>
        </div>

      </form>

    </div>
  </div>
</div>

@empty

<tr>
<td colspan="14" class="text-center">
Data warga belum tersedia
</td>
</tr>

@endforelse

</tbody>
</table>

</div>


{{-- TOTAL DATA --}}
<div class="mb-2 text-muted">
Menampilkan {{ $wargas->firstItem() }} - {{ $wargas->lastItem() }}
dari {{ $wargas->total() }} data warga
</div>


{{-- PAGINATION --}}
<div class="d-flex justify-content-center mt-3">
{{ $wargas->onEachSide(1)->links() }}
</div>


</div>
</div>
</div>



{{-- MODAL IMPORT --}}
<div class="modal fade" id="importModal">

<div class="modal-dialog">

<form action="{{ route('backend-warga.import') }}"
method="POST"
enctype="multipart/form-data">

@csrf

<div class="modal-content">

<div class="modal-header">
<h5 class="modal-title">Import Data Warga</h5>
<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
</div>


<div class="modal-body">

<input type="file" name="file" class="form-control" required>

<small class="text-muted">
Format file: .xlsx / .xls
</small>

</div>


<div class="modal-footer">

<button class="btn btn-secondary" data-bs-dismiss="modal">
Batal
</button>

<button class="btn btn-success">
Import
</button>

</div>

</div>
</form>
</div>
</div>



{{-- MODAL FILTER --}}
<div class="modal fade" id="filterModal">

<div class="modal-dialog modal-lg">

<div class="modal-content">

<form method="GET"
action="{{ route('backend-warga.index') }}"
id="filterForm">


<div class="modal-header">

<h5 class="modal-title">
Filter Data Warga
</h5>

<button type="button"
class="btn-close"
data-bs-dismiss="modal">
</button>

</div>


<div class="modal-body">

<div class="row">


{{-- RT --}}
<div class="col-md-4">

<h6>RT</h6>

@foreach($listRt as $rt)

<div class="form-check">

<input type="checkbox"
name="rt[]"
value="{{ $rt }}"
class="form-check-input"
{{ in_array($rt, request('rt', [])) ? 'checked' : '' }}>

<label class="form-check-label">
RT {{ $rt }}
</label>

</div>

@endforeach

</div>



{{-- STATUS WARGA --}}
<div class="col-md-4">

<h6>Status Warga</h6>

@foreach(['Aktif','Pindah','Meninggal'] as $status)

<div class="form-check">

<input type="checkbox"
name="status_warga[]"
value="{{ $status }}"
class="form-check-input"
{{ in_array($status, request('status', [])) ? 'checked' : '' }}>

<label class="form-check-label">
{{ $status }}
</label>

</div>

@endforeach

</div>



{{-- JENIS KELAMIN --}}
<div class="col-md-4">

<h6>Jenis Kelamin</h6>

<div class="form-check">

<input type="checkbox"
name="jenis_kelamin[]"
value="Laki-laki"
class="form-check-input"
{{ in_array('Laki-laki', request('jenis_kelamin', [])) ? 'checked' : '' }}>

<label class="form-check-label">
Laki-laki
</label>

</div>


<div class="form-check">

<input type="checkbox"
name="jenis_kelamin[]"
value="Perempuan"
class="form-check-input"
{{ in_array('Perempuan', request('jenis_kelamin', [])) ? 'checked' : '' }}>

<label class="form-check-label">
Perempuan
</label>

</div>

</div>

</div>


<hr>


<div class="row">


{{-- STATUS RUMAH --}}
<div class="col-md-4">

<h6>Status Rumah</h6>

@foreach(['Menetap','Kontrak'] as $rumah)

<div class="form-check">

<input type="checkbox"
name="status_rumah[]"
value="{{ $rumah }}"
class="form-check-input"
{{ in_array($rumah, request('status_rumah', [])) ? 'checked' : '' }}>

<label class="form-check-label">
{{ $rumah }}
</label>

</div>

@endforeach

</div>



{{-- AGAMA --}}
<div class="col-md-4">

<h6>Agama</h6>

@foreach(['Islam','Kristen','Hindu','Buddha','Lainnya'] as $agama)

<div class="form-check">

<input type="checkbox"
name="agama[]"
value="{{ $agama }}"
class="form-check-input"
{{ in_array($agama, request('agama', [])) ? 'checked' : '' }}>

<label class="form-check-label">
{{ $agama }}
</label>

</div>

@endforeach

</div>



{{-- PENDIDIKAN --}}
<div class="col-md-4">

<h6>Pendidikan</h6>

@foreach(['SD atau Sederajat','SMP atau Sederajat','SMA/SMK atau Sederajat','D3','S1','S2','S3'] as $pendidikan)

<div class="form-check">

<input type="checkbox"
name="pendidikan[]"
value="{{ $pendidikan }}"
class="form-check-input"
{{ in_array($pendidikan, request('pendidikan', [])) ? 'checked' : '' }}>

<label class="form-check-label">
{{ $pendidikan }}
</label>

</div>

@endforeach

</div>

</div>

</div>


<div class="modal-footer">

<button type="submit" class="btn btn-primary">
Filter
</button>

</div>


</form>

</div>
</div>
</div>


@endsection