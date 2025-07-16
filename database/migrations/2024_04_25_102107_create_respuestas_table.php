<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRespuestasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('respuestas', function (Blueprint $table) {
            $table->id();
            
            $table->integer('id_examen');
            $table->integer('id_pregunta');
            $table->string('correcto');
            $table->timestamps();

            $table->foreign('id_examen')->references('id')->on('examenes');
            $table->foreign('id_pregunta')->references('id')->on('preguntas');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('respuestas');
    }
}
