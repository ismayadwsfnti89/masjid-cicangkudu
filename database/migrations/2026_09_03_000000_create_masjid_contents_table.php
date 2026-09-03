<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('masjid_contents', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('title');
            $table->text('description')->nullable();
            $table->date('event_date')->nullable();
            $table->decimal('amount', 15, 2)->nullable();
            $table->string('status')->default('draft');
            $table->timestamps();

            $table->index(['type', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('masjid_contents');
    }
};
