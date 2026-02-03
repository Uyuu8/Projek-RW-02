<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIuransTable extends Migration
{
    public function up()
    {
        Schema::create('iurans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('warga_id');
            $table->string('rt');
            $table->string('rw')->default('02');
            $table->integer('bulan');
            $table->integer('tahun');
            $table->integer('jumlah')->default(11000);
            $table->enum('status', ['Belum', 'Lunas'])->default('Belum');
            $table->date('tanggal_bayar')->nullable();
            $table->timestamps();

            $table->foreign('warga_id')->references('id')->on('wargas')->onDelete('cascade');
        });

    }

    public function down()
    {
        Schema::dropIfExists('iurans');
    }
}
