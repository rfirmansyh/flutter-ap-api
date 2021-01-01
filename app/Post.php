<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // RELATION
    public function user() { return $this->belongsTo('App\User'); }
}
