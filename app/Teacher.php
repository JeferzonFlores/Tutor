<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Teacher extends Authenticatable
{
    use Notifiable;

    protected $guard = 'teacher'; // Define el guard para este modelo

    protected $fillable = [
        'name', 'email','username', 'password', 'employee_id_number', 'department',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

     /**
         * Relación muchos-a-muchos con Materias.
         */
        public function materias()
        {
            return $this->belongsToMany(Materia::class, 'materia_teacher', 'teacher_id', 'materia_id')->withTimestamps();
        }
}