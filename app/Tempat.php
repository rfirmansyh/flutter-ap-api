<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tempat extends Model
{
    //
    public function reviews() { return $this->hasMany('App\Review'); }
    public function user() { return $this->belongsTo('App\User'); }
    public function kabupaten() { return $this->belongsTo('App\Kabupaten'); }
    public function province() { return $this->belongsTo('App\Province'); }
}
