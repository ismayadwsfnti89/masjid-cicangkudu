<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('families', function (Blueprint $table) {
            $table->id();
            $table->string('no_kk')->unique();
            $table->unsignedTinyInteger('golongan');
            $table->timestamps();
        });

        Schema::table('warga_profiles', function (Blueprint $table) {
            $table->string('nik')->nullable()->unique()->after('user_id');
            $table->foreignId('family_id')->nullable()->after('nik')->constrained('families')->nullOnDelete();
        });

        Schema::table('kas_payments', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropUnique(['user_id', 'bulan', 'tahun']);
            $table->foreignId('user_id')->nullable()->change();
            $table->foreign('user_id')->references('id')->on('users')->nullOnDelete();
            $table->foreignId('family_id')->after('user_id')->constrained('families')->cascadeOnDelete();
            $table->unique(['family_id', 'bulan', 'tahun']);
        });
    }

    public function down(): void
    {
        Schema::table('kas_payments', function (Blueprint $table) {
            $table->dropUnique(['family_id', 'bulan', 'tahun']);
            $table->dropConstrainedForeignId('family_id');
            $table->dropForeign(['user_id']);
            $table->foreignId('user_id')->nullable(false)->change();
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->unique(['user_id', 'bulan', 'tahun']);
        });

        Schema::table('warga_profiles', function (Blueprint $table) {
            $table->dropConstrainedForeignId('family_id');
            $table->dropUnique(['nik']);
            $table->dropColumn('nik');
        });

        Schema::dropIfExists('families');
    }
};
