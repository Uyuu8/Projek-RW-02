@extends('layouts.Frontend.page')

@section('content')
<style>
.org-chart {
    text-align: center;
    position: relative;
}

.org-line-vertical {
    width: 2px;
    height: 30px;
    background: #ccc;
    margin: 0 auto;
}

.org-line-horizontal {
    height: 2px;
    background: #ccc;
    margin: 0 auto 30px;
}


.org-card {
     border: 1px solid #ddd;
    border-radius: 8px;
    padding: 10px 5px;
    background: #fff;
    text-align: center;
    font-size: 14px;
    min-height: 70px;
    display: flex;
    flex-direction: column;
    justify-content: center;
}
/* KHUSUS RT */
.rt-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 20px;
    max-width: 900px;
    margin: 0 auto;
}

.rt-card {
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 10px 5px;
    background: #fff;
    text-align: center;
    font-size: 14px;
    min-height: 70px;

    display: flex;
    flex-direction: column;
    justify-content: center;
}

/* RESPONSIVE */
@media (max-width: 992px) {
    .rt-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 576px) {
    .rt-grid {
        grid-template-columns: repeat(1, 1fr);
    }
}
/* SEKSI */
.seksi-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 20px;
    max-width: 1000px;
    margin: 0 auto;
}

.seksi-card {
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 12px 8px;
    background: #f9fafb;
    text-align: center;
    font-size: 14px;
    min-height: 70px;
    flex-direction: column;  
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
}

/* RESPONSIVE */
@media (max-width: 992px) {
    .seksi-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 576px) {
    .seksi-grid {
        grid-template-columns: repeat(1, 1fr);
    }
}


.org-row {
    display: flex;
    justify-content: center;
    gap: 30px;
    flex-wrap: wrap;
}
</style>

<div class="container py-5 org-chart">

    <h3 class="mb-5 fw-bold">STRUKTUR KEPENGURUSAN RW 02</h3>

    <!-- KETUA RW -->
    <div class="org-row">
        <div class="org-card" style="width:260px">
            <img src="{{ asset('images/ketua.jpg') }}"
                 class="rounded-circle mb-3"
                 width="120" height="120"
                 style="object-fit:cover">
            <h5 class="fw-bold mb-1">SUHERMAN</h5>
            <span class="badge bg-primary">KETUA RW</span>
        </div>
    </div>

    <div class="org-line-vertical"></div>
    <div class="org-line-horizontal" style="width:60%"></div>

    <!-- PENGURUS INTI -->
    <div class="org-row mb-4">
        <div class="org-card" style="width:220px">
            <h6 class="fw-bold">DADAN WARMANA</h6>
            <span class="badge bg-warning text-white">SEKRETARIS</span>
        </div>
        <div class="org-card" style="width:220px">
            <h6 class="fw-bold">ASEP WAHYUDIN</h6>
            <span class="badge bg-success">HUMAS</span>
        </div>
        <div class="org-card" style="width:220px">
            <h6 class="fw-bold">RUDI FIRMANSYAH</h6>
            <span class="badge bg-danger">BENDAHARA</span>
        </div>
    </div>

    <div class="org-line-vertical"></div>
    <div class="org-line-horizontal" style="width:0%"></div>

     <!-- GARIS KE SEKSI -->
<div class="org-line-vertical mb-3 org-line-horizontal" style="width:80%"></div>

<h5 class="fw-bold mb-4 text-center">SEKSI-SEKSI RW</h5>
<div class="org-line-vertical"></div>
<div class="seksi-grid mb-4">
    <div class="seksi-card">
        <strong>Seksi Keamanan</strong>
        <small>AGUS DEDI</small>
    </div>

    <div class="seksi-card">
        <strong>Seksi Kerohanian</strong>
        <small>H. MUHTAR</small>
    </div>

    <div class="seksi-card">
        <strong>Seksi Pembangunan</strong>
        <small>PUGUH JAKA NARIMA</small>
        <small>DEDI DAENG</small>
    </div>

    <div class="seksi-card">
        <strong>Seksi Sosial</strong>
         <small>WAGINO</small>
        <small>RAHMAT</small>
    </div>

    <div class="seksi-card">
        <strong>Seksi Lingkungan Hidup</strong>
        <small>WILDAN TRIYANA</small>
        <small>DAUD SANI</small>
    </div>

    <div class="seksi-card">
        <strong>Seksi Pendidikan</strong>
        <small>DENI HERMANTO</small>
    </div>

    <div class="seksi-card">
        <strong>Seksi Pemuda & Olahraga</strong>
        <small>GARJITO</small>
    </div>

    <div class="seksi-card">
        <strong>Seksi Kesehatan</strong>
        <small>IMAS</small>
        <small>ANTI</small>
    </div>
</div>


    <!-- KETUA RT -->
<div class="org-line-vertical mb-3"></div>

<h5 class="fw-bold mb-4 text-center">KETUA RT</h5>

    <div class="rt-grid">
        <div class="rt-card">
        <strong>KETUA RT 01</strong>
        <span>ENJAN SUPYAN ARIF</span>
        <strong>SEKRETARIS</strong>
        <span>AZIZ RAMADHAN</span>
        <strong>BENDAHARA</strong>
        <span>RINI TARWIATI</span>
        </div>
        <div class="rt-card">
        <strong>KETUA RT 02</strong>
        <span>MAMAN SUPARMAN</span>
        <strong>SEKRETARIS</strong>
        <span>ASEP</span>
        <strong>BENDAHARA</strong>
        <span>AGUS UJANG</span>
        </div>
        <div class="rt-card">
        <strong>KETUA RT 03</strong>
        <span>DEDE UDAN BONDAN</span>
        <strong>SEKRETARIS</strong>
        <span>FEBY</span>
        <strong>BENDAHARA</strong>
        <span>ANGLE</span>
        </div>
        <div class="rt-card">
        <strong>KETUA RT 04</strong>
        <span>MULYADI</span>
        <strong>SEKRETARIS</strong>
        <span>-</span>
        <strong>BENDAHARA</strong>
        <span>IMAS</span>
        </div>
        <div class="rt-card">
        <strong>KETUA RT 05</strong>
        <span>MIMIN AMIN</span>
        <strong>SEKRETARIS</strong>
        <span>AHMAD</span>
        <strong>BENDAHARA</strong>
        <span>EEN</span>
        </div>
        <div class="rt-card">
        <strong>KETUA RT 06</strong>
        <span>IWAN SURYANA</span>
        <strong>SEKRETARIS</strong>
        <span>RINI SUHEMI</span>
        <strong>BENDAHARA</strong>
        <span>RITA JUWTA</span>
        </div>
        <div class="rt-card">
        <strong>KETUA RT 07</strong>
        <span>UJANG JUHANA</span>
        <strong>SEKRETARIS</strong>
        <span>ASEP.W</span>
        <strong>BENDAHARA</strong>
        <span>NIGRUM</span>
        </div>
        <div class="rt-card">
        <strong>KETUA RT 08</strong>
        <span>BAMBANG PURWANTO</span>
        <strong>SEKRETARIS</strong>
        <span>ADITYA ARYADI</span>
        <strong>BENDAHARA</strong>
        <span>SRI MUJI LESTARI</span>
        </div>
    </div>


</div>
@endsection