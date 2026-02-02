@extends('layouts.Frontend.app')

@section('title')
    {{$berita->title}}
@endsection

@section('content')
    @section('about')
    <div class="news-details-page-area">
        <div class="news-container">
            <div class="row">
                <!-- Konten Utama -->
                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                    <div class="news-details-content">
                        <h1 class="news-title">{{ $berita->title }}</h1>
                        <div class="news-meta">
                            <span>{{ Carbon\Carbon::parse($berita->created_at)->format('l, d F Y') }}</span>
                            <span> | Reporter: {{ $berita->user->name }}</span>
                        </div>
                        <hr class="news-divider">
                        <div class="news-img-holder">
                            <img src="{{ asset('storage/images/berita/' . $berita->thumbnail) }}" class="img-responsive" alt="news">
                        </div>
                        <div class="news-content">
                            {!! $berita->content !!}
                        </div>                        
                    </div>
                </div>
    
                <!-- Sidebar -->
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                    <div class="news-sidebar">
                        <h3 class="sidebar-title">Berita</h3>
                        <ul class="news-sidebar-list">
                            @foreach ($beritaOther as $beritas)
                            <li class="news-sidebar-item">
                                <a href="{{ route('detail.berita', $beritas->slug) }}">
                                    <div class="sidebar-thumbnail">
                                        <img src="{{ asset('storage/images/berita/' . $beritas->thumbnail) }}" alt="berita">
                                    </div>
                                    <div class="sidebar-info">
                                        <h4 class="sidebar-news-title">{{ $beritas->title }}</h4>
                                        <p class="sidebar-news-date">{{ Carbon\Carbon::parse($beritas->created_at)->format('d F Y') }}</p>
                                    </div>
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    @endsection
@endsection
