<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Rt extends Authenticatable implements JWTSubject

{

    protected $table = "rt";

    protected $fillable = [
       'id_kades','id_rw','nama', 'nik', 'password', 'rt', 'remmber_token','rw'
    ];

    public $timestamps = false;

    protected $hidden = [
        'password', 'remmber_token'
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }


    // public function warga()
    // {
    //     return $this->hasMany('App\Warga', 'id_rt');
    // }


    public function rttorw(){
        return $this->belongsTo('App\Rw', 'id_rw');
    }

}
