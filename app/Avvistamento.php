<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Avvistamento extends Model
{
    protected $table='avvistamenti';

    public function inserzione(){
        return $this->belongsTo('App\Inserzione');
    }
}
