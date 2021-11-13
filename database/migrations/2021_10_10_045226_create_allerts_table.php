<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAllertsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('allerts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('id_warga')->nullable();
            $table->foreign('id_warga')->references('id')->on('warga')->onDelete('cascade');
            $table->integer('id_rt')->nullable();
            $table->foreign('id_rt')->references('id')->on('rt')->onDelete('cascade');
            $table->integer('id_rw')->nullable();
            $table->foreign('id_rw')->references('id')->on('rw')->onDelete('cascade');
            $table->integer('id_kades')->nullable();
            $table->foreign('id_kades')->references('id')->on('kades')->onDelete('cascade');
            $table->string('keterangan')->nullable();

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
        Schema::dropIfExists('allerts');
    }
}
