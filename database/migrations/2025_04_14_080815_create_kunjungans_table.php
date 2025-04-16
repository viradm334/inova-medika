<?php

use App\Enums\PaymentStatus;
use App\Enums\StatusKunjungan;
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
        Schema::create('kunjungans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pasien');
            $table->date('tgl_lahir');
            $table->longText('alamat')->nullable();
            $table->foreignId('kota_id');
            $table->foreignId('provinsi_id');
            $table->string('no_hp')->nullable();
            $table->longText('keluhan');
            $table->longText('diagnosis')->nullable();
            $table->unsignedBigInteger('jenis_kunjungan_id');
            $table->unsignedBigInteger('dokter_id');
            $table->enum('status', array_column(StatusKunjungan::cases(), 'value'))->default(StatusKunjungan::PENDING, 'value');
            $table->enum('payment_status', array_column(PaymentStatus::cases(), 'value'))->default(PaymentStatus::UNPAID, 'value');
            $table->dateTime('waktu_checkin')->nullable();
            $table->dateTime('waktu_checkout')->nullable();
            $table->float('total')->default(0);
            $table->float('jumlah_bayar')->nullable();
            $table->float('kembalian')->nullable();
            $table->dateTime('waktu_bayar')->nullable();
            $table->foreign('dokter_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('jenis_kunjungan_id')->references('id')->on('jenis_kunjungans')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kunjungans');
    }
};
