@extends('layouts.backend.app')

@section('title','Edit Data Warga')

@section('content')
<div class="container-fluid">

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Data Warga</h6>
        </div>

        <div class="card-body">

            {{-- Error Validation --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('backend-warga.update', $warga) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">

                    {{-- KIRI --}}
                    <div class="col-md-6">

                        <div class="form-group">
                            <label>NIK</label>
                            <input type="text" name="nik" class="form-control"
                                   value="{{ old('nik', $warga->nik) }}" required>
                        </div>

                        <div class="form-group">
                            <label>No KK</label>
                            <input type="text" name="no_kk" class="form-control"
                                   value="{{ old('no_kk', $warga->no_kk) }}">
                        </div>

                        <div class="form-group">
                            <label>Nama Lengkap</label>
                            <input type="text" name="nama_lengkap" class="form-control"
                                   value="{{ old('nama_lengkap', $warga->nama_lengkap) }}" required>
                        </div>

                        <div class="form-group">
                            <label>Tempat Lahir</label>
                            <input type="text" name="tempat_lahir" class="form-control"
                                   value="{{ old('tempat_lahir', $warga->tempat_lahir) }}" required>
                        </div>

                        <div class="form-group">
                            <label>Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir" class="form-control"
                                   value="{{ old('tanggal_lahir', $warga->tanggal_lahir) }}" required>
                        </div>

                        <div class="form-group">
                            <label>Jenis Kelamin</label>
                            <select name="jenis_kelamin" class="form-control" required>
                                <option value="">-- Pilih --</option>
                                <option value="Laki-laki"
                                    {{ old('jenis_kelamin',$warga->jenis_kelamin)=='Laki-laki'?'selected':'' }}>
                                    Laki-laki
                                </option>
                                <option value="Perempuan"
                                    {{ old('jenis_kelamin',$warga->jenis_kelamin)=='Perempuan'?'selected':'' }}>
                                    Perempuan
                                </option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Alamat</label>
                            <textarea name="alamat" class="form-control" rows="3">{{ old('alamat',$warga->alamat) }}</textarea>
                        </div>

                    </div>

                    {{-- KANAN --}}
                    <div class="col-md-6">

                        <div class="form-group">
                            <label>RT</label>
                            <input type="text" name="rt" class="form-control"
                                   value="{{ old('rt', $warga->rt) }}" required>
                        </div>

                        <div class="form-group">
                            <label>RW</label>
                            <input type="text" name="rw" class="form-control"
                                   value="{{ old('rw', $warga->rw) }}" required>
                        </div>

                        <div class="form-group">
                            <label>Pendidikan</label>
                            <select name="pendidikan" class="form-control">
                                <option value="">-- Pilih --</option>
                                @foreach (['Dasar','Menengah','Tinggi'] as $item)
                                    <option value="{{ $item }}"
                                        {{ old('pendidikan',$warga->pendidikan)==$item?'selected':'' }}>
                                        {{ $item }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Agama</label>
                            <select name="agama" class="form-control">
                                <option value="">-- Pilih --</option>
                                @foreach (['Islam','Kristen','Hindu','Buddha','Lainnya'] as $item)
                                    <option value="{{ $item }}"
                                        {{ old('agama',$warga->agama)==$item?'selected':'' }}>
                                        {{ $item }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Status Keluarga</label>
                            <select name="status_keluarga" class="form-control">
                                @foreach (['Kepala Keluarga','Istri','Anak','Lainnya'] as $item)
                                    <option value="{{ $item }}"
                                        {{ old('status_keluarga',$warga->status_keluarga)==$item?'selected':'' }}>
                                        {{ $item }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Status Perkawinan</label>
                            <select name="status_perkawinan" class="form-control">
                                @foreach (['Belum Kawin','Kawin','Cerai'] as $item)
                                    <option value="{{ $item }}"
                                        {{ old('status_perkawinan',$warga->status_perkawinan)==$item?'selected':'' }}>
                                        {{ $item }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Pekerjaan</label>
                            <input type="text" name="pekerjaan" class="form-control"
                                   value="{{ old('pekerjaan', $warga->pekerjaan) }}">
                        </div>

                        <div class="form-group">
                            <label>No HP</label>
                            <input type="text" name="no_hp" class="form-control"
                                   value="{{ old('no_hp', $warga->no_hp) }}">
                        </div>

                        <div class="form-group">
                            <label>Status Warga</label>
                            <select name="status_warga" class="form-control" required>
                                @foreach (['Aktif','Pindah','Meninggal'] as $item)
                                    <option value="{{ $item }}"
                                        {{ old('status_warga',$warga->status_warga)==$item?'selected':'' }}>
                                        {{ $item }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                </div>

                <div class="text-right mt-3">
                    <a href="{{ route('backend-warga.index') }}" class="btn btn-secondary">
                        Kembali
                    </a>
                    <button class="btn btn-primary">
                        Update Data
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>
@endsection
