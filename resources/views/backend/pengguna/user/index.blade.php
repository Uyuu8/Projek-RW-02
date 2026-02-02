@extends('layouts.backend.app')

@section('content')
<div class="container-fluid">

    <h4 class="mb-3">Manajemen User</h4>

    @if(Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
    @endif

    <a href="{{ route('backend-pengguna-user.create') }}" class="btn btn-primary mb-3">
        <i class="fa fa-plus"></i> Tambah User
    </a>

    <div class="card">
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Foto</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($users as $key => $user)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role }}</td>
                        <td>
                            @if($user->status == 'Aktif')
                                <span class="badge bg-success">Aktif</span>
                            @else
                                <span class="badge bg-danger">Tidak Aktif</span>
                            @endif
                        </td>

                        <td>
                            @if($user->foto_profile)
                                <img src="{{ asset('uploads/profile/'.$user->foto_profile) }}" width="60">
                            @else
                                -
                            @endif
                        </td>

                        <td>
                            <a href="{{ route('backend-pengguna-user.edit',$user->id) }}" 
                               class="btn btn-warning btn-sm">
                                Edit
                            </a>

                            <form action="{{ route('backend-pengguna-user.destroy',$user->id) }}" 
                                  method="POST" style="display:inline">
                                @csrf
                                @method('DELETE')

                                <button class="btn btn-danger btn-sm"
                                        onclick="return confirm('Yakin ingin menghapus user ini?')">
                                    Hapus
                                </button>
                            </form>
                        </td>

                    </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>

</div>
@endsection
