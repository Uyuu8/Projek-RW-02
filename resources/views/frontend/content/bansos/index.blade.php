@extends('layouts.frontend.page')

@section('title', 'bansos')

@section('content')
<div class="container my-5">
    <h3 class="mb-4 text-center">PORTAL BANSOS WARGA RW 02</h3>

    <div class="row">
        @forelse ($bansos as $item)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">

                    {{-- HEADER CARD --}}
                    <div class="card-header bg-success text-white text-center">
                        <strong>{{ $item->uraian_bansos }}</strong>
                    </div>

                    {{-- BODY --}}
                    <div class="card-body">
                        <p class="mb-2">
                            <strong>Jenis Bantuan:</strong><br>
                            <span class="badge bg-info text-dark">
                                {{ $item->jenis_bantuan }}
                            </span>
                        </p>

                        <p class="mb-2">
                            <strong>Tahun:</strong><br>
                            {{ $item->tahun }}
                        </p>

                        <p class="mb-2">
                            <strong>Diselenggarakan Oleh:</strong><br>
                            {{ $item->diselenggarakan_oleh }}
                        </p>

                        <p class="mb-2">
                            <strong>Disalurkan Melalui:</strong><br>
                            {{ $item->disalurkan_melalui }}
                        </p>

                        <p class="mb-2">
                            <strong>Kategori Penerima:</strong><br>
                            <span class="badge bg-warning text-dark">
                                {{ $item->kategori_penerima }}
                            </span>
                        </p>

                        <p class="mb-0">
                            <strong>Penerima:</strong><br>
                            {{ $item->penerima }}
                        </p>
                    </div>

                </div>
            </div>
        @empty
            <div class="col-12 text-center">
                <p class="text-muted">Belum ada data bantuan sosial</p>
            </div>
        @endforelse
    </div>
</div>
@endsection
