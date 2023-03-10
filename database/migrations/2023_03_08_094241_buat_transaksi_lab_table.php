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
        Schema::create('transaksi_lab', function (Blueprint $table) {
            $table->increments('id');
            $table->string('no_registrasi')->nullable();
            $table->string('no_lab')->unique();
            $table->integer('id_pasien');
            $table->integer('usia_tahun');
            $table->integer('usia_bulan');
            $table->integer('usia_hari');
            $table->integer('id_ruangan')->nullable();
            $table->integer('id_asuransi')->nullable();
            $table->integer('id_analis')->nullable();
            $table->string('klinik')->nullable();
            $table->string('dokter_pengirim')->nullable();
            $table->string('asal_dokter_pengirim')->nullable();
            $table->integer('id_validator')->nullable();
            $table->datetime('tgl_validator')->nullable();
            $table->datetime('tgl_periksa')->nullable();
            $table->text('catatan')->nullable();
            $table->integer('status')->nullable();
            $table->datetime('tgl_selesai')->nullable();
            $table->integer('id_user')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi_lab');
    }
};
