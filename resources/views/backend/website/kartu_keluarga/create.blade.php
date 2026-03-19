@extends('layouts.backend.app')

@section('content')
<div class="container">

<h3>Upload Kartu Keluarga</h3>

{{-- ✅ ALERT SUCCESS --}}
@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

{{-- ❌ ERROR VALIDASI --}}
@if ($errors->any())
<div class="alert alert-danger">
    <ul class="mb-0">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ route('backend.website.kartu_keluarga.upload') }}" 
      method="POST" 
      enctype="multipart/form-data">

@csrf

<div class="mb-3">
    <label>No KK</label>
    <input type="text" 
           name="no_kk" 
           class="form-control" 
           maxlength="16"
           value="{{ old('no_kk') }}"
           placeholder="Masukkan 16 digit No KK"
           required>
</div>

<div class="mb-3">
    <label>Foto KK</label>
    <input type="file" 
           name="foto_kk" 
           class="form-control" 
           accept="image/*"
           required>
</div>

<button class="btn btn-primary">Upload</button>

<a href="{{ route('backend-warga.index') }}" 
   class="btn btn-secondary">
   Kembali
</a>

</form>

</div>
@endsection