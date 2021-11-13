<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Kades extends  Authenticatable implements JWTSubject
{
    protected $table = "kades";

    protected $fillable = [
        'nama', 'nik', 'password', 'email', 'remember_token'
    ];

    public $timestamps = false;

    protected $hidden = [
        'password', 'remember_token'
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
