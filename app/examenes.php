<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class examenes extends Model
{
    protected $fillable = [
        'id_tema', 'enunciado'
    ];
}
