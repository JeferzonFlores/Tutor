<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
     protected $fillable = [
         'materia_id',
        'nombre',
        'descripcion',
        'orden',
        'is_active',
    ];

    /**
     * Un módulo pertenece a una materia.
     */
    public function materia()
    {
        return $this->belongsTo(Materia::class);
    }

    /**
     * Un módulo tiene muchas lecciones.
     */
    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }
}
