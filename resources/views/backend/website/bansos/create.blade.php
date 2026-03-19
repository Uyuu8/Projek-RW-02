@extends('layouts.backend.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h4>Tambah Data Bantuan Sosial</h4>
    </div>

    <div class="card-body">
        <form action="{{ route('backend.website.bansos.store') }}" method="POST">
            @csrf

            <div class="row">

                <div class="col-md-6 mb-3">
                    <label>Uraian Bansos</label>
                    <input type="text" name="uraian_bansos" class="form-control" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Jenis Bantuan</label>
                    <input type="text" name="jenis_bantuan" class="form-control" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Tahun</label>
                    <input type="number" name="tahun" class="form-control" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Diselenggarakan Oleh</label>
                    <input type="text" name="diselenggarakan_oleh" class="form-control" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Disalurkan Melalui</label>
                    <input type="text" name="disalurkan_melalui" class="form-control" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Kategori Penerima</label>
                    <input type="text" name="kategori_penerima" class="form-control" required>
                </div>

            </div>

            <div class="mt-3">
                <button type="submit" class="btn btn-success">
                    Simpan
                </button>
                <a href="{{ route('backend.website.bansos.index') }}" class="btn btn-secondary">
                    Kembali
                </a>
            </div>

        </form>
    </div>
</div>
@endsection
