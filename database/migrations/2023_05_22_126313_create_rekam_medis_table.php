<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRekamMedisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rekam_medis', function (Blueprint $table) {
            $table->id();
            $table->string('no_ktp');
            $table->date('tanggal_periksa');
            $table->string('keluhan');
            $table->string('diagnosis');
            $table->string('terapi');
            $table->text('catatan')->nullable();
            $table->unsignedBigInteger('id_dokter')->nullable();
            $table->foreign('id_dokter')->references('id')->on('dokters')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rekam_medis');
    }
}
