<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pelicula extends Model
{
    //
    public function turnos()
    {
        return $this->hasOne('App\TurnoPelicula');

        // return $this->belongsTo('App\TurnoPelicula')->withDefault();
    }
}
