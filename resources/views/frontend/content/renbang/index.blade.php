@extends('layouts.Frontend.page')

@section('title','Renbang RW')

@section('content')

<div class="container my-5">

    <h3 class="text-center mb-4">
        📑 Dokumen Rencana Pembangunan RW
    </h3>

    <div class="">

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered table-striped align-middle">

                    <thead class="table-dark text-center">
                        <tr>
                            <th width="60">No</th>
                            <th width="120">Tahun</th>
                            <th>Keterangan</th>
                            <th width="150">Dokumen</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($renbang as $item)

                        <tr>

                            <td class="text-center">
                                {{ $loop->iteration }}
                            </td>

                            <td class="text-center">
                                <strong>{{ $item->tahun }}</strong>
                            </td>

                            <td>
                                {{ $item->keterangan ?? '-' }}
                            </td>

                            <td class="text-center">

                                <a href="{{ asset('files/renbang/'.$item->file) }}"
                                   target="_blank"
                                   class="btn btn-sm btn-primary">

                                    📄 Lihat PDF

                                </a>

                                <a href="{{ asset('files/renbang/'.$item->file) }}"
                                   download
                                   class="btn btn-sm btn-success">

                                    ⬇ Download

                                </a>

                            </td>

                        </tr>

                        @empty

                        <tr>
                            <td colspan="4" class="text-center text-muted">
                                Belum ada dokumen Renbang
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