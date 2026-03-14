<div class="section section-lg bg-lighter-grey" data-aos="fade-up">
    <div class="container">
        <div class="tab-header">
            <div class="tab-header--title">
                Berita
            </div>
            <div class="tab-header--menu">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a href="{{ route('index') }}" role="tab"aria-selected="true" class=" nav-link {{ request()->has('kategori') ? '' : 'active-category' }}">Semua</a>
                    </li>
                    @foreach ($kategori as $kategoris)
                        <li class="nav-item" role="presentation">
                            <a class="nav-link {{ request('kategori') == $kategoris->id ? 'active' : '' }}" href="{{ route('index', ['kategori' => $kategoris->id]) }}">
                                {{ strtoupper($kategoris->nama) }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

         <!-- Daftar Berita -->
        <div class="row g-4">
            @foreach ($berita as $beritas)

            <div class="col-lg-3 col-md-4 col-sm-6 col-12">

                <div class="news-card">

                    <a href="{{ route('detail.berita', $beritas->slug) }}">

                        <div class="news-thumb">
                            <img src="{{ asset('images/berita/' . $beritas->thumbnail) }}" 
                                alt="{{ $beritas->title }}">
                        </div>

                        <div class="news-body">

                            <p class="news-date">
                                {{ Carbon\Carbon::parse($beritas->created_at)->format('d F Y') }}
                            </p>

                            <h6 class="news-title">
                                {{ $beritas->title }}
                            </h6>

                        </div>

                    </a>

                </div>

            </div>

            @endforeach

            <!-- Jika tidak ada berita -->
            @if ($berita->isEmpty())
                <div class="col-12 text-center">
                    <img src="{{ asset('Assets/Frontend/img/empty.svg') }}" 
                         class="img-fluid" 
                         style="max-width: 300px;" 
                         alt="No News">
                    <p class="mt-3">Tidak ada berita yang ditemukan.</p>
                </div>
            @endif
        </div>

        <!-- Tombol Lihat Semua -->
        <div class="text-center mt-4">
            <a href="{{ route('berita') }}" class="btn btn-primary">Lihat Semua Berita</a>
        </div>
    </div>
</div>