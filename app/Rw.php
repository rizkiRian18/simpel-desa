<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Rw extends  Authenticatable implements JWTSubject
{
    protected $table = "rw";

    protected $fillable = [
       'id_kades', 'nama', 'nik', 'password','rw'
    ];

    public $timestamps = false;

    protected $hidden = [
        'password', 'remember_token'
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

    public function rwtort(){
        return $this->hasMany(Rt::class, 'id_rw');
    }
}
