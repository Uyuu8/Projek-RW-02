@extends('layouts.Frontend.page')

@section('title')
    Semua Berita
@endsection

@section('content')

<div class="section section-lg bg-lighter-grey" data-aos="fade-up">
    <div class="container">

        {{-- HEADER --}}
        <div class="tab-header">
            <div class="tab-header--title">
                Berita
            </div>

            <div class="tab-header--menu">
                <ul class="nav nav-tabs" id="myTab" role="tablist">

                    {{-- SEMUA --}}
                    <li class="nav-item" role="presentation">
                        <a href="{{ route('berita') }}"
                           class="nav-link {{ request()->has('kategori') ? '' : 'active-category' }}">
                            Semua
                        </a>
                    </li>

                    {{-- KATEGORI --}}
                    @foreach ($kategori as $kategoris)
                        <li class="nav-item" role="presentation">
                            <a class="nav-link {{ request('kategori') == $kategoris->id ? 'active' : '' }}"
                               href="{{ route('berita', ['kategori' => $kategoris->id]) }}">
                                {{ strtoupper($kategoris->nama) }}
                            </a>
                        </li>
                    @endforeach

                </ul>
            </div>
        </div>

        {{-- DAFTAR BERITA --}}
        <div class="row g-4">

            @forelse ($berita as $beritas)
                <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                    <div class="card shadow-sm border-0 h-100" style="border-radius: 0;">

                        <div class="card-img-top">
                            <img src="{{ asset('images/berita/' . $beritas->thumbnail) }}"
                                 class="img-fluid w-100"
                                 alt="{{ $beritas->title }}"
                                 style="height: 180px; object-fit: cover;">
                        </div>

                        <div class="card-body">
                            <p class="text-muted mb-2 small">
                                {{ \Carbon\Carbon::parse($beritas->created_at)->translatedFormat('d F Y') }}
                            </p>

                            <h6 class="card-title"
                                style="min-height: 50px; word-break: break-word;">

                                <a href="{{ route('detail.berita', $beritas->slug) }}"
                                   class="text-dark text-decoration-none">
                                    {{ $beritas->title }}
                                </a>

                            </h6>
                        </div>
                    </div>
                </div>
            @empty
                {{-- EMPTY STATE --}}
                <div class="col-12 text-center">
                    <img src="{{ asset('Assets/Frontend/img/empty.svg') }}"
                         class="img-fluid"
                         style="max-width: 300px;"
                         alt="No News">
                    <p class="mt-3">Tidak ada berita yang ditemukan.</p>
                </div>
            @endforelse

        </div>

        {{-- PAGINATION --}}
        <div class="mt-4 d-flex justify-content-center">
            {{ $berita->links('frontend.content.paginate') }}
        </div>

    </div>
</div>

@endsection
