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
        Schema::create('parameter', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama');
            $table->integer('kode_tes')->nullable();
            $table->string('kode_lis')->nullable();
            $table->string('satuan')->nullable();
            $table->string('rujukan')->nullable();
            $table->string('metoda')->nullable();
            $table->string('kode_his')->nullable();
            $table->string('keterangan')->nullable();
            $table->integer('koma')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parameter');
    }
};
