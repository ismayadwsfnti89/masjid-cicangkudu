<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('masjid_profiles', function (Blueprint $table) {
            $table->id();
            $table->string('name')->default('Masjid Jami Cicangkudu');
            $table->text('description')->nullable();
            $table->string('image_path')->nullable();
            $table->string('address')->nullable();
            $table->string('masjid_type')->nullable();
            $table->string('open_hours')->nullable();
            $table->string('activity_label')->nullable();
            $table->text('vision')->nullable();
            $table->text('mission')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('masjid_profiles');
    }
};
