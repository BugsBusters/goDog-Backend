<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Regione extends Model
{
    protected $table='regioni';

    public function indirizzo(){
        $this->belongsToMany('App\Indirizzo');
    }
}
