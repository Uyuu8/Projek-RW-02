@extends('layouts.backend.app')

@section('title', 'Tambah Inventaris')

@section('content')
<div class="container-fluid">

    <div class="card shadow mb-4">

        {{-- HEADER --}}
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                Tambah Inventaris
            </h6>
        </div>

        <div class="card-body">

            {{-- ERROR --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('backend.website.inventaris.store') }}"
                  method="POST"
                  enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label>Nama Barang</label>
                    <input type="text"
                           name="nama_barang"
                           class="form-control"
                           value="{{ old('nama_barang') }}"
                           required>
                </div>

                <div class="form-group">
                    <label>Jenis</label>
                    <select name="jenis" class="form-control" required>
                        <option value="">-- Pilih Jenis --</option>
                        <option value="electronic">Electronic</option>
                        <option value="non-electronic">Non Electronic</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Bulan</label>
                    <input type="text"
                           name="bulan"
                           placeholder="02"
                           class="form-control"
                           value="{{ old('bulan') }}"
                           required>
                </div>

                <div class="form-group">
                    <label>Tahun</label>
                    <input type="text"
                           name="tahun"
                           placeholder="2026"
                           class="form-control"
                           value="{{ old('tahun') }}"
                           required>
                </div>

                <div class="form-group">
                    <label>Foto</label>
                    <input type="file" name="foto" class="form-control">
                    <small class="text-muted">
                        Format: jpg, png, jpeg (max 2MB)
                    </small>
                </div>

                <button class="btn btn-primary">
                    Simpan
                </button>

                <a href="{{ route('backend.website.inventaris.index') }}"
                   class="btn btn-secondary">
                    Kembali
                </a>
            </form>

        </div>
    </div>
</div>
@endsection
