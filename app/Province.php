<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    //
    public function kabupatens() { return $this->hasMany('App\Kabupaten'); }
    public function tempats() { return $this->hasMany('App\Tempat'); }
}
