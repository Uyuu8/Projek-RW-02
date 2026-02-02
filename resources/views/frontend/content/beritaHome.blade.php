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
                    <div class="card shadow-sm border-0 h-100" style="border-radius: 0;">
                        <div class="card-img-top">
                            <img src="{{ asset('storage/images/berita/' . $beritas->thumbnail) }}" 
                                 class="img-fluid" 
                                 alt="{{ $beritas->title }}" 
                                 style="height: 180px; object-fit: cover; border-radius: 0;">
                        </div>
                        <div class="card-body">
                            <p class="text-muted mb-2 small">{{ Carbon\Carbon::parse($beritas->created_at)->format('d F Y') }}</p>
                            <h6 class="card-title" style="min-height: 50px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word;">
                                <a href="{{ route('detail.berita', $beritas->slug) }}" class="text-dark text-decoration-none">
                                    {{ $beritas->title }}
                                </a>
                            </h6>
                        </div>
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
