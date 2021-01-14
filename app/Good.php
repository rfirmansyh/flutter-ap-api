<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Good extends Model
{
    public function donation_detail() {
        return $this->hasMany('App\DonationDetail');
    }
}
