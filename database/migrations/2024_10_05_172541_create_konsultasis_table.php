<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('konsultasis', function (Blueprint $table) {
            $table->id();
            $table->dateTime('tanggal_keluhan');
            $table->text('keluhan');
            $table->enum('status', ['pending', 'diterima', 'ditolak'])->default('pending');
            $table->foreignId('dokter_id')->constrained()->onDelete('cascade');
            $table->foreignId('pasien')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('konsultasis');
    }
};
