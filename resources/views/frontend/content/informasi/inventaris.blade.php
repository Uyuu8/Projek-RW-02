@extends('layouts.frontend.page')

@section('title', 'Inventaris RW')

@section('content')
<div class="container my-5">
    <h3 class="mb-4 text-center">📦 Data Inventaris RW 02</h3>

    <div class="row">
        @forelse ($inventaris as $item)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    
                    @if ($item->foto)
                        <img src="{{ asset('storage/' . $item->foto) }}"
                             class="card-img-top"
                             style="height:200px; object-fit:cover;">
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
