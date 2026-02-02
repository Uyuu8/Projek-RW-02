<div class="pengumuman-area">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h2 class="pengumuman-title">PENGUMUMAN</h2>
            </div>
        </div>
        <div class="row justify-content-center">
            @foreach ($event as $key => $events)
                <div class="col-md-3 col-sm-6 mb-4">
                    <div class="pengumuman-item">
                        <div class="pengumuman-date">
                            <span class="day">{{ Carbon\Carbon::parse($events->acara)->format('d') }}</span>
                            <span class="month">{{ Carbon\Carbon::parse($events->acara)->format('M') }}</span>
                        </div>
                        <div class="pengumuman-content">
                            <p class="title">{{ $events->title }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="row text-center mt-3">
            <div class="col-12">
                <a href="{{ route('event') }}" class="btn-pengumuman">Lihat Semua Pengumuman</a>
            </div>
        </div>
    </div>
</div>
