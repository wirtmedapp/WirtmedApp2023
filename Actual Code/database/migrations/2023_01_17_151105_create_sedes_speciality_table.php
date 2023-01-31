<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSedesSpecialtyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sedes_specialty', function (Blueprint $table) {
            $table->unsignedBigIncrements('id');

            //Sedes
            $table->unsignedInteger('id_sedes');
            $table->foreign('id_sedes')->references('id')->on('sedes')->onDelete('cascade');

            //Specialty
            $table->unsignedBigInteger('id_specialties');
            $table->foreign('id_specialties')->references('id')->on('specialties')->onDelete('cascade');

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
        Schema::dropIfExists('sedes_specialty');
    }
}