<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Materia extends Model
{
       protected $fillable = [
        'name', 'description',
    ];

           /**
         * Relación muchos-a-muchos con Docentes.
         */
        public function teachers()
        {
            return $this->belongsToMany(Teacher::class, 'materia_teacher', 'materia_id', 'teacher_id')->withTimestamps();
        }

        /**
         * Relación muchos-a-muchos con Estudiantes.
         */
        public function students()
        {
            return $this->belongsToMany(Student::class, 'materia_student', 'materia_id', 'student_id')->withTimestamps();
        }
// En app/Materia.php
public function modules()
{
    return $this->hasMany(Module::class, 'materia_id');
}

}
