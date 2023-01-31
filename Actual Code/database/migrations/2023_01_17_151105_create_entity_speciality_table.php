<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntitySpecialityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entity_specialty', function (Blueprint $table) {
            $table->unsignedBigIncrements('id');

            //Doctor
            $table->unsignedInteger('id_entities');
            $table->foreign('id_entities')->references('id')->on('entities')->onDelete('cascade');

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
        Schema::dropIfExists('entity_specialty');
    }
}