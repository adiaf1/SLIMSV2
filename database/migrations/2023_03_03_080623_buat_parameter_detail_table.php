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
        Schema::create('parameter_detail', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_parameter');
            $table->string('ket')->nullable();
            $table->integer('gender');
            $table->integer('usia1');
            $table->integer('usia2');
            $table->integer('waktu');
            $table->float('nr1');
            $table->integer('rangen');
            $table->float('nr2');
            $table->string('rujukan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parameter_detail');
    }
};
