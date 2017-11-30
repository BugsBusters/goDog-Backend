<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Indirizzo extends Model
{
    protected $table = 'indirizzo';

    public function indirizzable(){
        return $this->morphTo();
    }

    public function comune(){
        return $this->hasOne('App\Comune', 'id', 'citta');
    }

    public function regione(){
        return $this->hasMany('App\Regione', 'id', 'regione');
    }

    public function provincia(){
        return $this->hasMany('App\Provincia', 'id', 'provincia');
    }


}
