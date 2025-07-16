<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('username')->unique(); // CAMBIO: Usar 'username' en lugar de 'email'
            // Si necesitas el email para otras cosas (ej. notificaciones), puedes mantenerlo y hacerlo nullable
            // $table->string('email')->unique()->nullable();
            $table->string('password');
            $table->string('student_id_number')->unique()->nullable();
            $table->string('phone')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('students');
    }
}
