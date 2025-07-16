<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOpcionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('opcions', function (Blueprint $table) {
            $table->id();

            $table->integer('id_tema');
            $table->integer('id_examen');
            $table->integer('id_pregunta');
            $table->string('inciso');
            $table->string('enunciado');

            $table->foreign('id_tema')->references('id')->on('temas');
            $table->foreign('id_examen')->references('id')->on('examenes');
            $table->foreign('id_pregunta')->references('id')->on('preguntas');
            
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
        Schema::dropIfExists('opcions');
    }
}
