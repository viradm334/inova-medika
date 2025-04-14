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
        Schema::create('kunjungan_tindakans', function (Blueprint $table) {
            $table->unsignedBigInteger('kunjungan_id');
            $table->unsignedBigInteger('tindakan_id');
            $table->foreign('kunjungan_id')->references('id')->on('kunjungans')->onDelete('cascade');
            $table->foreign('tindakan_id')->references('id')->on('tindakans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kunjungan_tindakans');
    }
};
