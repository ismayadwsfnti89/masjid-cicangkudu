<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('masjid_contents', function (Blueprint $table) {
            $table->enum('transaction_type', ['pemasukan', 'pengeluaran'])
                ->nullable()
                ->after('amount');
        });
    }

    public function down(): void
    {
        Schema::table('masjid_contents', function (Blueprint $table) {
            $table->dropColumn('transaction_type');
        });
    }
};