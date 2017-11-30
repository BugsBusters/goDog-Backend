<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Indirizzo extends Model
{
    protected $table = 'indirizzo';

    public function indirizzable(){
        $this->morphTo();
    }

    public function comune(){
        $this->hasOne('App\Comune', 'id', 'citta');
    }

    public function regione(){
        $this->hasOne('App\Regione', 'id', 'regione');
    }

    public function provincia(){
        $this->hasOne('App\Provincia', 'id', 'provincia');
    }


}
