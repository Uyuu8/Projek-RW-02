@extends('layouts.backend.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h4>Edit Data Bantuan Sosial</h4>
    </div>

    <div class="card-body">

        {{-- Tampilkan Error Validasi --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Terjadi kesalahan!</strong>
                <ul class="mb-0 mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('backend.website.bansos.update', $bansos->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row">

                <div class="col-md-6 mb-3">
                    <label>Uraian Bansos</label>
                    <input type="text"
                           name="uraian_bansos"
                           class="form-control"
                           value="{{ old('uraian_bansos', $bansos->uraian_bansos) }}"
                           required>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Jenis Bantuan</label>
                    <input type="text"
                           name="jenis_bantuan"
                           class="form-control"
                           value="{{ old('jenis_bantuan', $bansos->jenis_bantuan) }}"
                           required>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Tahun</label>
                    <input type="number"
                           name="tahun"
                           class="form-control"
                           value="{{ old('tahun', $bansos->tahun) }}"
                           required>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Diselenggarakan Oleh</label>
                    <input type="text"
                           name="diselenggarakan_oleh"
                           class="form-control"
                           value="{{ old('diselenggarakan_oleh', $bansos->diselenggarakan_oleh) }}"
                           required>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Disalurkan Melalui</label>
                    <input type="text"
                           name="disalurkan_melalui"
                           class="form-control"
                           value="{{ old('disalurkan_melalui', $bansos->disalurkan_melalui) }}"
                           required>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Kategori Penerima</label>
                    <input type="text"
                           name="kategori_penerima"
                           class="form-control"
                           value="{{ old('kategori_penerima', $bansos->kategori_penerima) }}"
                           required>
                </div>

            </div>

            <div class="mt-3">
                <button type="submit" class="btn btn-success">
                    Update
                </button>

                <a href="{{ route('backend.website.bansos.index') }}"
                   class="btn btn-secondary">
                    Kembali
                </a>
            </div>

        </form>
    </div>
</div>
@endsection
