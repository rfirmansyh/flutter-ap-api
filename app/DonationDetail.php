<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DonationDetail extends Model
{
    protected $table = 'donation_detail';
    public function donation() {
        return $this->belongsTo('App\Donation');
    }
    public function good() {
        return $this->belongsTo('App\Good');
    }
}
