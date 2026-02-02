@extends('layouts.backend.app')

@section('content')
<div class="container-fluid">

<h4 class="mb-3">Edit User</h4>

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

<form action="{{ route('backend-pengguna-user.update', $user->id) }}" 
      method="POST" 
      enctype="multipart/form-data">

@csrf
@method('PUT')

<div class="row">

    <div class="col-md-6">
        <div class="form-group mb-2">
            <label>Nama</label>
            <input type="text" name="name" class="form-control" 
                   value="{{ $user->name }}" required>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group mb-2">
            <label>Username</label>
            <input type="text" name="username" class="form-control" 
                   value="{{ $user->username }}" required>
        </div>
    </div>

</div>


<div class="row">

    <div class="col-md-6">
        <div class="form-group mb-2">
            <label>Email</label>
            <input type="email" name="email" class="form-control" 
                   value="{{ $user->email }}" required>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group mb-2">
            <label>Role</label>
            <select name="role" class="form-control" required>
                <option value="">-- Pilih Role --</option>
                <option value="Admin" {{ $user->role == 'Admin' ? 'selected' : '' }}>Admin</option>
                <option value="Ketua RW" {{ $user->role == 'Ketua RW' ? 'selected' : '' }}>Ketua RW</option>
                <option value="Sekretaris" {{ $user->role == 'Sekretaris' ? 'selected' : '' }}>Sekretaris</option>
                <option value="Bendahara" {{ $user->role == 'Bendahara' ? 'selected' : '' }}>Bendahara</option>
                <option value="Tarka" {{ $user->role == 'Tarka' ? 'selected' : '' }}>Tarka</option>
            </select>
        </div>
    </div>

</div>


<div class="row">

    <div class="col-md-6">
        <div class="form-group mb-2">
            <label>Status</label>
            <select name="status" class="form-control" required>
                <option value="Aktif" {{ $user->status == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                <option value="Tidak Aktif" {{ $user->status == 'Tidak Aktif' ? 'selected' : '' }}>Tidak Aktif</option>
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


@if($user->foto_profile)
<div class="mt-2">
    <label>Foto Saat Ini:</label><br>
    <img src="{{ asset('uploads/user/'.$user->foto_profile) }}" 
         width="120" 
         class="img-thumbnail">
</div>
@endif


<div class="alert alert-warning mt-3">
    Kosongkan foto jika tidak ingin mengganti foto profile
</div>


<div class="mt-3">
    <button class="btn btn-primary">
        <i class="fa fa-save"></i> Update
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
