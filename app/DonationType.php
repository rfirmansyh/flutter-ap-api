<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DonationType extends Model
{
    protected $table = 'donation_types';

    public function donation() {
        return $this->hasMany('App\Donation');
    }

}
