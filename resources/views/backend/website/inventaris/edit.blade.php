@extends('layouts.backend.app')

@section('title', 'Edit Inventaris')

@section('content')
<div class="container-fluid">

    <div class="card shadow mb-4">

        {{-- HEADER --}}
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                Edit Inventaris
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

            <form action="{{ route('backend.website.inventaris.update', $inventari->id) }}"
                  method="POST"
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label>Nama Barang</label>
                    <input type="text"
                           name="nama_barang"
                           class="form-control"
                           value="{{ old('nama_barang', $inventari->nama_barang) }}"
                           required>
                </div>

                <div class="form-group">
                    <label>Foto (Opsional)</label>
                    <input type="file" name="foto" class="form-control">
                </div>

                {{-- FOTO SAAT INI --}}
                @if ($inventari->foto)
                    <div class="form-group">
                        <label>Foto Saat Ini</label><br>
                        <img src="{{ asset('images/inventaris/'.$inventari->foto) }}"
                             width="150"
                             class="img-thumbnail">
                    </div>
                @endif

                <button class="btn btn-primary">
                    Update
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
