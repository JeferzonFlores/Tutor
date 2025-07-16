<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Avance extends Model
{
    protected $fillable = [
        'id_tema','id_estudiante','estado','nota'
    ];
}
