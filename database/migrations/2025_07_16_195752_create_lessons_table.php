<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLessonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('module_id')->constrained('modules')->onDelete('cascade'); // Clave foránea a 'modules'

            $table->string('nombre'); // Nombre de la lección
            $table->integer('orden')->default(1)->comment('Orden de la lección dentro de su módulo');
            $table->text('description')->nullable(); // Descripción de la lección

            // --- Nuevos campos de contenido independientes ---
            $table->longText('content_text')->nullable()->comment('Contenido de texto de la lección');
            $table->string('content_image_video_path')->nullable()->comment('Ruta del archivo de imagen o video');
            $table->string('content_document_path')->nullable()->comment('Ruta del archivo de documento (PDF, Word)');
            $table->string('content_link')->nullable()->comment('URL de enlace externo o video incrustado');
            // --- Fin de nuevos campos ---

            $table->boolean('is_published')->default(false); // Para que el docente decida cuándo publicar

            $table->timestamps();

            // Opcional: Para asegurar que el orden de las lecciones sea único por módulo
            $table->unique(['module_id', 'orden']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lessons');
    }
}
