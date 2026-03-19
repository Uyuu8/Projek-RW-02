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
            $table->char('nik', 16)->unique();
            $table->string('nama_lengkap');
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('rt');
            $table->string('rw');
            $table->char('no_kk', 16)->nullable();
            $table->enum('pendidikan', [
                'Tidak Sekolah',
                'SD atau Sederajat',
                'SMP atau Sederajat',
                'SMA/SMK atau Sederajat',
                'D3',
                'S1',
                'S2',
                'S3'
            ])->nullable();

            $table->enum('agama', [
                'Islam',
                'Kristen',
                'Hindu',
                'Buddha',
                'Lainnya'
            ])->nullable();

            $table->string('status_keluarga'); // Kepala / Anggota
            $table->string('status_perkawinan');
            $table->string('pekerjaan')->nullable();
            $table->enum('status_rumah', ['Menetap', 'Kontrak'])->nullable();
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
