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

            {{-- FILTER --}}
            <form method="GET" action="{{ route('backend-warga.index') }}" class="row mb-3">
                <div class="col-md-4">
                    <input type="text" name="search" class="form-control"
                        placeholder="Cari nama / NIK / KK..."
                        value="{{ request('search') }}">
                </div>

                <div class="col-md-3">
                    <select name="rt" class="form-control">
                        <option value="">-- Semua RT --</option>
                        @foreach ($listRt as $rt)
                            <option value="{{ $rt }}" {{ request('rt') == $rt ? 'selected' : '' }}>
                                RT {{ $rt }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3">
                    <button class="btn btn-primary btn-sm">🔍 Cari</button>
                    <a href="{{ route('backend-warga.index') }}" class="btn btn-secondary btn-sm">
                        Reset
                    </a>
                </div>
            </form>

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
                        data-toggle="modal"
                        data-target="#importModal">
                    Import Excel
                </button>
            </div>

            {{-- TABLE --}}
            <div class="table-responsive">
                <table class="table table-bordered table-sm table-hover">
                    <thead class="thead-light text-center">
                        <tr>
                            <th>No</th>
                            <th>NIK</th>
                            <th>No KK</th>
                            <th>Nama</th>
                            <th>JK</th>
                            <th>TTL</th>
                            <th>Alamat</th>
                            <th>RT</th>
                            <th>RW</th>
                            <th>Pendidikan</th>
                            <th>Agama</th>
                            <th>Status</th>
                            <th>No HP</th>
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
                            <td>{{ $warga->alamat }}</td>
                            <td class="text-center">{{ $warga->rt }}</td>
                            <td class="text-center">{{ $warga->rw }}</td>
                            <td>{{ $warga->pendidikan }}</td>
                            <td>{{ $warga->agama }}</td>
                            <td class="text-center">
                                <span class="badge badge-info">
                                    {{ $warga->status_warga }}
                                </span>
                            </td>
                            <td>{{ $warga->no_hp }}</td>
                            <td class="text-center">
                                <a href="{{ route('backend-warga.edit', $warga->id) }}"
                                   class="btn btn-warning btn-sm">
                                    Edit
                                </a>

                                <form action="{{ route('backend-warga.destroy', $warga->id) }}"
                                      method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm"
                                        onclick="return confirm('Hapus data warga ini?')">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
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

            {{-- PAGINATION --}}
            <div class="mt-3">
                {{ $wargas->links() }}
            </div>

        </div>
    </div>
</div>

{{-- MODAL IMPORT --}}
<div class="modal fade" id="importModal" tabindex="-1">
    <div class="modal-dialog">
        <form action="{{ route('backend-warga.import') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Import Data Warga</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">
                    <input type="file" name="file" class="form-control" required>
                    <small class="text-muted">
                        Format file: .xlsx / .xls
                    </small>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button class="btn btn-success">Import</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
