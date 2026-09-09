<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('masjid_contents', function (Blueprint $table) {
            $table->foreignId('donation_id')->nullable()->unique()->after('id')->constrained()->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('masjid_contents', function (Blueprint $table) {
            $table->dropConstrainedForeignId('donation_id');
        });
    }
};
