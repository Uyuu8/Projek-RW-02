@extends('layouts.Frontend.page')

@section('title', 'Inventaris RW')

@section('content')
<div class="container my-5">
    <h3 class="mb-4 text-center">📦 Data Inventaris RW 02</h3>

    <div class="row">
        @forelse ($inventaris as $item)
            <div class="col-md-3 mb-4">
                <div class="card shadow-sm border-0">

                    @if ($item->foto)
                        <img src="{{ asset('images/inventaris/' . $item->foto) }}"
                        class="card-img-top img-inventaris">
                    @else
                        <div class="d-flex align-items-center justify-content-center bg-light"
                             style="height:200px;">
                            <span class="text-muted">Tidak ada foto</span>
                        </div>
                    @endif

                    <div class="card-body">
                        <h5 class="card-title">{{ $item->nama_barang }}</h5>

                        <p class="mb-1">
                            <strong>Kode:</strong> {{ $item->kode_barang }}
                        </p>

                        <p class="mb-1">
                            <strong>Jenis:</strong>
                            <span class="badge bg-info text-dark">
                                {{ ucfirst($item->jenis) }}
                            </span>
                        </p>

                        <p class="mb-0">
                            <strong>Periode:</strong>
                            {{ $item->bulan }}/{{ $item->tahun }}
                        </p>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center">
                <p class="text-muted">Belum ada data inventaris</p>
            </div>
        @endforelse
    </div>
</div>
@endsection
<style>
<style>

.card-inventaris{
    border-radius:12px;
    overflow:hidden;
    max-width:260px;
    margin:auto;
}

.img-inventaris{
    width:100%;
    height:200px;
    object-fit:cover;
}

.card-body{
    font-size:14px;
}

</style>
