<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estudiantes extends Model
{
    protected $fillable = [
        'nombre',
        'apellidoP',
        'apellidoM',
        'email',
        'codigo',
        'clave',
    ];
}
