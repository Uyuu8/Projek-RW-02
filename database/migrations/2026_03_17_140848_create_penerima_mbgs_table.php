<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenerimaMbgsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penerima_mbgs', function (Blueprint $table) {
            $table->id();

            // relasi ke tabel warga
            $table->foreignId('warga_id')
                ->constrained('wargas')
                ->onDelete('cascade');

            // kategori penerima MBG
            $table->enum('kategori', [
                'Balita',
                'Ibu Hamil',
                'Ibu Menyusui'
            ]);

            // tanggal mulai menerima program
            $table->date('tanggal_mulai')->nullable();

            // keterangan tambahan
            $table->text('keterangan')->nullable();

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
        Schema::dropIfExists('penerima_mbgs');
    }
}