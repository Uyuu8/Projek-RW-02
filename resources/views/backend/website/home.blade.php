@extends('layouts.backend.app')

@section('title')
Dashboard
@endsection

@section('content')
<div class="content-wrapper container-xxl p-0">
<div class="content-body">

<div class="row">

<div class="col-md-3">
<div class="card">
<div class="card-body">
<h5>Total Warga</h5>
<h2>{{ $totalWarga }}</h2>
</div>
</div>
</div>

<div class="col-md-3">
<div class="card">
<div class="card-body">
<h5>Total User</h5>
<h2>{{ $totalUser }}</h2>
</div>
</div>
</div>

<div class="col-md-3">
<div class="card">
<div class="card-body">
<h5>Inventaris RW</h5>
<h2>{{ $totalInventaris }}</h2>
</div>
</div>
</div>

<div class="col-md-3">
<div class="card">
<div class="card-body">
<h5>Total Berita</h5>
<h2>{{ $totalBerita }}</h2>
</div>
</div>
</div>

</div>

<div class="row mt-2">
<div class="col-md-12">
<div class="card">
<div class="card-body">
<h4>Total Kas RW</h4>
<h2>Rp {{ number_format($totalKas,0,',','.') }}</h2>
</div>
</div>
</div>
</div>

</div>
</div>
@endsection