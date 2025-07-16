<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Opcion extends Model
{
    protected $fillable = [
        'id_tema','id_examen','id_pregunta','inciso', 'enunciado'
    ];
}
