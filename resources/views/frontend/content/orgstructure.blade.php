@extends('layouts.Frontend.app')

@section('title', 'Organisasi')

@section('content')
    <div class="section section-lg pb-0" style="background-color: white;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <!-- Breadcrumb -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb p-0 bg-white">
                            <li class="breadcrumb-item"><a href="#">Beranda</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Organisasi</li>
                        </ol>
                    </nav>
                    <!-- Page Title -->
                    <div class="d-block">
                        <h1 class="mb-lg-4 mb-3">Struktur Organisasi</h1>
                    </div>
                    <!-- Org Chart -->
                    <div id="chart-container"></div>
                </div>
            </div>
        </div>
    </div>
@endsection
