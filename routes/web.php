<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// ======= FRONTEND ======= \\

Route::get('/', [App\Http\Controllers\Frontend\IndexController::class, 'index'])->name('index');

    ///// MENU \\\\\
    
        //// KONTAK
        Route::get('kontak', [App\Http\Controllers\Frontend\IndexController::class, 'kontak'])->name('kontak');

        //// kepengurusan
        Route::get('kepengurusan', [App\Http\Controllers\Frontend\IndexController::class, 'kepengurusan'])
        ->name('kepengurusan');

        //// FAQ
        Route::get('faq', [App\Http\Controllers\Frontend\IndexController::class, 'faq'])->name('faq');

        //// Struktur Organisasi
        Route::get('struktur-organisasi', [App\Http\Controllers\Frontend\IndexController::class, 'strukturOrganisasi']);

        Route::get('statistik/warga', 
            [App\Http\Controllers\Frontend\IndexController::class, 'statistikWarga']
        )->name('statistik.warga');

        Route::get('statistik/usia', 
            [App\Http\Controllers\Frontend\IndexController::class, 'statistikUsia']
        )->name('statistik.usia');

        Route::get('/agama', 
            [App\Http\Controllers\Frontend\IndexController::class, 'statistikAgama'])
        ->name('statistik.agama');

        Route::get('/pendidikan', 
            [App\Http\Controllers\Frontend\IndexController::class, 'statistikPendidikan'])
        ->name('statistik.pendidikan');



        /// BERITA \\\
        
        Route::get('berita',[App\Http\Controllers\Frontend\IndexController::class,'berita'])->name('berita');
        Route::get('berita/{slug}',[App\Http\Controllers\Frontend\IndexController::class,'detailBerita'])->name('detail.berita');
        Route::post('ckeditor/upload', [App\Http\Controllers\CKEditorController::class, 'upload'])->name('ckeditor.upload');

        /// EVENT \\\
        Route::get('event/{slug}',[App\Http\Controllers\Frontend\IndexController::class,'detailEvent'])->name('detail.event');
        Route::get('event',[App\Http\Controllers\Frontend\IndexController::class,'events'])->name('event');

Auth::routes(['register' => false]);


// ======= BACKEND ======= \\
Route::middleware('auth')->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

     /// PROFILE \\\
    Route::resource('profile-settings',Backend\ProfileController::class);

    /// CHANGE PASSWORD
    Route::put('profile-settings/change-password/{id}',[App\Http\Controllers\Backend\ProfileController::class, 'changePassword'])->name('profile.change-password');

    Route::prefix('/')->middleware('role:Admin')->group( function (){
        ///// WEBSITE \\\\\
        Route::resources([
            /// IMAGE SLIDER \\\
            'backend-imageslider' => Backend\Website\ImageSliderController::class,
            /// KATEGORI BERITA \\\
            'backend-kategori-berita'   => Backend\Website\KategoriBeritaController::class,
            /// BERITA \\\
            'backend-berita' => Backend\Website\BeritaController::class,
            /// EVENT \\\
            'backend-event' => Backend\Website\EventsController::class,
        
        ]);
        Route::resource(
            'backend-warga',
            Backend\Website\WargaController::class
        )->parameters([
            'backend-warga' => 'warga'
        ]);

        Route::get('backend-warga/export/pdf', [
            App\Http\Controllers\Backend\Website\WargaController::class,
            'exportPdf'
        ])->name('backend-warga.export.pdf');

        Route::get('backend-warga/export/excel', [
            App\Http\Controllers\Backend\Website\WargaController::class,
            'exportExcel'
        ])->name('backend-warga.export.excel');

        Route::get('backend-keuangan-rt{rt}', 
        [App\Http\Controllers\Backend\Website\KeuanganController::class, 'index']
        );

        Route::post('backend-keuangan/bayar',
            [App\Http\Controllers\Backend\Website\KeuanganController::class, 'bayar']
        )->name('backend-keuangan.bayar');

        Route::get('/export/pdf/{rt}', 
        [App\Http\Controllers\Backend\Website\KeuanganController::class, 'exportPdf']
        )->name('backend-keuangan.exportPdf');

        Route::get('/export/excel/{rt}',
            [App\Http\Controllers\Backend\Website\KeuanganController::class, 'exportExcel']
        )->name('backend-keuangan.exportExcel');


        ///// PENGGUNA \\\\\
        Route::resources([
            'backend-pengguna-user' => Backend\Pengguna\UserController::class,
        ]);
    });
});


Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});