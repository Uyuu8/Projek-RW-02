<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWargasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wargas', function (Blueprint $table) {
            $table->id();
            $table->string('nik')->unique();
            $table->string('nama_lengkap');
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->text('alamat');
            $table->string('rt');
            $table->string('rw');
            $table->string('no_kk');
            $table->enum('pendidikan', ['Tidak Sekolah', 'SD', 'SMP', 'SMA/SMK','D3','S1','S2'])->nullable();
            $table->enum('agama', ['Islam', 'Kristen', 'Hindu', 'Buddha', 'Lainnya'])->nullable();
            $table->string('status_keluarga'); // Kepala / Anggota
            $table->string('status_perkawinan');
            $table->string('pekerjaan')->nullable();
            $table->string('no_hp')->nullable();
            $table->enum('status_warga', ['Aktif', 'Pindah', 'Meninggal'])->default('Aktif');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wargas');
    }
}
