@extends('layouts.backend.app')

@section('title', 'Data Inventaris')

@section('content')
<div class="container-fluid">

    <div class="card shadow mb-4">

        {{-- HEADER --}}
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Data Inventaris</h6>

            <a href="{{ route('backend.website.inventaris.create') }}"
               class="btn btn-primary btn-sm">
                Tambah Inventaris
            </a>
        </div>

        <div class="card-body">

            {{-- ALERT --}}
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            {{-- TABLE --}}
            <div class="table-responsive">
                <table class="table table-bordered table-sm table-hover">
                    <thead class="thead-light text-center">
                        <tr>
                            <th width="50">No</th>
                            <th>Kode</th>
                            <th>Nama Barang</th>
                            <th>Jenis</th>
                            <th>Periode</th>
                            <th>Foto</th>
                            <th width="150">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($inventaris as $i)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $i->kode_barang }}</td>
                            <td>{{ $i->nama_barang }}</td>

                            <td class="text-center">
                                <span class="badge badge-info">
                                    {{ ucfirst($i->jenis) }}
                                </span>
                            </td>

                            <td class="text-center">
                                {{ $i->bulan }}/{{ $i->tahun }}
                            </td>

                            <td class="text-center">
                                @if($i->foto)
                                    <img src="{{ asset('images/inventaris/'.$i->foto) }}"
                                         width="70"
                                         class="img-thumbnail">
                                @else
                                    <span class="text-muted">Tidak ada</span>
                                @endif
                            </td>

                            <td class="text-center">
                                <a href="{{ route('backend.website.inventaris.edit', $i->id) }}"
                                   class="btn btn-warning btn-sm">
                                    Edit
                                </a>

                                <form action="{{ route('backend.website.inventaris.destroy', $i->id) }}"
                                      method="POST"
                                      class="d-inline">
                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-danger btn-sm"
                                        onclick="return confirm('Hapus data inventaris ini?')">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center">
                                Data inventaris belum tersedia
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
@endsection
