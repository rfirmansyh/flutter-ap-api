<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kabupaten extends Model
{
    //
    public function users() { return $this->hasMany('App\User'); }
    public function tempats() { return $this->hasMany('App\Tempat'); }
}
