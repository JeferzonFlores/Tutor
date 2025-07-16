<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Illuminate\Database\Eloquent\Model;

class Student extends Authenticatable
{
        use Notifiable;

    protected $guard = 'student'; // Define el guard para este modelo

    protected $fillable = [
         'name', 'username', 'password', 'student_id_number', 'phone',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

     /**
         * Relación muchos-a-muchos con Materias.
         */
        public function materias()
        {
            return $this->belongsToMany(Materia::class, 'materia_student', 'student_id', 'materia_id')->withTimestamps();
        }
}
