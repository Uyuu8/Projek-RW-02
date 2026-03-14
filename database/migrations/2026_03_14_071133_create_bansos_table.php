<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('bansos', function (Blueprint $table) {
            $table->id();
            $table->string('uraian_bansos');
            $table->string('jenis_bantuan');
            $table->year('tahun');
            $table->string('diselenggarakan_oleh');
            $table->string('disalurkan_melalui');
            $table->string('kategori_penerima');
            $table->string('penerima');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bansos');
    }
};
