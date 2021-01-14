<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    protected $table = 'donations';
    public function user() {
        return $this->belongsTo('App\User');
    }
    public function donation_type() {
        return $this->belongsTo('App\DonationType');
    }
    public function donation_detail() {
        return $this->hasMany('App\DonationDetail');
    }
}
