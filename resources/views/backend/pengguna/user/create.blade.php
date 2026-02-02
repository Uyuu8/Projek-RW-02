@extends('layouts.backend.app')

@section('content')
<div class="container-fluid">

<h4 class="mb-3">Tambah User</h4>

@if ($errors->any())
<div class="alert alert-danger">
    <ul class="mb-0">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="card">
<div class="card-body">

<form action="{{ route('backend-pengguna-user.store') }}" 
      method="POST" 
      enctype="multipart/form-data">

@csrf

<div class="row">

    <div class="col-md-6">
        <div class="form-group mb-2">
            <label>Nama</label>
            <input type="text" name="name" class="form-control" required>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group mb-2">
            <label>Username</label>
            <input type="text" name="username" class="form-control" required>
        </div>
    </div>

</div>


<div class="row">

    <div class="col-md-6">
        <div class="form-group mb-2">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group mb-2">
            <label>Role</label>
            <select name="role" class="form-control" required>
                <option value="">-- Pilih Role --</option>
                <option>Admin</option>
                <option>Ketua RW</option>
                <option>Sekretaris</option>
                <option>Bendahara</option>
                <option>Tarka</option>
            </select>
        </div>
    </div>

</div>


<div class="row">

    <div class="col-md-6">
        <div class="form-group mb-2">
            <label>Status</label>
            <select name="status" class="form-control" required>
                <option>Aktif</option>
                <option>Tidak Aktif</option>
            </select>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group mb-2">
            <label>Foto Profile</label>
            <input type="file" name="foto_profile" class="form-control">
        </div>
    </div>

</div>


<div class="alert alert-info mt-3">
    Password default user: <b>123456</b>
</div>


<div class="mt-3">
    <button class="btn btn-success">
        <i class="fa fa-save"></i> Simpan
    </button>

    <a href="{{ route('backend-pengguna-user.index') }}" class="btn btn-secondary">
        Kembali
    </a>
</div>

</form>

</div>
</div>

</div>
@endsection
