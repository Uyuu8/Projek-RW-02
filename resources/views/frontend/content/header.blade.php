<!-- Main Header -->
<div class="main-nav shadow-sm" style="background-color: #0085d2;">
    <div class="main-nav--logo" style="display:flex;align-item:center;gap: 15px;size">
        <!-- Logo -->
        <a href="/"><img src="{{ asset('images/LOGO KOTA BANDUNG.png') }}" alt="Logo Kota Bandung" width="55px"></a>
         <a href="/"><img src="{{ asset('images/JADI RW.png') }}" alt="Logo RW 02" width="60px"></a>
    </div>

    <!-- Navigation Menu -->
    <div class="main-nav--menu hide-mobile bg-blue">
        <!-- Dropdown Menu Profil -->
        <div class="main-nav--menu-list">
            <a href="/" class="menu-list--btn" style="background-color: #0085d2; color:white">BERANDA</a>
        </div>
        <div class="main-nav--menu-list menu-list--dropdown" style="background-color: #0085d2;">
            <button type="button" class="menu-list--btn" style="background-color: #0085d2 !important; color:white !important;"onmouseenter="this.style.setProperty('background-color','#119cd2','important'); this.style.setProperty('color','#ffffffff','important');"onmouseleave="this.style.setProperty('background-color','#0085d2','important'); this.style.setProperty('color','white','important');">PROFIL</button>
            <div class="menu-list--dropdown-content" style="background-color: #119cd2;">
                <a href="#" class="dropdown-content--list" style="background-color: #119cd2; color:white">AD/ART</a>
                <a href="#" class="dropdown-content--list" style="background-color: #119cd2; color:white">TATA TERTIB</a>
                <a href="{{ route('kepengurusan') }}" class="dropdown-content--list" style="background-color: #119cd2; color:white">STRUKTUR ORGANISASI</a>
                <a href="#" class="dropdown-content--list" style="background-color: #119cd2; color:white">PROGRAM KERJA</a>

            </div>
        </div>

        <!-- Dropdown Menu Program -->
        <div class="main-nav--menu-list">
            <a href="#"class="menu-list--btn" style="background-color: #0085d2; color:white">RENBANG</a>
        </div>

        <!-- BANSOS -->
        <div class="main-nav--menu-list">
            <a href="#" class="menu-list--btn" style="background-color: #0085d2; color:white">BANSOS</a>
        </div>

        <!-- Dropdown Menu Lainnya -->
        <div class="main-nav--menu-list menu-list--dropdown" style="background-color: #0085d2;">
            <button type="button" class="menu-list--btn" style="background-color: #0085d2 !important; color:white !important;border-radius:16px;padding:12px;"onmouseenter="this.style.setProperty('background-color','#119cd2','important'); this.style.setProperty('color','#ffffffff','important');"onmouseleave="this.style.setProperty('background-color','#0085d2','important'); this.style.setProperty('color','white','important');">STATISTIK</button>
            <div class="menu-list--dropdown-content" style="background-color: #119cd2;border-radius:16px;padding:12px;">
                <a href="#" class="dropdown-content--list" style="background-color: #119cd2; color:white">RUMAH/BANGUNAN</a>
                <a href="#" class="dropdown-content--list" style="background-color: #119cd2; color:white">KEPALA KELUARGA</a>
                <a href="{{route('statistik.warga')}}" class="dropdown-content--list" style="background-color: #119cd2; color:white">WARGA</a>
                <a href="{{route('statistik.usia')}}" class="dropdown-content--list" style="background-color: #119cd2; color:white">KELOMPOK USIA</a>
                <a href="#" class="dropdown-content--list" style="background-color: #119cd2; color:white">PEMILIH</a>
                <a href="{{ route('statistik.agama') }}" class="dropdown-content--list" style="background-color: #119cd2; color:white">AGAMA</a>
                <a href="{{ route('statistik.pendidikan') }}" class="dropdown-content--list" style="background-color: #119cd2; color:white">PENDIDIKAN</a>
            </div>
        </div>

        <!-- KONTAK -->
        <div class="main-nav--menu-list menu-list--dropdown" style="background-color: #0085d2;">
            <button type="button" class="menu-list--btn" style="background-color: #0085d2 !important; color:white !important; border-radius:16px;padding:12px;"onmouseenter="this.style.setProperty('background-color','#119cd2','important'); this.style.setProperty('color','#ffffffff','important');"onmouseleave="this.style.setProperty('background-color','#0085d2','important'); this.style.setProperty('color','white','important');">INFORMASI</button>
             <div class="menu-list--dropdown-content" style="background-color: #119cd2;border-radius:16px;padding:12px;">
                <a href="#" class="dropdown-content--list" style="background-color: #119cd2; color:white">INVENTARIS RT</a>
                <a href="#" class="dropdown-content--list" style="background-color: #119cd2; color:white">AGENDA RT</a>
                <a href="#" class="dropdown-content--list" style="background-color: #119cd2; color:white">PELAYANAN WARGA</a>
                <a href="{{ route('berita') }}" class="dropdown-content--list" style="background-color: #119cd2; color:white">BERITA</a>
            </div>
        </div>

        <!-- Login -->
        <div class="main-nav--menu-list">
            @auth
            <a href="/home" class="menu-list--btn" style="background-color: #0085d2; color:white">HOME</a>
            @else
            <a href="{{ route('login') }}" class="menu-list--btn" style="background-color: #0085d2; color:white">LOGIN</a>
            @endauth
        </div>
        <!-- commit -->
    </div> 
</div>

