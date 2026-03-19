@extends('layouts.backend.app')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between">
        <h4>Data Bantuan Sosial</h4>
        <a href="{{ route('backend.website.bansos.create') }}" class="btn btn-primary">
            Tambah
        </a>
    </div>

    <div class="card-body">

        {{-- Notifikasi Success --}}
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>URAIAN BANSOS</th>
                    <th>JENIS BANTUAN</th>
                    <th>TAHUN</th>
                    <th>DISELENGGARAKAN OLEH</th>
                    <th>DISALURKAN MELALUI</th>
                    <th>KATEGORI PENERIMA</th>
                    <th>AKSI</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($bansos as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->uraian_bansos }}</td>
                    <td>{{ $item->jenis_bantuan }}</td>
                    <td>{{ $item->tahun }}</td>
                    <td>{{ $item->diselenggarakan_oleh }}</td>
                    <td>{{ $item->disalurkan_melalui }}</td>
                    <td>{{ $item->kategori_penerima }}</td>
                    <td>
                        <a href="{{ route('backend.website.bansos.penerima.index',$item->id) }}"
                        class="btn btn-info btn-sm">
                        Penerima
                        </a>
                        <a href="{{ route('backend.website.bansos.edit', $item->id) }}"
                           class="btn btn-warning btn-sm">
                            Edit
                        </a>

                        <form action="{{ route('backend.website.bansos.destroy', $item->id) }}"
                              method="POST"
                              class="d-inline">
                            @csrf
                            @method('DELETE')

                            <button onclick="return confirm('Hapus data?')"
                                    class="btn btn-danger btn-sm">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" class="text-center">
                        Data belum tersedia
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
