@extends('layouts.Frontend.app')

@section('title')
    Berita
@endsection

@section('content')
<div class="container">
    <div class="row">
        <!-- Berita berdasarkan kategori -->
        <div class="col-lg-12">
            <h2 class="mb-4">Berita Kategori: {{ $kategoriTerpilih->nama }}</h2>
        </div>
        
        <!-- Tampilkan kategori di atas -->
        <div class="col-lg-12 mb-4">
            <div class="categories-navbar">
                <ul class="nav nav-pills justify-content-center">
                    @foreach ($kategori as $kategoris)
                        <li class="nav-item">
                            <a class="nav-link {{ $kategoriTerpilih->id == $kategoris->id ? 'active' : '' }}" 
                               href="{{ route('berita.kategori', $kategoris->id) }}">
                                {{ $kategoris->nama }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <!-- Daftar berita -->
        @forelse ($berita as $item)
            <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                <div class="card news-box">
                    <div class="news-img-holder">
                        <img src="{{ asset('storage/' . $item->thumbnail) }}" class="img-fluid" alt="{{ $item->judul }}" />
                        <ul class="news-date">
                            <li>{{ Carbon\Carbon::parse($item->created_at)->format('d M') }}</li>
                            <li>{{ Carbon\Carbon::parse($item->created_at)->format('Y') }}</li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title title-news-left-bold">
                            <a href="{{ route('detail.berita', $item->slug) }}">{{ $item->judul }}</a>
                        </h5>
                        <p class="card-text">{{ Str::limit($item->konten, 150, '...') }}</p>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-lg-12">
                <p>Tidak ada berita untuk kategori ini.</p>
            </div>
        @endforelse

        <!-- Pagination -->
        <div class="col-lg-12 mt-4">
            {{ $berita->links() }}
        </div>
    </div>
</div>
@endsection
