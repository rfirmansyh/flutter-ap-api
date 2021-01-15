<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role_id', 'kabupaten_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function generateToken()
    {
        $this->api_token = str_random();
        $this->save();
        return $this->api_token;
    }

    // RELATION
    public function role() { return $this->belongsTo('App\Role'); }
    public function kabupaten() { return $this->belongsTo('App\Kabupaten'); }
    public function posts() { return $this->hasMany('App\Post'); }
    public function reviews() { return $this->hasMany('App\Review'); }
    public function tempats() { return $this->hasMany('App\Tempat'); }


}
