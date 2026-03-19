@extends('layouts.backend.app')

@section('content')

<div class="container-fluid" style="min-height: 80vh;">

    <h4 class="mb-4">Tambah Penerima Bansos</h4>

    <div class="card shadow">
        <div class="card-body" style="min-height: 300px;">

            <form action="{{ route('backend.website.bansos.penerima.store',$bansos->id) }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Warga</label>
                    <select name="warga_id" class="form-select select2" required>
                        <option value="">-- pilih warga --</option>
                        @foreach($warga as $w)
                            <option value="{{ $w->id }}">
                                {{ $w->nama_lengkap }} - {{ $w->nik }} - RT {{ $w->rt }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="d-flex gap-2">
                    <button class="btn btn-primary">Simpan</button>

                    <a href="{{ route('backend.website.bansos.penerima.index',$bansos->id) }}"
                       class="btn btn-secondary">
                        Kembali
                    </a>
                </div>

            </form>

        </div>
    </div>

</div>

@endsection

@push('scripts')
<script>
$(document).ready(function () {
    $('.select2').select2({
        placeholder: "Cari warga...",
        allowClear: true,
        dropdownParent: $('body')
    });
});
</script>
@endpush
