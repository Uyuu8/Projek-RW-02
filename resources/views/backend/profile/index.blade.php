@extends('layouts.backend.app')

@section('title', 'Profile Settings')

@section('content')

    {{-- SUCCESS MESSAGE --}}
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <strong>{{ $message }}</strong>
        </div>
    @endif

    {{-- ERROR MESSAGE --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Data tidak valid!</strong>
        </div>
    @endif

    <div class="content-wrapper container-xxl p-0">
        <div class="content-body">

            <section id="page-account-settings">
                <div class="row">

                    {{-- ================= LEFT MENU ================= --}}
                    <div class="col-md-3 mb-2 mb-md-0">
                        <ul class="nav nav-pills flex-column nav-left">

                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="pill" href="#account-vertical-general">
                                    <i data-feather="user"></i> General
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" data-toggle="pill" href="#account-vertical-password">
                                    <i data-feather="lock"></i> Change Password
                                </a>
                            </li>

                        </ul>
                    </div>

                    {{-- ================= RIGHT CONTENT ================= --}}
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-body">
                                <div class="tab-content">

                                    {{-- ================= GENERAL TAB ================= --}}
                                    <div class="tab-pane active" id="account-vertical-general">

                                        <div class="media mb-2">
                                            @if ($profile->foto_profile)
                                                <img src="{{ asset('images/profile/' . $profile->foto_profile) }}"
                                                     class="rounded mr-2"
                                                     height="80"
                                                     width="80">
                                            @else
                                                <img src="{{ asset('Assets/Backend/images/user.png') }}"
                                                     class="rounded mr-2"
                                                     height="80"
                                                     width="80">
                                            @endif
                                        </div>

                                        <form action="{{ route('profile-settings.update', $profile->id) }}"
                                              method="POST"
                                              enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')

                                            <div class="row">

                                                <div class="col-md-6">
                                                    <label>Nama</label>
                                                    <input type="text"
                                                           name="name"
                                                           class="form-control"
                                                           value="{{ $profile->name }}">
                                                </div>

                                                <div class="col-md-6">
                                                    <label>Username</label>
                                                    <input type="text"
                                                           name="username"
                                                           class="form-control"
                                                           value="{{ $profile->username }}">
                                                </div>

                                                <div class="col-md-6 mt-1">
                                                    <label>Email</label>
                                                    <input type="email"
                                                           name="email"
                                                           class="form-control"
                                                           value="{{ $profile->email }}">
                                                </div>

                                                <div class="col-md-6 mt-1">
                                                    <label>Foto Profile</label>
                                                    <input type="file"
                                                           name="foto_profile"
                                                           class="form-control">
                                                    <small class="text-danger">
                                                        Kosongkan jika tidak ingin mengganti foto
                                                    </small>
                                                </div>

                                                @if ($profile->email_verified_at == null)
                                                    <div class="col-12 mt-2">
                                                        <div class="alert alert-warning">
                                                            Email belum diverifikasi
                                                        </div>
                                                    </div>
                                                @endif

                                                <div class="col-12 mt-2">
                                                    <button type="submit" class="btn btn-primary">
                                                        Update
                                                    </button>
                                                    <a href="/home" class="btn btn-secondary">
                                                        Batal
                                                    </a>
                                                </div>

                                            </div>
                                        </form>
                                    </div>

                                    {{-- ================= PASSWORD TAB ================= --}}
                                    <div class="tab-pane fade" id="account-vertical-password">

                                        <form action="{{ route('profile.change-password', $profile->id) }}"
                                              method="POST">
                                            @csrf
                                            @method('PUT')

                                            <div class="row">

                                                <div class="col-md-6">
                                                    <label>Password Saat Ini</label>
                                                    <input type="password"
                                                           name="current_password"
                                                           class="form-control @error('current_password') is-invalid @enderror">

                                                    @error('current_password')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>

                                            </div>

                                            <div class="row mt-1">

                                                <div class="col-md-6">
                                                    <label>Password Baru</label>
                                                    <input type="password"
                                                           name="password"
                                                           class="form-control @error('password') is-invalid @enderror">

                                                    @error('password')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>

                                                <div class="col-md-6">
                                                    <label>Ulangi Password</label>
                                                    <input type="password"
                                                           name="password_confirmation"
                                                           class="form-control @error('password_confirmation') is-invalid @enderror">

                                                    @error('password_confirmation')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>

                                            </div>

                                            <div class="mt-2">
                                                <button type="submit" class="btn btn-primary">
                                                    Update Password
                                                </button>
                                                <button type="reset" class="btn btn-secondary">
                                                    Cancel
                                                </button>
                                            </div>

                                        </form>
                                    </div>
                                    {{-- ================= END PASSWORD TAB ================= --}}

                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- ================= END RIGHT CONTENT ================= --}}

                </div>
            </section>

        </div>
    </div>

@endsection