<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comune extends Model
{
    protected $table='comuni';

    public function indirizzo(){
        $this->belongsToMany('App\Indirizzo');
    }
}
