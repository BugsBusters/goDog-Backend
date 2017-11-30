<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provincia extends Model
{
    protected $table='province';

    public function indirizzo(){
        $this->belongsToMany('App\Indirizzo');
    }
}
