<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class subtitulos extends Model
{
    protected $fillable = [
        'id_tema', 'titulo','presentacion','video'
    ];
}
