<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('kas_payments', function (Blueprint $table) {
            $table->string('proof_path')->nullable()->after('tanggal_pembayaran');
        });

        DB::statement("ALTER TABLE kas_payments MODIFY status ENUM('pending', 'verified', 'rejected', 'sudah_bayar', 'belum_bayar') NOT NULL DEFAULT 'pending'");
        DB::table('kas_payments')->where('status', 'sudah_bayar')->update(['status' => 'verified']);
        DB::table('kas_payments')->where('status', 'belum_bayar')->update(['status' => 'rejected']);
        DB::statement("ALTER TABLE kas_payments MODIFY status ENUM('pending', 'verified', 'rejected') NOT NULL DEFAULT 'pending'");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE kas_payments MODIFY status ENUM('pending', 'verified', 'rejected', 'sudah_bayar', 'belum_bayar') NOT NULL DEFAULT 'belum_bayar'");
        DB::table('kas_payments')->where('status', 'verified')->update(['status' => 'sudah_bayar']);
        DB::table('kas_payments')->whereIn('status', ['pending', 'rejected'])->update(['status' => 'belum_bayar']);
        DB::statement("ALTER TABLE kas_payments MODIFY status ENUM('sudah_bayar', 'belum_bayar') NOT NULL DEFAULT 'belum_bayar'");
        Schema::table('kas_payments', function (Blueprint $table) {
            $table->dropColumn('proof_path');
        });
    }
};
