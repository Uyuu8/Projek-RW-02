@extends('layouts.backend.app')

@section('title','Tambah Data Warga')

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('backend-warga.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label>NIK</label>
                <input type="text" name="nik" class="form-control" required>
            </div>

            <div class="form-group">
                <label>No KK</label>
                <input type="text" name="no_kk" class="form-control">
            </div>

            <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" name="nama_lengkap" class="form-control" required>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Tempat Lahir</label>
                        <input type="text" name="tempat_lahir" class="form-control" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" class="form-control" required>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label>Jenis Kelamin</label>
                <select name="jenis_kelamin" class="form-control" required>
                    <option value="">-- Pilih --</option>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>

            <div class="form-group">
                <label>Alamat</label>
                <textarea name="alamat" class="form-control"></textarea>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>RT</label>
                        <select name="rt" class="form-control" required>
                            <option value="">-- Pilih RT --</option>
                            @for ($i = 1; $i <= 8; $i++)
                                <option value="{{ sprintf('%02d', $i) }}">
                                    {{ sprintf('%02d', $i) }}
                                </option>
                            @endfor
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>RW</label>
                        <input type="hidden" name="rw" value="02">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Pendidikan</label>
                        <select name="pendidikan" class="form-control" required>
                            <option value="">-- Pilih Pendidikan --</option>
                            <option value="Tidak Sekolah">Tidak Sekolah</option>
                            <option value="SD">SD</option>
                            <option value="SMP">SMP</option>
                            <option value="SMA/SMK">SMA/SMK</option>
                            <option value="D3">D3</option>
                            <option value="S1">S1</option>
                            <option value="S2">S2</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Agama</label>
                        <select name="agama" class="form-control" required>
                            <option value="">-- Pilih Agama --</option>
                            <option value="Islam">Islam</option>
                            <option value="Kristen">Kristen</option>
                            <option value="Hindu">Hindu</option>
                            <option value="Buddha">Buddha</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label>Status Keluarga</label>
                <select name="status_keluarga" class="form-control">
                    <option value="Kepala Keluarga">Kepala Keluarga</option>
                    <option value="Istri">Istri</option>
                    <option value="Anak">Anak</option>
                </select>
            </div>

            <div class="form-group">
                <label>Status Perkawinan</label>
                <select name="status_perkawinan" class="form-control">
                    <option value="Belum Kawin">Belum Kawin</option>
                    <option value="Kawin">Kawin</option>
                    <option value="Cerai">Cerai</option>
                </select>
            </div>

            <div class="form-group">
                <label>Pekerjaan</label>
                <input type="text" name="pekerjaan" class="form-control">
            </div>

            <div class="form-group">
                <label>No HP</label>
                <input type="text" name="no_hp" class="form-control">
            </div>

            <div class="form-group">
                <label>Status Warga</label>
                <select name="status_warga" class="form-control" required>
                    <option value="Aktif">Aktif</option>
                    <option value="Pindah">Pindah</option>
                    <option value="Meninggal">Meninggal</option>
                </select>
            </div>

            <button class="btn btn-primary">Simpan</button>
            <a href="{{ route('backend-warga.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
@endsection
