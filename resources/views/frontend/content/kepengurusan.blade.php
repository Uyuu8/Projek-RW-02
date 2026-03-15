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

.h3 {
    font-size: 24px;
    font-weight: bold;
    margin-bottom: 20px;
}
.hr-elegant {
    border: none;
    height: 1px;
    background: linear-gradient(to right, transparent, #aaa, transparent);
    margin: 30px 0;
}
.img-fullwidth {
    width: 100%;
    max-width: 100%;
    height: auto;
    display: block;
}
</style>

<div class="container py-5 org-chart">
<br>
    <h3 class="mb-5 fw-bold">STRUKTUR KEPENGURUSAN RW 02</h3>
    <!-- STRUKTUR RW -->
   <img src="{{ asset('images/struktur_rw.png') }}" class="img-fullwidth">
   <br>
   <hr class="hr-elegant">
   <!-- STRUKTUR PKK -->
    <br>
    <br>
    <h3 class="mb-5 fw-bold">STRUKTUR KEPENGURUSAN PKK</h3>
    <br>
   <img src="{{ asset('images/struktur_pkk.jpg') }}" 
     class="img-fullwidth"
     alt="Struktur PKK">
@endsection