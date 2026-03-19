<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('penerima_bansos', function (Blueprint $table) {
            $table->id();

            $table->foreignId('bansos_id')
                ->constrained('bansos')
                ->cascadeOnDelete();

            $table->foreignId('warga_id')
                ->constrained('wargas')
                ->cascadeOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penerima_bansos');
    }
};