<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inserzione extends Model
{
  protected $table='inserzione';

    public function avvistamento(){
        return $this->hasMany('App\Inserzione','id_inserzione','id');
    }
}
