<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kas_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->unsignedTinyInteger('golongan');
            $table->decimal('nominal', 15, 2);
            $table->unsignedTinyInteger('bulan');
            $table->unsignedSmallInteger('tahun');
            $table->date('tanggal_pembayaran')->nullable();
            $table->enum('status', ['sudah_bayar', 'belum_bayar'])->default('belum_bayar');
            $table->timestamps();

            $table->unique(['user_id', 'bulan', 'tahun']);
            $table->index(['bulan', 'tahun', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kas_payments');
    }
};
