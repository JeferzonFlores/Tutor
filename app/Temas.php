<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Temas extends Model
{
    protected $fillable = [
        'titulo','introduccion',
    ];

    public function subtitulos(){
        return $this->hasMany(subtitulos::class);
    }

    public function examenes(){
        return $this->hasMany(examenes::class);
    }
}
